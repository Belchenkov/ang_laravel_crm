<?php

namespace App\Modules\Admin\LeadComment\Models;

use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class LeadComment
 * @package App\Modules\Admin\LeadComment\Models
 * @property string text
 * @property bool is_event
 * @property string comment_value
 */
class LeadComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'comment_value'
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
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
