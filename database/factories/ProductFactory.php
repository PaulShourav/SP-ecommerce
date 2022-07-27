<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition()
    {
        return [
            // 'name'=>$this->faker->catchPhrase,
            // 'slug'=>Str::slug($this->faker->catchPhrase),
            // 'name'=>$this->faker->catchPhrase,
        ];
    }
}
