<?php

namespace App\Models\Traits\Nurse;

use Illuminate\Database\Eloquent\Builder;

trait HasScopes
{
    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeNotAdmin(Builder $query): Builder
    {
        return $query->whereDoesntHave('role', function ($query) {
            return $query->where('name', '=', 'Admin');
        });
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active_for_assignments', '=', 1);
    }

    /**
     * @param Builder $query
     * @param string $column
     * @param string $direction
     * @return Builder
     */
    public function scopeFilterBy(Builder $query, string $column, string $direction): Builder
    {
        return $query->orderBy($column, $direction);
    }

    /**
     * @param Builder $query
     * @param string $search
     * @return Builder
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        $search = mb_strtolower($search);

        return $query->whereHas('desired_boroughs', function ($query) use ($search) {
            return $query->whereRaw("LOWER(name) like '%$search%'");
        })
            ->orWhereHas('role', function ($query) use ($search) {
                return $query->whereRaw("LOWER(name) like '%$search%'");
            })
            ->orWhereRaw("LOWER(CONCAT(first_name, ' ', last_name)) like '%$search%'")
            ->orWhere('zip_code', 'like', "%$search%");
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeFloatNurses(Builder $query): Builder
    {
        return $query->whereHas('role', function ($query) {
            return $query->whereIn('name', ['Full Time Float Nurse', 'Float Nurse']);
        });
    }
}
