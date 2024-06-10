<?php

namespace App\Models;

use App\Observers\SchoolObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ObservedBy([SchoolObserver::class])]
class School extends Model
{
    use HasFactory;
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,UserSchool::class);
    }
    
}
