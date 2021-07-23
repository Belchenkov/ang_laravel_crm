<?php

namespace App\Modules\Admin\Analytics\Controllers\Api;

use App\Modules\Admin\Analytics\Services\AnalyticService;
use App\Modules\Admin\Lead\Models\Lead;
use App\Services\Response\ResponseService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnalyticsController extends Controller
{
    private $service;

    public function __construct(AnalyticService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $this->authorize('create', new Lead());

        $leads = $this->service->getAnalytic($request);

        return ResponseService::sendJsonResponse(true, 200, [], [
            'leads' => $leads
        ]);
    }
}
