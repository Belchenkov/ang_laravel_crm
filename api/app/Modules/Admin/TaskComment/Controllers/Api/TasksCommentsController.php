<?php

namespace App\Modules\Admin\TaskComment\Controllers\Api;


use App\Modules\Admin\TaskComment\Models\TaskComment;
use App\Modules\Admin\TaskComment\Requests\TaskCommentRequest;
use App\Modules\Admin\TaskComment\Services\TaskCommentService;
use App\Services\Response\ResponseService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TasksCommentsController extends Controller
{

    private TaskCommentService $service;

    public function __construct(TaskCommentService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $this->authorize('view', TaskComment::class);

        $result = $this->service->getTaskComments(auth()->id());

        return ResponseService::sendJsonResponse(true, 200, [], [
            'items' => $result
        ]);
    }

    public function store(TaskCommentRequest $request): JsonResponse
    {
        $this->authorize('edit', TaskComment::class);

        $task = $this->service->store($request, auth()->user());

        return ResponseService::sendJsonResponse(true, 200, [], [
            'item' => $task
        ]);
    }
}
