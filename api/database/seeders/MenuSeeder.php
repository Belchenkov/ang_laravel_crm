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
                'title' => 'Панель управления',
                'path' => '/',
                'parent' => 0,
                'type' => 'admin',
                'sort_order' => 100,
            ],
            [
                'title' => 'Страницы',
                'path' => 'pages.index',
                'parent' => 0,
                'type' => 'admin',
                'sort_order' => 100,
            ],
            [
                'title' => 'Роли',
                'path' => 'roles.index',
                'parent' => 0,
                'type' => 'admin',
                'sort_order' => 100,
            ],
            [
                'title' => 'Привелигии',
                'path' => 'permissions.index',
                'parent' => 0,
                'type' => 'admin',
                'sort_order' => 100,
            ],
            [
                'title' => 'Пользователи',
                'path' => 'users.index',
                'parent' => 0,
                'type' => 'admin',
                'sort_order' => 100,
            ],
            [
                'title' => 'Панель управления',
                'path' => '/',
                'parent' => 0,
                'type' => 'front',
                'sort_order' => 100,
            ],
            [
                'title' => 'Новый лид',
                'path' => 'form',
                'parent' => 0,
                'type' => 'front',
                'sort_order' => 100,
            ],
            [
                'title' => 'Пользователи',
                'path' => 'users',
                'parent' => 0,
                'type' => 'front',
                'sort_order' => 100,
            ],
            [
                'title' => 'Источники',
                'path' => 'sources',
                'parent' => 0,
                'type' => 'front',
                'sort_order' => 100,
            ],
            [
                'title' => 'Подразделения',
                'path' => 'units',
                'parent' => 0,
                'type' => 'front',
                'sort_order' => 100,
            ],
            [
                'title' => 'Архив лидов',
                'path' => 'archives',
                'parent' => 0,
                'type' => 'front',
                'sort_order' => 100,
            ],
            [
                'title' => 'Аналитика',
                'path' => 'analytics',
                'parent' => 0,
                'type' => 'front',
                'sort_order' => 100,
            ],
            [
                'title' => 'Задачи',
                'path' => 'tasks',
                'parent' => 0,
                'type' => 'front',
                'sort_order' => 100,
            ],
            [
                'title' => 'Архив задач',
                'path' => 'task_archives',
                'parent' => 0,
                'type' => 'front',
                'sort_order' => 100,
            ],
        ]);
    }
}
