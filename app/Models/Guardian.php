<?php

namespace App\Models;

use App\Models\StudentGuardian;
use App\Observers\GuardianObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

 
#[ObservedBy([GuardianObserver::class])]
class Guardian extends Model
{
    use HasFactory;

    /**
     * Interact with the guardian's type.
     */
    public function getGuardianTypeNameAttribute()
    {
        return GuardianType::find($this->guardian_type)->name;
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class,StudentGuardian::class);
    }
}
