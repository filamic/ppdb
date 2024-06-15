<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
 
class StudentTimeline extends Pivot
{
    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['student'];

    protected $table = 'student_timeline';
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}