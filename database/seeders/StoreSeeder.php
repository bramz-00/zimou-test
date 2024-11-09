<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::factory()
            ->count(5000)
            ->create()
            ->each(function ($store) {
                // Créer 100 packages pour chaque magasin
                \App\Models\Package::factory()->count(100)->create([
                    'store_id' => $store->id, // Associer les packages au store actuel
                ]);
            });
    }
}
