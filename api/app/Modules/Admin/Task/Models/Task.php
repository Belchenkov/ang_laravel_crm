<?php

namespace App\Modules\Admin\Task\Models;

use App\Modules\Admin\Sources\Models\Source;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\TaskComment\Models\TaskComment;
use App\Modules\Admin\Unit\Models\Unit;
use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    protected $fillable = [
        'link',
        'phone',
        'source_id',
        'unit_id',
        'user_id',
        'responsible_id',
    ];

    public function getTasks(User $user)
    {
        $builder = self::with(['source', 'unit', 'status'])
            ->where(function ($query) {
                $query->whereBetween('status_id', [Status::NEW, Status::PROCESS])
                    ->orWhere([
                        ['status_id', Status::DONE],
                        ['updated_at', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 24 HOUR)')],
                    ]);
            });

            if ($user->hasRole('manager')) {
                $builder->where(function ($query) use ($user) {
                    $query
                        ->where('user_id', $user->id)
                        ->orWhere('responsible_id', $user->id);
                });
            }

            return $builder
                    ->orderBy('created_at')
                    ->get();
    }

    public function getArchives(User $user): LengthAwarePaginator
    {
        $builder = self::with(['status', 'source', 'unit'])
            ->where(function ($query) {
                $query
                    ->where('updated_at', '<', DB::raw('DATE_SUB(NOW(), INTERVAL 24 HOUR)'))
                    ->where('status_id', Status::DONE);
            });

            if ($user->hasRole('manager')) {
                $builder->where(function ($query) use ($user) {
                    $query
                        ->where('user_id', $user->id)
                        ->orWhere('responsible_id', $user->id);
                });
            }

            return $builder
                        ->orderBy('updated_at','DESC')
                        ->paginate(config('settings.pagination'));
    }

    public function statuses(): BelongsToMany
    {
        return $this->belongsToMany(Status::class,'task_status');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }


    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function responsibleUser(): BelongsTo
    {
        return $this->belongsTo(User::class,'responsible_id','id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TaskComment::class);
    }

    public function lastComment()
    {
        return $this->comments()
            ->where('comment_value', '!=', NULL)
            ->orderBy('id','desc')
            ->first();
    }
}
