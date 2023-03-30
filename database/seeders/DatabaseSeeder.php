<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Commentaire;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([UserSeeder::class]);
        $this->call([SiteSeeder::class]);
        $this->call([CommentaireSeeder::class]);
        $this->call([VoteSeeder::class]);
    }
}
