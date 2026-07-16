<?php

namespace App\Domains\Projects\Enums;

enum ProjectStatus: string
{
    case Active = 'active';
    case Completed = 'completed';
}
