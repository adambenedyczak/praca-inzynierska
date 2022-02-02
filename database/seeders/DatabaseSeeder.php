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
        $this->call(ObjectDetailsTypeSeeder::class);
        $this->call(WorkTimeUnitSeeder::class);
        $this->call(ElementsCategorySeeder::class);

        //$this->call(ObjectsSeeder::class);


        $this->call(EventsTypeSeeder::class);
        $this->call(InsurancesTypeSeeder::class);
        $this->call(OverviewsTypeSeeder::class);
        $this->call(PartsTypeSeeder::class);
        $this->call(PartDetailsTypeSeeder::class);
    }
}
