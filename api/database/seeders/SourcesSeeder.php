<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sources')->insert([
            [
                'title' => 'Instagram'
            ],
            [
                'title' => 'Viber'
            ],
            [
                'title' => 'VK'
            ],
            [
                'title' => 'Facebook'
            ],
        ]);
    }
}
