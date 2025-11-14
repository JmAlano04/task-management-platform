<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $creators = User::where('role', 'creator')->pluck('id')->toArray();
        $takers = User::where('role', 'taker')->pluck('id')->toArray();

        if (empty($creators) || empty($takers)) {
            $this->command->error('❌ No creators or takers found. Seed users first!');
            return;
        }

        $statuses = ['pending', 'in_progress', 'completed'];

        for ($i = 1; $i <= 20; $i++) {
            $creatorId = $creators[array_rand($creators)];
            $takerId = $takers[array_rand($takers)];

            Task::create([
                'title' => "Task #{$i} - " . Str::title(fake()->words(3, true)),
                'description' => fake()->sentence(8),
                'status' => $statuses[array_rand($statuses)],
                'creator_id' => $creatorId,
                'taker_id' => $takerId,
                'due_date' => fake()->dateTimeBetween('+1 days', '+30 days')->format('Y-m-d'),
            ]);
        }

        $this->command->info('20 tasks seeded successfully!');
    }
}
