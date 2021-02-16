<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OverviewsDateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elementy = [
            1 => 'Następny',
            2 => 'Wyponany',
        ];

        foreach ($elementy as $key => $element){
            DB::table('overviews_date_type')->insert([
                'name' => $element
            ]);
        }
    }
}
