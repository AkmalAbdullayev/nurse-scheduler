<?php

namespace App\Enums;
enum CallOutStatuses: string
{
    case PENDING_ACCEPTANCE = 'Pending Acceptance';
    case ACCEPTED = 'Accepted';
    case CANCELLED = 'Cancelled';
}
