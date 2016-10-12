<?php

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
                'id' => 1,
                'name' => 'referente 1',
                'email' => 'referente1@gmail.com',
                'password' => bcrypt('gas1'),
                'ruolo' => 'gas',
                'attore_id' => 4,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'referente 2',
                'email' => 'referente2@livecom.it',
                'password' => bcrypt('gas2'),
                'ruolo' => 'gas',
                'attore_id' => 5,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Massimo Bertin',
                'email' => 'bertinforno@gmail.com',
                'password' => bcrypt('massimo'),
                'ruolo' => 'gas',
                'attore_id' => 1,
            ),
        ));
        
        
    }
}
