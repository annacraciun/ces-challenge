<?php

namespace App\Domains\Projects\Http\Controllers;

use App\Domains\Projects\Actions\ListProjectsAction;
use App\Domains\Projects\Http\Requests\ProjectFilterRequest;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index(ProjectFilterRequest $request, ListProjectsAction $action): Response
    {
        $dto = $request->toDto();

        $projects = $action->execute($dto);

        return Inertia::render('Projects/Index', [
            'projects' => $projects,
            'currentStatus' => $dto->status?->value,
        ]);
    }
}
