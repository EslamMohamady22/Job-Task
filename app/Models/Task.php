<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * $title = $title
 */

class Task extends Model
{
    protected $guarded = ['id'];
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'assigned_user_id');
    }
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
