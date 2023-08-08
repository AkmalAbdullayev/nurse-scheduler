<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class History extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'historiable_type',
        'historiable_id',
        'actor_id',
        'body'
    ];

    protected $casts = [
        'body' => 'array',
    ];

    /**
     * @return MorphTo
     */
    public function historiable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return Attribute
     */
    protected function body(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value)
        );
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
}
