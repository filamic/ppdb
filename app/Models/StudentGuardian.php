<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
 
class StudentGuardian extends Pivot
{
    protected $table = 'student_guardian';
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
 
    public function guardian(): BelongsTo
    {
        return $this->belongsTo(Guardian::class);
    }
}