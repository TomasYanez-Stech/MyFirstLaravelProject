<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModelsProject>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $def = [
            "title" => fake("es_CL")->sentence(),
            "slug" => fake("es_CL")->slug(),
            "description" => fake("es_CL")->text()
        ];
        
        return $def;
    }
}
