<?php

namespace Database\Factories;

use App\Models\Commune;
use App\Models\DeliveryType;
use App\Models\Package;
use App\Models\PackageStatus;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Package::class;
    public function definition(): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'tracking_code' => $this->faker->unique()->numerify('PKG########'),
            'commune_id' => Commune::inRandomOrder()->first()->id,
            'delivery_type_id' => DeliveryType::inRandomOrder()->first()->id,
            'status_id' => PackageStatus::inRandomOrder()->first()->id,
         
            'address' => $this->faker->address,
            'can_be_opened' => $this->faker->boolean,
            'name' => $this->faker->word,
            'client_first_name' => $this->faker->firstName,
            'client_last_name' => $this->faker->lastName,
            'client_phone' => $this->faker->phoneNumber,
            'client_phone2' => $this->faker->optional()->phoneNumber,
            'cod_to_pay' => $this->faker->randomFloat(2, 0, 1000),
            'commission' => $this->faker->randomFloat(2, 0, 50),
            'status_updated_at' => $this->faker->dateTimeThisYear,
            'delivered_at' => $this->faker->optional()->dateTimeThisYear,
            'delivery_price' => $this->faker->randomFloat(2, 5, 50),
            'extra_weight_price' => $this->faker->numberBetween(0, 10),
            'free_delivery' => $this->faker->boolean,
            'packaging_price' => $this->faker->numberBetween(0, 5),
            'partner_cod_price' => $this->faker->randomFloat(2, 0, 20),
            'partner_delivery_price' => $this->faker->numberBetween(0, 30),
            'partner_return' => $this->faker->randomFloat(2, 0, 20),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'price_to_pay' => $this->faker->randomFloat(2, 10, 500),
            'return_price' => $this->faker->numberBetween(0, 20),
            'total_price' => $this->faker->randomFloat(2, 50, 1000),
            'weight' => $this->faker->numberBetween(500, 5000),
        ];
    }
}
