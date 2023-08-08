<?php

namespace App\helpers\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ICallOut
{
    /**
     * @return array|Collection
     */
    public function all(): array|Collection;

    /**
     * @param int $id
     * @return array|Builder|Collection|Model|null
     */
    public function find(int $id): array|null|Builder|Collection|Model;
}
