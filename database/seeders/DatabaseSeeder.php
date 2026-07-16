<?php

namespace Database\Seeders;

use App\Domains\Auth\Models\User;
use App\Domains\Projects\Models\Client;
use App\Domains\Projects\Models\Project;
use App\Domains\Projects\Enums\ProjectStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $clients = collect([
            Client::create(['name' => 'Acme Corp']),
            Client::create(['name' => 'Stark Industries']),
            Client::create(['name' => 'Wayne Enterprises']),
        ]);

        $projectData = [
            ['name' => 'Portal Gun Project', 'status' => ProjectStatus::Active, 'description' => 'Developing a device to travel between dimensions.'],
            ['name' => 'Arc Reactor Upgrade', 'status' => ProjectStatus::Completed, 'description' => 'Replacing the palladium core with a new element.'],
            ['name' => 'Batcave Security System', 'status' => ProjectStatus::Active, 'description' => 'Installing motion sensors and facial recognition.'],
            ['name' => 'Web Crawler Bot', 'status' => ProjectStatus::Completed, 'description' => 'Automated search engine indexing and analysis.'],
            ['name' => 'Sentry Drone Fleet', 'status' => ProjectStatus::Active, 'description' => 'Autonomous aerial security patrolling.'],
            ['name' => 'Mark LXXXV Suit', 'status' => ProjectStatus::Completed, 'description' => 'Nanotech armor design and testing.'],
            ['name' => 'Gotham Grid Protection', 'status' => ProjectStatus::Active, 'description' => 'Backup generators and satellite monitoring.'],
            ['name' => 'Satellite Laser Grid', 'status' => ProjectStatus::Active, 'description' => 'Global defense orbital laser array.'],
            ['name' => 'Vibranium Shield Alloys', 'status' => ProjectStatus::Completed, 'description' => 'Synthesizing vibranium with steel alloys.'],
            ['name' => 'Clean Energy Grid', 'status' => ProjectStatus::Active, 'description' => 'Tapping into geothermal energy for Gotham.'],
        ];

        foreach ($projectData as $p) {
            Project::create([
                'client_id' => $clients->random()->id,
                'name' => $p['name'],
                'status' => $p['status'],
                'description' => $p['description'],
            ]);
        }
    }
}

