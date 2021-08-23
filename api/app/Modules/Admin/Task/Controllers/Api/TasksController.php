<?php

namespace App\Modules\Admin\Task\Controllers\Api;

use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\Task\Requests\TaskRequest;
use App\Modules\Admin\Task\Services\TaskService;
use App\Http\Controllers\Controller;
use App\Services\Response\ResponseService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{

    private TaskService $service;

    /**
     * LeadController constructor.
     * @param TaskService $service
     */
    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        //check access
        $this->authorize('view', Task::class);

        $result = $this->service->getTasks();

        return ResponseService::sendJsonResponse(true, 200, [], [
            'items' => $result
        ]);
    }


    /**
     * @throws AuthorizationException
     */
    public function archive(): JsonResponse
    {
        //check access
        $this->authorize('view', Task::class);

        $tasks = $this->service->archive();

        return ResponseService::sendJsonResponse(true, 200, [], [
            'items' => $tasks
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(TaskRequest $request): JsonResponse
    {
        //check access
        $this->authorize('save', Task::class);

        return ResponseService::sendJsonResponse(true, 200, [],[
            'item' => $this->service->store($request, Auth::user())
        ]);

    }

    /**
     * @throws AuthorizationException
     */
    public function show(Task $task): JsonResponse
    {
        //check access
        $this->authorize('view', Task::class);
        //
        return ResponseService::sendJsonResponse(true, 200, [], [
            'item' => $task
        ]);
    }

}
