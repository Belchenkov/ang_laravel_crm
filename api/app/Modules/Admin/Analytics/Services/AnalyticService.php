<?php


namespace App\Modules\Admin\Analytics\Services;


use App\Services\Date\Facade\DateService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticService
{
    public function getAnalytic(Request $request): array
    {
        $date_start = Carbon::now();
        $date_end = Carbon::now();

        if ($request->date_start && DateService::isValid($date_start, 'd.m.Y') ) {
            $date_start = Carbon::parse($request->date_start);
        }

        if ($request->date_end && DateService::isValid($date_end, 'd.m.Y') ) {
            $date_end = Carbon::parse($request->date_end);
        }

        return DB::select(
            'CALL countLeads("'
                        . $date_start->format('Y-m-d')
                        . '", "'
                        . $date_end->format('Y-m-d') .
            '")'
        );
    }
}
