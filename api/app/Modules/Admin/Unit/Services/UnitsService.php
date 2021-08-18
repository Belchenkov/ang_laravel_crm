<?php

namespace App\Modules\Admin\Unit\Services;

use App\Modules\Admin\Unit\Models\Unit;

class UnitsService
{
    public function getUnits()
    {
        return Unit::all();
    }
}
