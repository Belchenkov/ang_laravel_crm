<?php

namespace App\Modules\Admin\Unit\Controllers\Api;

use App\Services\Response\ResponseService;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Unit\Services\UnitsService;
use Illuminate\Http\JsonResponse;

class UnitsController extends Controller
{

    private UnitsService $service;

    /**
     * RoleController constructor.
     */
    public function __construct(UnitsService $unitsService)
    {
        $this->service = $unitsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return ResponseService::sendJsonResponse(true, 200, [], [
            'items' =>  $this->service->getUnits()
        ]);
    }
}
