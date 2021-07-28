<?php

namespace App\Modules\Admin\TaskComment\Services;

use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\TaskComment\Models\TaskComment;
use App\Modules\Admin\TaskComment\Requests\TaskCommentRequest;
use App\Modules\Admin\User\Models\User;
use Illuminate\Http\Request;

class TaskCommentService
{

    public function getTaskComments(int $user_id)
    {
        return TaskComment::where('user_id', $user_id)->get();
    }

    public static function saveComment(
        string $text,
        Task $task,
        User $user,
        Status $status,
        string $comment_value = null,
        $is_event = false
    ): TaskComment
    {
        $comment = new TaskComment();
        $comment->text = $text;
        $comment->comment_value = $comment_value;
        $comment->is_event = $is_event;
        $comment
            ->task()
            ->associate($task)
            ->user()
            ->associate($user)
            ->status()
            ->associate($status)
            ->save();

        return $comment;
    }

    public function store(TaskCommentRequest $request, User $user): Task
    {
        $task = Task::findOrFail($request->task_id);

        if ($task) {
            $status = Status::findOrFail($request->status_id);

            $task->responsible_id = $request->responsible_id;

            if ($request->status_id !== $task->status_id) {
                $task->status()->associate($status);
                $task->statuses()->attach($status->id);

                $tmpText = "Пользователь <strong>"
                    . $user->full_name
                    . '</strong> изменил <strong>статус</strong> на '
                    . $status->title_ru;
                self::saveComment(
                    $tmpText,
                    $task,
                    $user,
                    $status,
                    null,
                    true
                );
            }

            $task->save();

            if (isset($request->text) && $request->text !== "") {
                $tmpText = "Пользователь <strong>"
                    . $user->full_name
                    . '</strong> оставил <strong>комментарий</strong> '
                    . $request->text;
                self::saveComment($tmpText, $task, $user, $status, $request->text);
            }

        }

        return $task;
    }
}
