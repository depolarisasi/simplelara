<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvPath = base_path('csv/province.csv'); // Corrected path to project root csv folder

        // Check if the CSV file exists
        if (!File::exists($csvPath)) {
            $this->command->error("CSV file not found at path: " . $csvPath);
            return;
        }

        DB::beginTransaction();

        try {
            // Optional: Truncate table if you want to start fresh on each seed
            // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            // Province::truncate();
            // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $isFirstLine = true; // Flag to skip header row

            // Use File::lines() for memory efficiency with large files
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
                if (count($data) >= 2) {
                    $provinceName = trim($data[1]);
                    Province::create([
                        // 'id' => trim($data[0]), // Assuming 'id' is auto-incrementing in the table
                        'name' => $provinceName,
                        'slug' => Str::slug($provinceName),
                    ]);
                } else {
                    $this->command->warn("Skipping malformed row: " . $line);
                }
            }

            DB::commit();
            $this->command->info('Provinces seeded successfully from CSV.');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('Error seeding provinces: ' . $e->getMessage());
        }
    }
}
