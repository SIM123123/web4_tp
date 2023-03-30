<?php

namespace Database\Factories;

use App\Models\Commentaire;
use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commentaire>
 */
class CommentaireFactory extends Factory
{
    protected $model = Commentaire::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'commentaire' => $this->faker->text(),
            'idSite' => Site::inRandomOrder()->first()->id
        ];
    }
}
