<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name,
            "email" => $this->faker->email,
            "url" => $this->faker->email,
            "domain" => $this->faker->url,
            "session_code" => $this->faker->randomDigit(),
            "status" => rand(0,1),
            "plan" =>"pro",
        ];
    }
}
