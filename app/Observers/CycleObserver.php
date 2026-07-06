<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Cycles;

class CycleObserver
{
    /**
     * Handle the Cycles "created" event.
     */
    public function created(Cycles $cycle): void
    {
        Activity::create([
            'subject_type' => Cycles::class,
            'subject_id' => $cycle->id,
            'cycle_id' => $cycle->id,
            'user_id' => auth()->id(),
            'type' => 'cycle_created',
            'title' => 'Cycle Created',
            'description' => "Cycle {$cycle->cycle_code} was created.",
        ]);
    }

    /**
     * Handle the Cycles "updated" event.
     */
    public function updated(Cycles $cycle): void
    {
        if ($cycle->wasChanged('status')) {
            Activity::create([
                'subject_type' => Cycles::class,
                'subject_id' => $cycle->id,
                'cycle_id' => $cycle->id,
                'user_id' => auth()->id(),
                'type' => 'cycle_status_updated',
                'title' => 'Cycle Status Updated',
                'description' => "Cycle {$cycle->cycle_code} status changed from {$cycle->getOriginal('status')} to {$cycle->status}.",
                'properties' => [
                    'old_status' => $cycle->getOriginal('status'),
                    'new_status' => $cycle->status,
                ],
            ]);
        }

        if ($cycle->wasChanged('growth_stage')) {
            Activity::create([
                'subject_type' => Cycles::class,
                'subject_id' => $cycle->id,
                'cycle_id' => $cycle->id,
                'user_id' => auth()->id(),
                'type' => 'cycle_growth_stage_updated',
                'title' => 'Growth Stage Updated',
                'description' => "Cycle {$cycle->cycle_code} growth stage changed from {$cycle->getOriginal('growth_stage')} to {$cycle->growth_stage}.",
                'properties' => [
                    'old_growth_stage' => $cycle->getOriginal('growth_stage'),
                    'new_growth_stage' => $cycle->growth_stage,
                ],
            ]);
        }

        if ($cycle->wasChanged('overall_progress')) {
            Activity::create([
                'subject_type' => Cycles::class,
                'subject_id' => $cycle->id,
                'cycle_id' => $cycle->id,
                'user_id' => auth()->id(),
                'type' => 'cycle_progress_updated',
                'title' => 'Cycle Progress Updated',
                'description' => "Cycle {$cycle->cycle_code} progress updated to {$cycle->overall_progress}%.",
                'properties' => [
                    'old_progress' => $cycle->getOriginal('overall_progress'),
                    'new_progress' => $cycle->overall_progress,
                ],
            ]);
        }

        if ($cycle->wasChanged('actual_harvest_date')) {
            Activity::create([
                'subject_type' => Cycles::class,
                'subject_id' => $cycle->id,
                'cycle_id' => $cycle->id,
                'user_id' => auth()->id(),
                'type' => 'cycle_harvest_date_updated',
                'title' => 'Harvest Date Updated',
                'description' => "Cycle {$cycle->cycle_code} actual harvest date was set to {$cycle->actual_harvest_date}.",
                'properties' => [
                    'old_actual_harvest_date' => $cycle->getOriginal('actual_harvest_date'),
                    'new_actual_harvest_date' => $cycle->actual_harvest_date,
                ],
            ]);
        }
    }

    /**
     * Handle the Cycles "deleted" event.
     */
    public function deleted(Cycles $cycle): void
    {
        Activity::create([
            'subject_type' => Cycles::class,
            'subject_id' => $cycle->id,
            'cycle_id' => $cycle->id,
            'user_id' => auth()->id(),
            'type' => 'cycle_deleted',
            'title' => 'Cycle Deleted',
            'description' => "Cycle {$cycle->cycle_code} was deleted.",
        ]);
    }

    /**
     * Handle the Cycles "restored" event.
     */
    public function restored(Cycles $cycles): void
    {
        //
    }

    /**
     * Handle the Cycles "force deleted" event.
     */
    public function forceDeleted(Cycles $cycles): void
    {
        //
    }
}
