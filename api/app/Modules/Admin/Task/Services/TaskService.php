<?php

namespace App\Modules\Admin\Task\Services;


use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\TaskComment\Services\TaskCommentService;
use App\Modules\Admin\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class TaskService
{

    public function getTasks(): array
    {
        $tasks = new Task();
        $tasks = $tasks->getTasks(Auth::user());
        $statuses = Status::all();
        $resultTasks = [];

        $statuses->each(function ($item) use (&$resultTasks, $tasks) {
            $collection = $tasks->where('status_id', $item->id);
            $resultTasks[$item->title] = $collection->map(function ($elem) {
                return $elem;
            });
        });

        return $resultTasks;
    }

    public function store($request, $user): Task
    {
        $task = new Task();
        $status = Status::where('title', 'new')->firstOrFail();

        $user
            ->tasks()
            ->save(
                $task
                    ->fill($request->except('comment'))
                    ->status()
                    ->associate($status)
            );

        $task->statuses()->attach($status->id);
        $this->addTasksComments($task, $user, $status, $request);

        return $task;
    }

    public function archive(): LengthAwarePaginator
    {
        return (new Task())->getArchives(Auth::user());
    }

    private function addTasksComments(
        Task $task,
        User $user,
        Status $status,
        Request $request
    ): void
    {
        $is_event = true;
        $tmpText = "Автор " . $user->full_name . ' создал адачу со статусом ' . $status->title_ru;
        TaskCommentService::saveComment(
            $tmpText,
            $task,
            $user,
            $status,
            null,
            $is_event
        );

        if (isset($request->text) && $request->text !== "") {
            $tmpText = "Пользователь <strong>"
                . $user->full_name
                . '</strong> оставил <strong>комментарий</strong> '
                . $request->text;
            TaskCommentService::saveComment($tmpText, $task, $user, $status, $request->text);
        }
    }
}
