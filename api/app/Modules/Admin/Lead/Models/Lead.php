<?php

namespace App\Modules\Admin\Lead\Models;

use App\Modules\Admin\Analytics\Policies\AnalyticPolicy;
use App\Modules\Admin\LeadComment\Models\LeadComment;
use App\Modules\Admin\Sources\Models\Source;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\Unit\Models\Unit;
use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class Lead
 * @package App\Modules\Admin\Lead\Models
 * @property int user_id
 * @property int status_id
 * @property int count_create
 * @property int source_id
 * @property int unit_id
 * @property bool is_quality_lead
 * @property Source source
 * @property Unit unit
 * @property Status status
 */
class Lead extends Model
{
    use HasFactory, AnalyticPolicy;

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

    public function statuses(): BelongsToMany
    {
        return $this->belongsToMany(Status::class);
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

        return self::with([
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

    public function getArchive(): LengthAwarePaginator
    {
        $sql = DB::raw('DATE_SUB(NOW(), INTERVAL 24 HOUR)');

        return self::with([
            'statuses',
            'source',
            'unit'
        ])
        ->where('status_id', Status::DONE)
        ->where('updated_at', '<', $sql)
        ->orderBy('updated_at', 'desc')
        ->paginate(config('settings.pagination'));
    }

    public function renderData($load = true): array
    {
        if ($load) {
            $this->load(['source','unit','status']);
        }

        return [
            'id' => $this->id,
            'phone' => $this->phone,
            'link' => $this->link,
            'count_create' => $this->count_create,
            'is_processed' => $this->is_processed,
            'isQualityLead' => $this->is_quality_lead,
            'is_express_delivery' => $this->is_express_delivery,
            'is_add_sale' => $this->is_add_sale,
            'source_id' => $this->source_id,
            'unit_id' => $this->unit_id,
            'status_id' => $this->status_id,
            'created_at' => $this->created_at->toDateTimeString(),
//            'lastComment' =>  isset($this->lastComment()->comment_value)
//                ? $this->lastComment()->comment_value
//                : "",
            'created_at_time' => $this->created_at->timestamp,
            'source' => [
                'id' => $this->source->id,
                'title' => $this->source->title,
            ],
            'unit' => [
                'id' => $this->unit->id,
                'title' => $this->unit->title,
            ],
            'status' => [
                'id' => $this->status->id,
                'title' => $this->status->title_ru,
            ],
        ];
    }
}
