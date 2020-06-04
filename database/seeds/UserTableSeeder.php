<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            'username'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('12345678'),
        ]);
        $user->assignRole('Admin');
    }
}
