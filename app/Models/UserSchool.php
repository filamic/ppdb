<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSchool extends Pivot
{
    protected $table = 'user_school';
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
 
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
