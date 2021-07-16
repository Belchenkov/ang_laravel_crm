<?php

namespace App\Modules\Admin\Status\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * @package App\Modules\Admin\Status\Models
 * @property string title_ru
 */
class Status extends Model
{
    use HasFactory;

    public const NEW = 1;
    public const PROCESS = 2;
    public const DONE = 3;
}
