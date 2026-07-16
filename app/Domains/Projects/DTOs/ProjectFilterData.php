<?php

namespace App\Domains\Projects\DTOs;

use App\Domains\Projects\Enums\ProjectStatus;

readonly class ProjectFilterData
{
    public function __construct(
        public ?ProjectStatus $status = null,
    ) {}
}
