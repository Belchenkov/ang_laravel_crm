<?php

namespace App\Modules\Admin\Sources\Controllers\Api;

use App\Modules\Admin\Sources\Models\Source;
use App\Modules\Admin\Sources\Requests\SourceRequest;
use App\Modules\Admin\Sources\Services\SourceService;
use App\Services\Response\ResponseService;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class SourcesController extends Controller
{
    private $service;

    public function __construct(SourceService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        $this->authorize('view', new Source());

        return ResponseService::sendJsonResponse(true, 200, [], [
            'items' => $this->service->getSources()
        ]);
    }

    /**
     * @param SourceRequest $request
     * @return JsonResponse
     */
    public function store(SourceRequest $request): JsonResponse
    {
        $source = $this->service->save($request, new Source());

        return ResponseService::sendJsonResponse(true, 200, [], [
            'item' => $source->toArray()
        ]);
    }

    /**
     * @param SourceRequest $request
     * @param Source $source
     * @return JsonResponse
     */
    public function update(SourceRequest $request, Source $source): JsonResponse
    {
        $source = $this->service->save($request, $source);

        return ResponseService::sendJsonResponse(true, 200, [], [
            'item' => $source->toArray()
        ]);
    }

    public function destroy(Source $source)
    {
        $source->delete();

        return ResponseService::sendJsonResponse(true, 200, [], [
            'source' => $source->toArray()
        ]);
    }
}
