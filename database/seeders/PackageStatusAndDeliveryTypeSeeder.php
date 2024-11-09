<?php

namespace Database\Seeders;

use App\Models\DeliveryType;
use App\Models\PackageStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageStatusAndDeliveryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packageStatuses = [
            ['name' => 'Pending'],
            ['name' => 'Shipped'],
            ['name' => 'In Transit'],
            ['name' => 'Delivered'],
            ['name' => 'Returned'],
            // Add more statuses as needed
        ];

        foreach ($packageStatuses as $status) {
            PackageStatus::create($status);
        }

        // Seed delivery types
        $deliveryTypes = [
            ['name' => 'Standard Delivery'],
            ['name' => 'Express Delivery'],
            ['name' => 'Same Day Delivery'],
            ['name' => 'Overnight Delivery'],
        ];

        foreach ($deliveryTypes as $type) {
            DeliveryType::create($type);
        }
    }
}
