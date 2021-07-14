<?php

namespace App\Modules\Admin\Lead\Models;

use App\Modules\Admin\LeadComment\Models\LeadComment;
use App\Modules\Admin\Sources\Models\Source;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\Unit\Models\Unit;
use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'phone',
        'source_id',
        'unit_id',
        'is_processed',
        'is_express_delivery',
        'is_add_sale',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(LeadComment::class);
    }

    public function lastComment(): HasMany
    {
        return $this->comments()
            ->where('comment_value', '!=', NULL)
            ->orderBy('id', 'desc')
            ->firstOrFail();
    }

    public function getLeads()
    {
        $sql = DB::raw('DATE_SUB(NOW(), INTERVAL 24 HOUR)');

        return $this->with([
                'source',
                'unit',
                'status'
            ])
            ->whereBetween('status_id', [Status::NEW, Status::PROCESS])
            ->orWhere([
                ['status_id', Status::DONE],
                ['updated_at', '>', $sql],
            ])
            ->orderBy('created_at')
            ->get();
    }
}
