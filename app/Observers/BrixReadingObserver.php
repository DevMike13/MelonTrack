<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\BrixReading;

class BrixReadingObserver
{
    /**
     * Handle the BrixReading "created" event.
     */
    public function created(BrixReading $brix): void
    {
        Activity::create([
            'subject_type' => BrixReading::class,
            'subject_id' => $brix->id,
            'cycle_id' => $brix->cycle_id,
            'user_id' => auth()->id(),
            'type' => 'brix_created',
            'title' => 'Brix Reading Added',
            'description' => "Brix reading of {$brix->brix_level} °Bx was added.",
            'properties' => [
                'brix_level' => $brix->brix_level,
                'reading_at' => $brix->reading_at,
                'remarks' => $brix->remarks,
            ],
        ]);
    }

    /**
     * Handle the BrixReading "updated" event.
     */
    public function updated(BrixReading $brix): void
    {
        Activity::create([
            'subject_type' => BrixReading::class,
            'subject_id' => $brix->id,
            'cycle_id' => $brix->cycle_id,
            'user_id' => auth()->id(),
            'type' => 'brix_updated',
            'title' => 'Brix Reading Updated',
            'description' => "Brix reading was updated.",
            'properties' => [
                'old_brix_level' => $brix->getOriginal('brix_level'),
                'new_brix_level' => $brix->brix_level,
                'old_reading_at' => $brix->getOriginal('reading_at'),
                'new_reading_at' => $brix->reading_at,
                'old_remarks' => $brix->getOriginal('remarks'),
                'new_remarks' => $brix->remarks,
            ],
        ]);
    }

    /**
     * Handle the BrixReading "deleted" event.
     */
    public function deleted(BrixReading $brix): void
    {
        Activity::create([
            'subject_type' => BrixReading::class,
            'subject_id' => $brix->id,
            'cycle_id' => $brix->cycle_id,
            'user_id' => auth()->id(),
            'type' => 'brix_deleted',
            'title' => 'Brix Reading Deleted',
            'description' => "Brix reading of {$brix->brix_level} °Bx was deleted.",
        ]);
    }

    /**
     * Handle the BrixReading "restored" event.
     */
    public function restored(BrixReading $brixReading): void
    {
        //
    }

    /**
     * Handle the BrixReading "force deleted" event.
     */
    public function forceDeleted(BrixReading $brixReading): void
    {
        //
    }
}
