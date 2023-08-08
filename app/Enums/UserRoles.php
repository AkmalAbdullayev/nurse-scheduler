<?php

namespace App\Enums;

use JetBrains\PhpStorm\Pure;

enum UserRoles: string
{
    case ADMIN = 'Admin';
    case PERM_SCHOOL_NURSE = 'Perm School Nurse';
    case FULL_TIME_FLOAT_NURSE = 'Full Time Float Nurse';
    case FLOAT_NURSE = 'Float Nurse';
    case SCHOOL = 'School'; // -> should be renamed Agency

    /**
     * @return array
     */
    #[Pure] public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * @return array
     */
    #[Pure] public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return array_combine(self::names(), self::values());
    }

    /**
     * @param mixed $keys
     * @return array
     */
    public static function only(mixed $keys): array
    {
        return is_array($keys) ? $keys : [$keys];
    }
}
