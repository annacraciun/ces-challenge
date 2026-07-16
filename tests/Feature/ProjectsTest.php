<?php

use App\Domains\Auth\Models\User;
use App\Domains\Projects\Models\Client;
use App\Domains\Projects\Models\Project;
use App\Domains\Projects\Enums\ProjectStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

uses(RefreshDatabase::class);

test('guests are redirected to the login page', function () {
    $this->get(route('projects.index'))
        ->assertRedirect(route('login'));
});

test('authenticated users can view projects list', function () {
    $user = User::factory()->create();
    $client = Client::create(['name' => 'Acme Corp']);
    
    Project::create([
        'client_id' => $client->id,
        'name' => 'Portal Gun',
        'status' => ProjectStatus::Active,
        'description' => 'Dimension travel device',
    ]);

    $this->actingAs($user)
        ->get(route('projects.index'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Projects/Index')
            ->has('projects', 1)
            ->where('projects.0.name', 'Portal Gun')
            ->where('projects.0.client.name', 'Acme Corp')
            ->where('currentStatus', null)
        );
});

test('projects can be filtered by active status', function () {
    $user = User::factory()->create();
    $client = Client::create(['name' => 'Acme Corp']);
    
    Project::create([
        'client_id' => $client->id,
        'name' => 'Active Project',
        'status' => ProjectStatus::Active,
    ]);

    Project::create([
        'client_id' => $client->id,
        'name' => 'Completed Project',
        'status' => ProjectStatus::Completed,
    ]);

    // This test will initially fail because status filtering is not implemented.
    $this->actingAs($user)
        ->get(route('projects.index', ['status' => 'active']))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Projects/Index')
            ->has('projects', 1)
            ->where('projects.0.name', 'Active Project')
            ->where('currentStatus', 'active')
        );
});
