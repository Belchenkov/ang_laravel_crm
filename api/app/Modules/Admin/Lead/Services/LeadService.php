<?php


namespace App\Modules\Admin\Lead\Services;


use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Lead\Requests\LeadCreateRequest;
use App\Modules\Admin\LeadComment\Services\LeadCommentService;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\User\Models\User;

class LeadService
{
    public function getLeads()
    {
        $leads = (new Lead())->getLeads();
        $statuses = Status::all();
        $resultLeads = [];

        $statuses->each(function ($item, $key) use (&$resultLeads, $leads) {
            $collection = $leads->where('status_id', $item->id);
            $resultLeads[$item->title] = $collection->map(function ($elem) {
                return $elem;
            });
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
}
