<?php

namespace App\Console\Commands;

use App\Modules\Admin\User\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       User::create([
           'firstname' => 'Admin',
           'lastname' => 'Admin',
           'email' => 'admin@gmail.com',
           'password' => Hash::make('password'),
           'phone' => '111-111-111',
           'status' => '1'
       ]);
    }
}
