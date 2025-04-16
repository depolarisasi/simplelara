<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvPath = base_path('csv/city-regencies.csv'); // Corrected path to project root csv folder

        // Check if the CSV file exists
        if (!File::exists($csvPath)) {
            $this->command->error("CSV file not found at path: " . $csvPath);
            return;
        }

        DB::beginTransaction();

        try {
            // Optional: Truncate table if you want to start fresh on each seed
            // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            // City::truncate();
            // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $isFirstLine = true; // Flag to skip header row

            // Use File::lines() for memory efficiency
            foreach (File::lines($csvPath) as $line) {
                if ($isFirstLine) {
                    $isFirstLine = false;
                    continue; // Skip header row
                }

                // Check for empty lines
                if (empty(trim($line))) {
                    continue;
                }

                $data = str_getcsv($line);

                // Ensure the row has the expected number of columns
                if (count($data) >= 3) {
                    $cityName = trim($data[2]);
                    $provinceId = trim($data[1]);

                    // Basic validation for province_id
                    if (!is_numeric($provinceId)) {
                         $this->command->warn("Skipping row due to non-numeric province_id: " . $line);
                         continue;
                    }

                    City::create([
                        // 'id' => trim($data[0]), // Assuming 'id' is auto-incrementing
                        'province_id' => $provinceId,
                        'name' => $cityName,
                        'slug' => Str::slug($cityName),
                    ]);
                } else {
                    $this->command->warn("Skipping malformed row: " . $line);
                }
            }

            DB::commit();
            $this->command->info('Cities seeded successfully from CSV.');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('Error seeding cities: ' . $e->getMessage());
            // Optionally log the full stack trace for debugging
            // Log::error('City Seeding Error: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }
}
