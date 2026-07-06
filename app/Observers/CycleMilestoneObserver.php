<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\CycleMilestone;

class CycleMilestoneObserver
{
    /**
     * Handle the CycleMilestone "created" event.
     */
    public function created(CycleMilestone $milestone): void
    {
        Activity::create([
            'subject_type' => CycleMilestone::class,
            'subject_id' => $milestone->id,
            'cycle_id' => $milestone->cycle_id,
            'user_id' => auth()->id(),
            'type' => 'milestone_created',
            'title' => 'Milestone Created',
            'description' => "Milestone {$milestone->title} was added.",
            'properties' => [
                'type' => $milestone->type,
                'scheduled_date' => $milestone->scheduled_date,
            ],
        ]);
    }

    /**
     * Handle the CycleMilestone "updated" event.
     */
    public function updated(CycleMilestone $milestone): void
    {
        if ($milestone->wasChanged('completed') && $milestone->completed) {
            Activity::create([
                'subject_type' => CycleMilestone::class,
                'subject_id' => $milestone->id,
                'cycle_id' => $milestone->cycle_id,
                'user_id' => auth()->id(),
                'type' => 'milestone_completed',
                'title' => 'Milestone Completed',
                'description' => "Milestone {$milestone->title} was completed.",
                'properties' => [
                    'type' => $milestone->type,
                    'completed_date' => $milestone->completed_date,
                ],
            ]);
        }

        if ($milestone->wasChanged('scheduled_date')) {
            Activity::create([
                'subject_type' => CycleMilestone::class,
                'subject_id' => $milestone->id,
                'cycle_id' => $milestone->cycle_id,
                'user_id' => auth()->id(),
                'type' => 'milestone_rescheduled',
                'title' => 'Milestone Rescheduled',
                'description' => "Milestone {$milestone->title} was rescheduled.",
                'properties' => [
                    'old_scheduled_date' => $milestone->getOriginal('scheduled_date'),
                    'new_scheduled_date' => $milestone->scheduled_date,
                ],
            ]);
        }

        if ($milestone->wasChanged('title') || $milestone->wasChanged('type')) {
            Activity::create([
                'subject_type' => CycleMilestone::class,
                'subject_id' => $milestone->id,
                'cycle_id' => $milestone->cycle_id,
                'user_id' => auth()->id(),
                'type' => 'milestone_updated',
                'title' => 'Milestone Updated',
                'description' => "Milestone {$milestone->title} was updated.",
                'properties' => [
                    'old_title' => $milestone->getOriginal('title'),
                    'new_title' => $milestone->title,
                    'old_type' => $milestone->getOriginal('type'),
                    'new_type' => $milestone->type,
                ],
            ]);
        }
    }

    /**
     * Handle the CycleMilestone "deleted" event.
     */
    public function deleted(CycleMilestone $milestone): void
    {
        Activity::create([
            'subject_type' => CycleMilestone::class,
            'subject_id' => $milestone->id,
            'cycle_id' => $milestone->cycle_id,
            'user_id' => auth()->id(),
            'type' => 'milestone_deleted',
            'title' => 'Milestone Deleted',
            'description' => "Milestone {$milestone->title} was deleted.",
        ]);
    }

    /**
     * Handle the CycleMilestone "restored" event.
     */
    public function restored(CycleMilestone $cycleMilestone): void
    {
        //
    }

    /**
     * Handle the CycleMilestone "force deleted" event.
     */
    public function forceDeleted(CycleMilestone $cycleMilestone): void
    {
        //
    }
}
