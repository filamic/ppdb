<?php

namespace App\Observers;

use App\Models\Guardian;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class GuardianObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Guardian "creating" event.
     */
    public function creating(Guardian $guardian): void
    {
        $guardian->user_id = auth()->id();
    }
    /**
     * Handle the Guardian "created" event.
     */
    public function created(Guardian $guardian): void
    {
        $studentIds = auth()->user()->students->pluck('id')->toArray();
        $guardian->students()->syncWithoutDetaching($studentIds);
    }

    /**
     * Handle the Guardian "updated" event.
     */
    public function updated(Guardian $guardian): void
    {
        //
    }

    /**
     * Handle the Guardian "deleted" event.
     */
    public function deleted(Guardian $guardian): void
    {
        //
    }

    /**
     * Handle the Guardian "restored" event.
     */
    public function restored(Guardian $guardian): void
    {
        //
    }

    /**
     * Handle the Guardian "force deleted" event.
     */
    public function forceDeleted(Guardian $guardian): void
    {
        //
    }
}
