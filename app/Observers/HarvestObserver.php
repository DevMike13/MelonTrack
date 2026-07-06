<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Harvests;

class HarvestObserver
{
    /**
     * Handle the Harvests "created" event.
     */
    public function created(Harvests $harvest): void
    {
        Activity::create([
            'subject_type' => Harvests::class,
            'subject_id' => $harvest->id,
            'cycle_id' => $harvest->cycle_id,
            'user_id' => auth()->id(),
            'type' => 'harvest_created',
            'title' => 'Harvest Recorded',
            'description' => "{$harvest->harvest_count} melons were harvested.",
            'properties' => [
                'harvest_count' => $harvest->harvest_count,
                'date_harvested' => $harvest->date_harvested,
                'status' => $harvest->status,
            ],
        ]);
    }

    /**
     * Handle the Harvests "updated" event.
     */
    public function updated(Harvests $harvest): void
    {
        Activity::create([
            'subject_type' => Harvests::class,
            'subject_id' => $harvest->id,
            'cycle_id' => $harvest->cycle_id,
            'user_id' => auth()->id(),
            'type' => 'harvest_updated',
            'title' => 'Harvest Updated',
            'description' => "Harvest record was updated.",
            'properties' => [
                'old_harvest_count' => $harvest->getOriginal('harvest_count'),
                'new_harvest_count' => $harvest->harvest_count,
                'old_date_harvested' => $harvest->getOriginal('date_harvested'),
                'new_date_harvested' => $harvest->date_harvested,
                'old_status' => $harvest->getOriginal('status'),
                'new_status' => $harvest->status,
            ],
        ]);
    }

    /**
     * Handle the Harvests "deleted" event.
     */
    public function deleted(Harvests $harvest): void
    {
        Activity::create([
            'subject_type' => Harvests::class,
            'subject_id' => $harvest->id,
            'cycle_id' => $harvest->cycle_id,
            'user_id' => auth()->id(),
            'type' => 'harvest_deleted',
            'title' => 'Harvest Deleted',
            'description' => "Harvest record with {$harvest->harvest_count} melons was deleted.",
        ]);
    }

    /**
     * Handle the Harvests "restored" event.
     */
    public function restored(Harvests $harvests): void
    {
        //
    }

    /**
     * Handle the Harvests "force deleted" event.
     */
    public function forceDeleted(Harvests $harvests): void
    {
        //
    }
}
