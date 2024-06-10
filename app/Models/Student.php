<?php

namespace App\Models;

use App\Observers\StudentObserver;
use App\Models\Scopes\MyStudentScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


#[ScopedBy([MyStudentScope::class])]
#[ObservedBy([StudentObserver::class])]
class Student extends Model
{
    use HasFactory;

    /**
     * Interact with the student's class level proposed.
     */
    // public function getClassLevelProposedNameAttribute()
    // {
    //     return ClassLevel::find($this->class_level_proposed)->name;
    // }
    

    /**
     * Interact with the user's sex.
     */
    public function getSexImgAttribute()
    {
        return Sex::find($this->sex)->img;
    }

    public function guardians(): BelongsToMany
    {
        return $this->belongsToMany(Guardian::class,StudentGuardian::class);
    }

    public function school(): BelongsTo    {
        return $this->belongsTo(School::class);
    }
}
