<?php

namespace App\Enums;

enum Boroughs: string
{
    case STATEN_ISLAND = 'Staten Island';
    case BROOKLYN = 'Brooklyn';
    case MANHATTAN = 'Manhattan';
    case QUEENS = 'Queens';
    case BRONX = 'Bronx';

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function toArray(): array
    {
        return array_combine(self::values(), self::names());
    }
}
