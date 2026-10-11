<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Item;
use App\Models\Check;
use App\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            Item::factory(4)
                ->for($user)
                ->create()
                ->each(function ($item) {
                    Check::factory(6)->for($item)->create();
                    Media::factory(7)->for($item)->create();
                });
        });
    }
}
