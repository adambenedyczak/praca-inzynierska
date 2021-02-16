<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(RolesPermissionsSeeder::class);
        $this->call(UsersSeeder::class);

        $this->call(ObjectsTypeSeeder::class);
        $this->call(PartsTypeSeeder::class);
        $this->call(PartsDateTypeSeeder::class);
        $this->call(OverviewsDateTypeSeeder::class);
        $this->call(InsurancesDateTypeSeeder::class);

        $this->call(ObjectsSeeder::class);
    }
}
