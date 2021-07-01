<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Aleksey',
            'lastname' => 'Belchenkov',
            'phone' => '89074323411',
            'email' => 'u608110@gmail.com',
            'password' => bcrypt('password'),
            'status' => '1'
        ]);
    }
}
