<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartsDateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elementy = [
            1 => 'Następna',
            2 => 'Wykonana',
        ];

        foreach ($elementy as $key => $element){
            DB::table('parts_date_type')->insert([
                'name' => $element
            ]);
        } 
    }
}
