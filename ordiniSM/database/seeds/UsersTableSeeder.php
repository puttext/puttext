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
            array (
                'id' => 1,
                'name' => 'referente 1',
                'email' => 'referente1@gmail.com',
                'password' => bcrypt('gas1'),
                'ruolo' => 'referente',
                'attore_id' => null,
                'gas_id' => 4,
            ),
            array (
                'id' => 2,
                'name' => 'referente 2',
                'email' => 'referente2@livecom.it',
                'password' => bcrypt('gas2'),
                'ruolo' => 'referente',
                'attore_id' => null,
            	'gas_id' => 5,
            ),
            array (
                'id' => 3,
                'name' => 'Massimo Bertin',
                'email' => 'bertinforno@gmail.com',
                'password' => bcrypt('massimo'),
                'ruolo' => 'gas',
                'attore_id' => 1,
                'gas_id' => null,
            ),
            array (
                'id' => 4,
                'name' => 'Stefano Radaelli',
                'email' => 'stradael@livecom.it',
                'password' => bcrypt('stefano'),
                'ruolo' => 'coordinatore',
                'attore_id' => 1,
                'gas_id' => 4,
            ),
            array (
                'id' => 5,
                'name' => 'Margherita Motta',
                'email' => 'segreteria@desbri.org',
                'password' => bcrypt('marghe'),
                'ruolo' => 'gestore',
                'attore_id' => null,
                'gas_id' => null,
            ),
        ));
        
        
    }
}
