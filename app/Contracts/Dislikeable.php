<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Dislikeable
{
    public function dislikes(): MorphMany;
}
