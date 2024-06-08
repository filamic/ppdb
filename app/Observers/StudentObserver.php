<?php

namespace App\Observers;

use App\Models\Student;
use Illuminate\Support\Str;
use Filament\Facades\Filament;

class StudentObserver
{
    /**
     * Handle the Student "creating" event.
     */
    public function creating(Student $student): void
    {
        $student->user_id = auth()->id();
        $student->school_id = Filament::getTenant()->id;
        $student->registration_number = Str::random(32);
    }
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        $guardianIds = auth()->user()->guardians->pluck('id')->toArray();
        $student->guardians()->syncWithoutDetaching($guardianIds);
    }

    /**
     * Handle the Student "updating" event.
     */
    public function updating(Student $student): void
    {
        $student->school_id = Filament::getTenant()->id;
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
