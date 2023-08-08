<?php

namespace App\helpers\Support;

use App\Enums\CallOutStatuses;
use App\Models\Nurse;
use Illuminate\Database\Eloquent\Collection;

class CallOutsCollection extends Collection
{
    /**
     * @param string $key
     * @param string $operator
     * @return CallOutsCollection
     */
    public function available(string $key, string $operator): self
    {
        return $this->where($key, $operator, now());
    }

    /**
     * @param array $values
     * @return CallOutsCollection
     */
    public function statusIn(array $values): self
    {
        return $this->whereIn('status', $values);
    }

    /**
     * @param array|Collection $values
     * @return CallOutsCollection
     */
    public function statusNotIn(array|Collection $values): self
    {
        return $this->whereNotIn('status', $values);
    }

    /**
     * @param string $key
     * @param string $value
     * @return CallOutsCollection
     */
    public function status(string $key, string $value): self
    {
        return $this->where($key, '=', $value);
    }

    /**
     * @return CallOutsCollection
     */
    public function notAccepted(): self
    {
        return $this->where('status', '!=', CallOutStatuses::ACCEPTED->value);
    }

    /**
     * @return CallOutsCollection
     */
    public function notCancelled(): self
    {
        return $this->where('status', '!=', CallOutStatuses::CANCELLED->value);
    }

    /**
     * @param Nurse $nurse
     * @return CallOutsCollection
     */
    public function currentNurse(Nurse $nurse): self
    {
        $this->when($this->contains('nurse_id', '=', $nurse->id), function () use ($nurse) {
            return $this->where('nurse_id', '=', $nurse->id);
        });

        $this->when($this->contains('nurse_id', '=', null), function () {
            return $this->where('nurse_id', '=', null);
        });

        return $this;
    }
}
