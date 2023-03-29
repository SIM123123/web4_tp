<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'adresse_site' => $this->faker->domainName(),
            'description' => $this->faker->text(30),
            'nb_commentaires' => $this->faker->randomNumber(),
            'nb_votes' => $this->faker->randomNumber()
        ];
    }
}
