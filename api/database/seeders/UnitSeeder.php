<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            ['title' => 'Shop 1'],
            ['title' => 'Shop 2'],
            ['title' => 'Shop 3']
        ]);

    }
}
