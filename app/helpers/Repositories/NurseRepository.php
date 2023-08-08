<?php

namespace App\helpers\Repositories;

use App\helpers\Repositories\Interfaces\INurse;
use App\Models\Nurse;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class NurseRepository implements INurse
{
    private Builder $query;

    public function __construct()
    {
        $this->query = Nurse::query();
    }

    private static function model(): Builder
    {
        return Nurse::query();
    }

    /**
     * @param int $id
     * @return Model|Collection|Builder|array|null
     */
    public function find(int $id): Model|Collection|Builder|array|null
    {
        return self::model()
            ->with(['credentials', 'medical_needs', 'desired_boroughs', 'role', 'call_outs', 'user', 'history'])
            ->findOrFail($id);
    }

    /**
     * @return Builder[]|Collection
     */
    public function all(): Builder|Collection
    {
        return self::model()
            ->with(['credentials', 'medical_needs', 'desired_boroughs', 'role', 'call_outs', 'user', 'history'])
            ->get();
    }

    /**
     * @param int $id
     * @return Builder|Nurse
     */
    public function getNurseByUserId(int $id): Builder|Nurse
    {
        return self::model()->where('user_id', '=', $id)->firstOrFail();
    }
}
