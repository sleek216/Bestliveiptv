<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class MakeSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make-super {email=admin@bestliveiptv.com}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make an existing user a Super Admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return;
        }

        $user->update([
            'is_admin' => true,
            'is_super_admin' => true,
            'admin_permissions' => null // Super admins don't need specific permissions array
        ]);

        $this->info("User {$email} is now a Super Admin.");
    }
}
