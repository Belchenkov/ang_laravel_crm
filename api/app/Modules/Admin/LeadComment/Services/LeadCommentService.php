<?php


namespace App\Modules\Admin\LeadComment\Services;


use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\LeadComment\Models\LeadComment;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\User\Models\User;

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
}
