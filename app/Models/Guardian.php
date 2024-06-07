<?php

namespace App\Models;

use App\Observers\GuardianObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

 
#[ObservedBy([GuardianObserver::class])]
class Guardian extends Model
{
    use HasFactory;

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class,StudentGuardian::class);
    }
}
