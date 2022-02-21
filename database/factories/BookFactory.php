<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'author_id' => Author::query()->get()->random(1)->first()->id,
            'title' => ucfirst($this->faker->sentence(2, false))
        ];
    }
}
