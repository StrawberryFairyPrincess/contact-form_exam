<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'category_id' => $this->faker->numberBetween(1, 5),
            'last-name' => $this->faker->lastName(),
            'first-name' => $this->faker->firstName(),
            // 'gender' => $this->faker->randomElement(['男性', '女性', 'その他']),
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->safeEmail(),
            'tel' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'building' => $this->faker->word(),
            'detail' => $this->faker->realText(100,1)

        ];
    }
}
