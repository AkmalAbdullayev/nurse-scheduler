<?php

namespace App\helpers\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface INurse
{
    /**
     * @return Builder[]|Collection
     */
    public function all(): Builder|Collection;

    /**
     * @param int $id
     * @return Model|Collection|Builder|array|null
     */
    public function find(int $id): Model|Collection|Builder|array|null;

    /**
     * @param int $id
     * @return object|null
     */
    public function getNurseByUserId(int $id): ?object;
}
