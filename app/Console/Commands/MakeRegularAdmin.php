<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MakeRegularAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make-regular {email=manager@bestliveiptv.com}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a regular admin for testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Regular Admin',
                'password' => Hash::make('manager123'),
                'is_admin' => true,
                'is_super_admin' => false,
                'admin_permissions' => ['orders', 'users'] // Only Orders and Users access
            ]
        );

        $this->info("Regular Admin created with email: {$email} and password: manager123");
        $this->info("They only have access to Orders and Users tabs.");
    }
}
