<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ratings')->delete();
        
        \DB::table('ratings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'ivander08',
                'location_name' => 'A&W',
                'rating' => 4,
                'created_at' => '2024-06-23 10:58:33',
                'updated_at' => '2024-06-23 10:58:33',
            ),
        ));
        
        
    }
}