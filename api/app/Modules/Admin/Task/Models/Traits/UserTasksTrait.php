<?php

namespace App\Modules\Admin\Task\Models\Traits;


use App\Modules\Admin\Task\Models\Task;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserTasksTrait
{
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
    public function responsibleTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'responsible_id', 'id');
    }
}
