<?php

namespace App\Models\Traits\School;

use Illuminate\Database\Eloquent\Builder;

trait HasScopes
{
    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', '=', 1);
    }
}
