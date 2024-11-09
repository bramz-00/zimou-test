<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Store::class;
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->bothify('ST####'),
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->companyEmail,
            'phones' => $this->faker->phoneNumber,
            'company_name' => $this->faker->company,
            'capital' => $this->faker->randomNumber(5),
            'address' => $this->faker->address,
            'register_commerce_number' => $this->faker->numerify('RC#########'),
            'nif' => $this->faker->numerify('NIF#########'),
            'legal_form' => $this->faker->numberBetween(1, 5),
            'status' => $this->faker->numberBetween(0, 1),
            'can_update_preparing_packages' => $this->faker->boolean,
        ];
    }
}
