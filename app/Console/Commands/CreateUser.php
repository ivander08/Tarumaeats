<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    protected $signature = 'user:create {email} {--admin : Make the user an admin}';

    protected $description = 'Create a new user or update existing user\'s admin status';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $email = $this->argument('email');
        $isAdmin = $this->option('admin');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $name = $this->ask('Enter username for the user:');
            $password = $this->secret('Enter password for the user:');
            $passwordConfirmation = $this->secret('Confirm password:');

            if ($password !== $passwordConfirmation) {
                $this->error('Passwords do not match.');
                return;
            }

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);
        }

        if ($isAdmin) {
            $user->is_admin = true;
            $user->save();
            $this->info('User updated to admin.');
        } else {
            $user->is_admin = false;
            $user->save();
            $this->info('User updated to regular user.');
        }
    }
}
