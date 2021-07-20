<?php


namespace App\Modules\Admin\LeadComment\Services;


use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Lead\Requests\LeadCreateRequest;
use App\Modules\Admin\LeadComment\Models\LeadComment;
use App\Modules\Admin\LeadComment\Requests\LeadCommentRequest;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\User\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class LeadCommentService
{
    public static function saveComment(
        string $text,
        Lead $lead,
        User $user,
        Status $status,
        string $comment_value = null,
        bool $is_event = false
    ): LeadComment
    {
        $comment = new LeadComment([
            'text' => $text,
            'comment_value' => $comment_value
        ]);

        $comment->is_event = $is_event;
        $comment
            ->lead()->associate($lead)
            ->user()->associate($user)
            ->status()->associate($status)
            ->save();

        return $comment;
    }

    public function store(LeadCommentRequest $request, User $user): Lead
    {
        $lead = Lead::findOrFail($request->lead_id);
        $status = Status::findOrFail($request->status_id);

        if ($status->id !== $lead->status_id) {
            $lead->status()
                ->associate($status)
                ->update();

            $is_event = true;
            $tmp_text = 'Пользователь <strong>' . $user->full_name . '</strong> изменил статус лида ' . $status->title_ru;
            self::saveComment($tmp_text, $lead, $user, $status, null, $is_event);

            $lead->statuses()->attach($status->id);
        }

        if ($request->user_id && $request->user_id !== $lead->user_id) {
            $new_user = User::findOrFail($request->user_id);
            $lead->user()
                ->associate($new_user)
                ->update();

            $is_event = true;
            $tmp_text = 'Пользователь <strong>' . $user->full_name . '</strong> изменил автора лида на ' . $new_user->full_name;
            self::saveComment($tmp_text, $lead, $user, $status, null, $is_event);
        }

        if ($request->text) {
            $tmp_text = 'Пользователь <strong>' . $user->full_name . '</strong> оставил комментарий ' . $request->text;
            self::saveComment($tmp_text, $lead, $user, $status, $request->text);
        }

        return $lead;
    }
}
