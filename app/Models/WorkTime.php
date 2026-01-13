<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkTime extends Model
{
    protected $fillable = [
        'user_id',
        'start_at',
        'end_at',
        'duration_minutes',
        'status',
        'manager_note',
        'approved_by'
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
