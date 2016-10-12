<?php

use Illuminate\Database\Seeder;

class AssociazioneFornaiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('associazione_fornai')->delete();
        
        \DB::table('associazione_fornai')->insert(array (
            0 => 
            array (
                'id' => 1,
                'stagione' => '2016-2017',
                'fornaio_id' => 1,
                'gas_id' => 4,
                'giorno' => 3,
            ),
            1 => 
            array (
                'id' => 2,
                'stagione' => '2016-2017',
                'fornaio_id' => 3,
                'gas_id' => 5,
                'giorno' => 3,
            ),
        ));
        
        
    }
}
