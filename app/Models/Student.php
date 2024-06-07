<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Scopes\MyStudentScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;


#[ScopedBy([MyStudentScope::class])]
class Student extends Model
{
    use HasFactory;

    /**
     * Interact with the user's first name.
     */
    // protected function classLevelProposed(): Attribute
    // {
    //     return Attribute::make(
    //         // get: fn (int $value, array $attributes) => dd($value,$attributes),
    //         get: fn (int $value, array $attributes) => dd($value,$attributes),
    //     );
    // }
    // protected function classLevelProposedName(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (int $value, array $attributes) => $value,
    //     );
    // }
    public function getClassLevelProposedNameAttribute()
    {
        return ClassLevel::find($this->class_level_proposed)->name;
    }
    

    /**
     * Interact with the user's sex.
     */
    public function getSexImgAttribute()
    {
        return Sex::find($this->sex)->img;
    }
    
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Student $student) {
            $student->user_id = auth()->id();
            $student->registration_number = Str::random(32);
        });
    }
}
