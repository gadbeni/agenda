<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AssistantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('assistants')->delete();
        
        \DB::table('assistants')->insert(array (
            0 => 
            array (
                'id' => 1,
                'full_name' => 'José Alejandro Unzueta Sriqui',
                'funcionario_id' => NULL,
                'detail' => 'Gobernador del Beni',
                'created_at' => '2021-07-30 12:27:10',
                'updated_at' => '2021-07-30 12:27:10',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'full_name' => 'Jhonny Paul Pinto Phillips',
                'funcionario_id' => NULL,
                'detail' => 'Secretario de Administración y Finanzas',
                'created_at' => '2021-07-30 12:29:21',
                'updated_at' => '2021-07-30 12:29:21',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'full_name' => 'Dalia Dasha Lima Castedo',
                'funcionario_id' => NULL,
                'detail' => 'Asesora especializada',
                'created_at' => '2021-07-30 12:30:01',
                'updated_at' => '2021-07-30 12:30:01',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'full_name' => 'Juan Carlos Sakamoto Paz',
                'funcionario_id' => NULL,
                'detail' => 'Director del SEDES Beni',
                'created_at' => '2021-07-30 12:30:47',
                'updated_at' => '2021-07-30 12:30:47',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}