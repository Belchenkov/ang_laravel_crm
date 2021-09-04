<?php

namespace App\Modules\Admin\LeadComment\Controllers\Api;

use App\Modules\Admin\LeadComment\Models\LeadComment;
use App\Modules\Admin\LeadComment\Requests\LeadCommentRequest;
use App\Modules\Admin\LeadComment\Services\LeadCommentService;
use App\Services\Response\ResponseService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LeadCommentController extends Controller
{
    private $service;

    public function __construct(LeadCommentService $service)
    {
        $this->service = $service;
    }

    public function store(LeadCommentRequest $request)
    {
        $this->authorize('create', LeadComment::class);

        $lead = $this->service->store($request, Auth::user());

        return ResponseService::sendJsonResponse(true, 200, [], [
            'item' => $lead->renderData()
        ]);
    }
}
