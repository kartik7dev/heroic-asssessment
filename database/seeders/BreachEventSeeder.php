<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BreachEvent;
use App\Models\Identity;

class BreachEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $severities = ['Critical', 'High', 'Medium', 'Low'];
        $statuses = ['Resolved', 'Unresolved'];
        $sources = ['linkedin.com', 'github.com', 'twitter.com', 'slack.com'];

        foreach (Identity::all() as $identity) {
            for ($i = 1; $i <= 10; $i++) {
                BreachEvent::create([
                    'identity_id' => $identity->id,
                    'source' => $sources[array_rand($sources)],
                    'date' => now()->subDays(rand(10, 300)),
                    'severity' => $severities[array_rand($severities)],
                    'status' => $statuses[array_rand($statuses)],
                    'endpoint' => strtolower(str_replace(' ', '', $identity->name)) . '@gmail.com',
                    'data_types' => ['email', 'password', 'IP address'],
                ]);
            }
        }
    }
}
