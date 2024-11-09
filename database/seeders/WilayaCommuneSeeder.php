<?php

namespace Database\Seeders;

use App\Models\Commune;
use App\Models\Wilaya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WilayaCommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $wilayas = [
            ['name' => 'Algiers'],
            ['name' => 'Oran'],
            ['name' => 'Constantine'],
            // Add more wilayas as needed
        ];

        foreach ($wilayas as $wilaya) {
            Wilaya::create($wilaya);
        }

        $communes = [
            ['name' => 'Bab El Oued', 'wilaya_id' => Wilaya::where('name', 'Algiers')->first()->id],
            ['name' => 'El Harrach', 'wilaya_id' => Wilaya::where('name', 'Algiers')->first()->id],
            ['name' => 'Bir El Djir', 'wilaya_id' => Wilaya::where('name', 'Oran')->first()->id],
            // Add more communes as needed
        ];

        foreach ($communes as $commune) {
            Commune::create($commune);
        }
    }
}
