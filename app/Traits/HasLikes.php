<?php

namespace App\Traits;

use App\Models\Like;
use CyrildeWit\EloquentViewable\Support\Period;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @method static self|Builder orderByLikes(string $direction = 'desc', $period = null, string $collection = null, $as = 'likes_count')
 **/
trait HasLikes
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function scopeOrderByLikes(
        Builder $query,
        string  $direction = 'desc',
        ?Period $period = null,
        ?string $collection = null,
        string  $as = 'views_count'
    ): Builder
    {
        return $query->withLikesCount($period, $collection, $as)
            ->orderBy($as, $direction);
    }

    public function scopeWithLikesCount(Builder $query, ?Period $period = null, ?string $collection = null, string $as = 'likes_count'): Builder
    {
        return $query->withCount(["likes as ${as}" => function (Builder $query) use ($period, $collection) {
            if ($period) {
                $query->withinPeriod($period);
            }

            if ($collection) {
                $query->collection($collection);
            }
        }]);
    }
}
