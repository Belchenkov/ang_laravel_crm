<?php


namespace App\Modules\Admin\Lead\Services;


use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Lead\Requests\LeadCreateRequest;
use App\Modules\Admin\LeadComment\Services\LeadCommentService;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\User\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LeadService
{
    public function getLeads()
    {
        $leads = (new Lead())->getLeads();
        $statuses = Status::all();
        $resultLeads = [];

        $statuses->each(function ($item, $key) use (&$resultLeads, $leads) {
            $collection = $leads->where('status_id', $item->id);
            $resultLeads[$item->title] = array_values($collection->map(function ($elem) {
                return $elem->renderData();
            })->toArray());
        });

        return $resultLeads;
    }

    public function store(LeadCreateRequest $request, User $user): Lead
    {
        $lead = new Lead();

        $lead->fill($request->only($lead->getFillable()));

        $status = Status::where('title', 'new')->first();

        $lead->status()->associate($status);

        $user->leads()->save($lead);

        // Add comments
        $this->addStoreComments($lead, $request, $user, $status);

        $lead->statuses()->attach($status->id);

        return $lead;
    }

    private function addStoreComments(
        Lead $lead,
        LeadCreateRequest $request,
        User $user,
        Status $status
    ): void
    {
        $is_event = true;
        $tmp_text = 'Автор <strong>' . $user->full_name . '</strong> создал лид со статусом ' . $status->title_ru;
        LeadCommentService::saveComment($tmp_text, $lead, $user, $status, null, $is_event);

        if ($request->text) {
            $is_event = false;
            $tmp_text = 'Пользователь <strong>' . $user->full_name . '</strong> оставил комментарий ' . $request->text;
            LeadCommentService::saveComment($tmp_text, $lead, $user, $status, $request->text, $is_event);
        }
    }

    public function update(LeadCreateRequest $request, User $user, Lead $lead): Lead
    {
        $tmp = clone $lead;
        $lead->count_create++;
        $status = Status::where('title', 'new')->firstOrFail();

        $lead->fill($request->only($lead->getFillable()));
        $lead->status()
            ->associate($status)
            ->save();

        // Add comment
        $this->addUpdateComments($lead, $request, $user, $status, $tmp);

        return $lead;
    }

    private function addUpdateComments(
        Lead $lead,
        LeadCreateRequest $request,
        User $user,
        Status $status,
        Lead $tmp
    ): void
    {
        if ($tmp->source_id !== $lead->source_id) {
            $is_event = true;
            $tmp_text = 'Пользователь <strong>' . $user->full_name . '</strong> изменил источник на ' . $lead->source->title;
            LeadCommentService::saveComment($tmp_text, $lead, $user, $status, null, $is_event);
        }

        if ($tmp->unit_id !== $lead->unit_id) {
            $is_event = true;
            $tmp_text = 'Пользователь <strong>' . $user->full_name . '</strong> изменил позразделение на ' . $lead->unit->title;
            LeadCommentService::saveComment($tmp_text, $lead, $user, $status, null, $is_event);
        }

        if ($tmp->status_id !== $lead->status_id) {
            $is_event = true;
            $tmp_text = 'Пользователь <strong>' . $user->full_name . '</strong> изменил статус на ' . $lead->status->title_ru;
            LeadCommentService::saveComment($tmp_text, $lead, $user, $status, null, $is_event);
        }

        if ($request->text) {
            $tmp_text = 'Пользователь <strong>' . $user->full_name . '</strong> оставил комментарий ' . $request->text;
            LeadCommentService::saveComment($tmp_text, $lead, $user, $status, $request->text);
        }

        $is_event = true;
        $tmp_text = 'Автор <strong>' . $user->full_name . '</strong> создал лид со статусом ' . $status->title_ru;
        LeadCommentService::saveComment($tmp_text, $lead, $user, $status, null, $is_event);

        $lead->statuses()->attach($status->id);
    }

    public function archive(): Collection
    {
        return collect((new Lead())->getArchive()->items())
                ->transform(function ($item) {
                    return $item->renderData(false);
                });
    }

    /**
     * @param $request
     * @return mixed
     */
    public function checkExist($request)
    {
        $qB = Lead::select('*');

        if ($request->link) {
            $qB->where('link', $request->link);
        } elseif ($request->phone) {
            $qB->where('phone', $request->phone);
        }

        $qB->where('status_id', '!=', Status::DONE);
        return $qB->first();
    }

    public function updateQuality(Lead $lead): Lead
    {
        $lead->is_quality_lead = true;
        $lead->save();
        return $lead;
    }

    public function getAddSaleCount(): int
    {
        $user = auth()->user();
        $sql_op1 = DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")');
        $sql_op2 = DB::raw('DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)');

        return (int)$user->leads()
            ->where('is_add_sale', 1)
            ->where('is_quality_lead', 1)
            ->where($sql_op1, '>', $sql_op2)
            ->count();
    }
}
