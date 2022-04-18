<?php

namespace App\Traits;

use App\Models\Dislike;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasDislikes
{
    public function dislikes(): MorphMany
    {
        return $this->morphMany(Dislike::class, 'dislikeable');
    }
}
