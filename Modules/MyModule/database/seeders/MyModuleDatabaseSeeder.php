<?php

namespace Modules\MyModule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Modules\MyModule\Models\Category;
use Modules\MyModule\Models\Post;

class MyModuleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $userId = User::query()->inRandomOrder()->value('id');
            if (!$userId) {
                $this->command?->warn('Brak użytkowników – pomijam seedowanie MyModule.');
                return;
            }

            $categories = Category::factory()
                ->count(fake()->numberBetween(5, 8))
                ->state(['user_id' => $userId])
                ->create();

            Post::factory()
                ->count(fake()->numberBetween(10, 15))
                ->state(fn () => [
                    'user_id' => $userId,
                    'category_id' => $categories->random()->id,
                ])
                ->create();
        });
    }
}
