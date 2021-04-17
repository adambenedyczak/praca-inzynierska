<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\EmailAdress;
use Illuminate\Database\Seeder;
use App\Models\NotificationRules;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin',
            'password' => bcrypt('admin')
        ]);

        $user->assignRole('admin');

        $email = EmailAdress::create([
            'email' => 'admin@admin',
            'user_id' => 1,
        ]);

        $notification_rules = NotificationRules::create([
            'user_id' => 1,
        ]);
    }
}
