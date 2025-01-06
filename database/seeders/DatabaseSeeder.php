<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
ini_set('memory_limit', '2048M'); // Set memory limit to 2GB

use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        ini_set('memory_limit', '8048M'); // Set memory limit to 2GB

        $totalRecords = 1000000; // Total number of records
        $batchSize = 5000;     // Batch size (100,000)

        for ($i = 0; $i < $totalRecords; $i += $batchSize) {
            Service::factory($batchSize)->create();
            echo "Inserted " . min(($i + 1) * $batchSize, $totalRecords) . " records...\n";
        }

        echo "Successfully inserted " . $totalRecords . " records!";
    }
}
