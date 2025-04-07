<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // BusinessIndustrySeeder::class,
            // EnterpriseSeeder::class,
            // EnterpriseAccountSeeder::class,
            // ServiceCategorySeeder::class,
            ServiceSeeder::class,
        ]);
    }
}
