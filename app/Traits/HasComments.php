<?php

namespace App\Traits;

use CyrildeWit\EloquentViewable\Support\Period;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static self|Builder orderByComments(string $direction = 'desc', $period = null, string $collection = null, $as = 'comments_count')
 **/
trait HasComments
{
    public function scopeOrderByComments(
        Builder $query,
        string  $direction = 'desc',
        ?Period $period = null,
        ?string $collection = null,
        string  $as = 'comments_count'
    ): Builder
    {
        return $query->withCommentsCount($period, $collection, $as)
            ->orderBy($as, $direction);
    }

    public function scopeWithCommentsCount(Builder $query, ?Period $period = null, ?string $collection = null, string $as = 'comments_count'): Builder
    {
        return $query->withCount(["comments as ${as}" => function (Builder $query) use ($period, $collection) {
            if ($period) {
                $query->withinPeriod($period);
            }

            if ($collection) {
                $query->collection($collection);
            }
        }]);
    }
}
