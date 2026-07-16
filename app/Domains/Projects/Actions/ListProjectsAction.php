<?php

namespace App\Domains\Projects\Actions;

use App\Domains\Projects\DTOs\ProjectFilterData;
use App\Domains\Projects\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ListProjectsAction
{
    /**
     * Execute the action to retrieve the projects list.
     *
     * @return Collection<int, Project>
     */
    public function execute(ProjectFilterData $dto): Collection
    {
        $query = Project::query();

        return $query->get();
    }
}
