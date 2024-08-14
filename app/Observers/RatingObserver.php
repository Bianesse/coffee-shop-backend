<?php

namespace App\Observers;

use App\Models\Coffee;
use App\Models\Rating;

class RatingObserver
{
    /**
     * Handle the Rating "created" event.
     */
    public function created(Rating $rating): void
    {
        $this->updateRating($rating->coffees);
    }

    /**
     * Handle the Rating "updated" event.
     */
    public function updated(Rating $rating): void
    {
        $this->updateRating($rating->coffees);
    }

    /**
     * Handle the Rating "deleted" event.
     */
    public function deleted(Rating $rating): void
    {
        $this->updateRating($rating->coffees);
    }

    private function updateRating(Coffee $coffee)
    {
        $count = $coffee->ratings()->count('rating');
        $sum = $coffee->ratings()->sum('rating');

        $average = $count > 0 ? $sum / $count : 0;
        
        $coffee->update([
            'rate'=> $average,
        ]);
    }
}
