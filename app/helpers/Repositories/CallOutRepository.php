<?php

namespace App\helpers\Repositories;

use App\helpers\Repositories\Interfaces\ICallOut;
use App\Models\CallOut;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CallOutRepository implements ICallOut
{
    /**
     * @return Builder
     */
    private function model(): Builder
    {
        return CallOut::query();
    }

    /**
     * @return array|Collection
     */
    public function all(): array|Collection
    {
        return self::model()->get();
    }

    /**
     * @param int $id
     * @return array|Builder|Collection|Model|null
     */
    public function find(int $id): array|null|Builder|Collection|Model
    {
        return self::model()
            ->with(['nurse', 'school'])
            ->findOrFail($id);
    }
}
