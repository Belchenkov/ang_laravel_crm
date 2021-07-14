<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateAdminUser::class);
        $this->call(MenuSeeder::class);
        $this->call(SourcesSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(UnitSeeder::class);
    }
}
