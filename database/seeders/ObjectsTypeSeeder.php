<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elementy = [
            1 => 'Pojazd',
            2 => 'Przyczepa',
            3 => 'Silnik'
        ];

        foreach ($elementy as $key => $element){
            DB::table('objects_type')->insert([
                'name' => $element
            ]);
        }
    }
}
