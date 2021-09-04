<?php

namespace App\Modules\Admin\Lead\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            ['title' => 'new','title_ru' => 'Новые заявки'],
            ['title' => 'process','title_ru' => 'В работе'],
            ['title' => 'done','title_ru' => 'Выполнено']
        ]);
    }
}
