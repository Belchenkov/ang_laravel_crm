<?php

namespace App\Modules\Admin\Sources\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Source
 * @package App\Modules\Admin\Sources\Models
 * @property string title
 */
class Source extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];
}
