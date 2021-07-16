<?php

namespace App\Modules\Admin\Lead\Controllers\Api;

use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Lead\Requests\LeadCreateRequest;
use App\Modules\Admin\Lead\Services\LeadService;
use App\Modules\Admin\LeadComment\Models\LeadComment;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Model;
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

    public function store(LeadCreateRequest $request)
    {
        $this->authorize('create', new Lead());

        $lead = $this->service->store($request, Auth::user());

        return ResponseService::sendJsonResponse(true, 201, [], [
            'lead' => $lead
        ]);
    }

    public function update(LeadCreateRequest $request, Lead $lead)
    {
        $this->authorize('create', Lead::class);

        $lead = $this->service->update($request, Auth::user(), $lead);

        return ResponseService::sendJsonResponse(true, 200, [], [
            'lead' => $lead
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Lead\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        //
    }
}
