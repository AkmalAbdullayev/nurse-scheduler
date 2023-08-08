<?php

namespace App\Enums;

enum AssignmentPrioritiy: string
{
    case A = 'a';
    case B = 'b';
    case C = 'c';
    case D = 'd';
    case E = 'e';
    case F = 'f';

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
