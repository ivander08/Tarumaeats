<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 5234523452,
                'name' => 'ivander08',
                'email' => 'ivanderseah08@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$t71ccLetCzrF768BFnxE1O6/.oMuAdrHfvOlW7ALcJ9RZ3qrzFyea',
                'is_admin' => true,
                'remember_token' => NULL,
                'created_at' => '2024-06-23 10:45:47',
                'updated_at' => '2024-06-23 10:45:47',
            ),
            1 => 
            array (
                'id' => 1,
                'name' => 'tarumaeats',
                'email' => 'admintarumaeats@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$r6fy0aJzSjt3ng4VOU9HUuf5sndnKtZWpi/4032G878Dvg.1i5tzi',
                'is_admin' => true,
                'remember_token' => NULL,
                'created_at' => '2024-06-23 15:12:11',
                'updated_at' => '2024-06-23 15:12:20',
            ),
        ));
        
        
    }
}