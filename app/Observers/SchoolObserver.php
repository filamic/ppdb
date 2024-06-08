<?php

namespace App\Observers;

use App\Models\School;
use Illuminate\Support\Str;

class SchoolObserver
{
    /**
     * Handle the School "creating" event.
     */
    public function creating(School $school): void
    {
        $school->slug = Str::slug($school->name.'-'.Str::random(8));
    }
    /**
     * Handle the School "created" event.
     */
    public function created(School $school): void
    {
        //
    }

    /**
     * Handle the School "updated" event.
     */
    public function updated(School $school): void
    {
        //
    }

    /**
     * Handle the School "deleted" event.
     */
    public function deleted(School $school): void
    {
        //
    }

    /**
     * Handle the School "restored" event.
     */
    public function restored(School $school): void
    {
        //
    }

    /**
     * Handle the School "force deleted" event.
     */
    public function forceDeleted(School $school): void
    {
        //
    }
}
