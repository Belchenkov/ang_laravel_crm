<?php

namespace App\Modules\Admin\TaskComment\Models;

use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TaskComment
 * @package App\Modules\Admin\TaskComment\Models
 * @property string text
 * @property string|null comment_value
 * @property bool is_event
 */
class TaskComment extends Model
{
    protected $fillable = [
        'text',
        'comment_value',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
