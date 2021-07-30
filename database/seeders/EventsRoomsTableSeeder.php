<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventsRoomsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('events_rooms')->delete();
        
        \DB::table('events_rooms')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Salón bandera',
                'manager' => 'Clauida Chavez Rivero',
                'phone' => NULL,
                'address' => NULL,
                'created_at' => '2021-07-29 10:39:03',
                'updated_at' => '2021-07-29 10:39:03',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Salón Bicentenario',
                'manager' => 'Clauida Chavez Rivero',
                'phone' => NULL,
                'address' => NULL,
                'created_at' => '2021-07-29 10:42:42',
                'updated_at' => '2021-07-29 10:42:42',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}