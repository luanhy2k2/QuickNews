<?php

namespace App\Enums;

enum Approval: string {
    case Pending = 'pending';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
}
