<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\Site;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (Site::all() as $site) {
            $vote = new Vote();
            $vote->idSite = $site->id;
            $vote->idUser = $site->idUser;
            $vote->save();
        }
        Vote::factory()
            ->count(200)
            ->create();
    }
}
