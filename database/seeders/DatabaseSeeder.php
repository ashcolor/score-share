<?php

namespace Database\Seeders;

use App\Models\Score;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(30)->create();

        $users = User::all();

        Score::factory(300)
            ->create()
            ->each(function ($score) use ($users) {
                $score->ownerships()->attach(
                    $users->random(rand(0,3))->pluck('id')->toArray()
                );
                $score->wants()->attach(
                    $users->random(rand(0,3))->pluck('id')->toArray()
                );
            });
    }
}
