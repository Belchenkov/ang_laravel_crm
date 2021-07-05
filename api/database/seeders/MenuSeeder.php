<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'title' => 'Dashboard',
                'parent' => 0,
                'sort_order' => 100,
                'path' => 'dashboards.index',
                'type' => 'admin'
            ],
            [
                'title' => 'Child',
                'parent' => 1,
                'sort_order' => 100,
                'path' => 'dashboards.index',
                'type' => 'admin'
            ]
        ]);
    }
}
