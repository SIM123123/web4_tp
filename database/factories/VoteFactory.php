<?php

namespace Database\Factories;

use App\Models\Site;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    protected $model = Vote::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition( ): array
    {
        return [
            'idUser' => User::inRandomOrder()->first()->id,
            'idSite' => Site::inRandomOrder()->first()->id
        ];
    }
}
