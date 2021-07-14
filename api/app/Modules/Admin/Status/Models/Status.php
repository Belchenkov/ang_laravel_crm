<?php

namespace App\Modules\Admin\Status\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public const NEW = 1;
    public const PROCESS = 2;
    public const DONE = 3;
}
