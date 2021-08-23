<?php

namespace App\Modules\Admin\Lead\Controllers\Api;

use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Lead\Requests\LeadCreateRequest;
use App\Modules\Admin\Lead\Services\LeadService;
use App\Modules\Admin\LeadComment\Models\LeadComment;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    private $service;

    public function __construct(LeadService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->authorize('view', new Lead());

        $result = $this->service->getLeads();

        return ResponseService::sendJsonResponse(true, 200, [], [
            'leads' => $result
        ]);
    }


    public function show(Lead $lead): JsonResponse
    {
        $this->authorize('view', new Lead());

        return ResponseService::sendJsonResponse(true, 200, [], [
            'lead' => $lead
        ]);
    }

    public function store(LeadCreateRequest $request): JsonResponse
    {
        $this->authorize('create', new Lead());

        $lead = $this->service->store($request, Auth::user());

        return ResponseService::sendJsonResponse(true, 201, [], [
            'lead' => $lead
        ]);
    }

    public function update(LeadCreateRequest $request, Lead $lead): JsonResponse
    {
        $this->authorize('create', Lead::class);

        $lead = $this->service->update($request, Auth::user(), $lead);

        return ResponseService::sendJsonResponse(true, 200, [], [
            'lead' => $lead
        ]);
    }

    public function archive(): JsonResponse
    {
        $this->authorize('view', Lead::class);

        $leads = $this->service->archive();

        return ResponseService::sendJsonResponse(true, 200, [], [
            'leads' => $leads
        ]);
    }

    public function checkExist(Request $request): JsonResponse
    {
        $this->authorize('create', Lead::class);

        $lead = $this->service->checkExist($request);

        if (! $lead) {
            return ResponseService::success();
        }

        return ResponseService::sendJsonResponse(true, 200, [], [
            'item' => $lead,
            'exist' => true
        ]);
    }

    public function getAddSaleCount(): JsonResponse
    {
        $count = $this->service->getAddSaleCount();
        return ResponseService::sendJsonResponse(true, 200, [], [
            'number' => $count
        ]);
    }

    public function updateQuality(Lead $lead): JsonResponse
    {
        $this->authorize('create', Lead::class);

        $lead = $this->service->updateQuality($lead);

        return ResponseService::sendJsonResponse(true, 200, [], [
            'lead' => $lead
        ]);
    }
}
