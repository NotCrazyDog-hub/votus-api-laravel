<?php

namespace App\Enums;

enum LegislatorStatus: string
{
    case Active = 'active';
    case OnLeave = 'on_leave';
    case Unknown = 'unknown';
}