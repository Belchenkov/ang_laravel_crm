<?php

namespace App\Modules\Admin\Analytics\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Analytics\Export\LeadsExport;
use App\Modules\Admin\User\Models\User;
use Excel;

class AnalyticsController extends Controller
{
    public function export(User $user, string $date_start, string $date_end)
    {
        $export = new LeadsExport($user, $date_start, $date_end);
        return Excel::download($export, 'leads.xlsx');
    }
}
