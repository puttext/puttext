<?php

use Illuminate\Database\Seeder;

class AttoriTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attori')->delete();
        
        \DB::table('attori')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tipo' => 'fornaio',
                'nome' => 'Massimo',
                'comune' => 'Cesano Maderno',
                'ragione_sociale' => 'Il Piccolo Forno',
                'indirizzo' => 'via Monte Rosa',
            ),
            1 => 
            array (
                'id' => 2,
                'tipo' => 'fornaio',
                'nome' => 'Colombo',
                'comune' => 'Bellinzago Lombardo',
                'ragione_sociale' => 'F.lli Colombo',
                'indirizzo' => '',
            ),
            2 => 
            array (
                'id' => 3,
                'tipo' => 'fornaio',
                'nome' => 'Franca',
                'comune' => 'Seregno',
                'ragione_sociale' => 'Il Pane di Franca',
                'indirizzo' => 'via Tenca',
            ),
            3 => 
            array (
                'id' => 4,
                'tipo' => 'gas',
                'nome' => 'GAS ConSenso',
                'comune' => 'Cesano Maderno',
                'ragione_sociale' => 'Associazione Consenso',
                'indirizzo' => '',
            ),
            4 => 
            array (
                'id' => 5,
                'tipo' => 'gas',
                'nome' => 'GAS Cent Co\' Cent Cr',
                'comune' => 'Brugherio',
                'ragione_sociale' => '',
                'indirizzo' => '',
            ),
        ));
        
        
    }
}
