<?php

namespace App\Modules\Admin\Status\Controllers\Api;

use App\Modules\Admin\Status\Models\Status;
use App\Http\Controllers\Controller;
use App\Services\Response\ResponseService;

class StatusesController extends Controller
{
    public function index()
    {
        $statuses = Status::all();

        return ResponseService::sendJsonResponse(true, 200, [], [
            'items' => $statuses->toArray()
        ]);
    }
}
