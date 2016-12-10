<?php

use Illuminate\Database\Seeder;

class ProdottiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('prodotti')->delete();

        \DB::table('prodotti')->insert(array (
            array (
                'ordine_id' => 0,
            	'fornitore_id' => 1,
            	'tipo'=>'pane',
            	'sottotipo'=>'tipo1',
            	'descrizione'=>'Tipo 1',
                'quantita' => 'pagnotta',
                'prezzo_fornitore' => 3.68,
            	'contributo_des'=>0.07,
            	'contributo_sm'=>0.25	
            ),
            array (
                'ordine_id' => 0,
            	'fornitore_id' => 1,
            	'tipo'=>'pane',
            	'sottotipo'=>'integrale',
            	'descrizione'=>'Integrale',
                'quantita' => 'pagnotta',
                'prezzo_fornitore' => 3.68,
            	'contributo_des'=>0.07,
            	'contributo_sm'=>0.25	
            ),
            array (
                'ordine_id' => 0,
            	'fornitore_id' => 1,
            	'tipo'=>'pane',
            	'sottotipo'=>'segale',
            	'descrizione'=>'Segale',
                'quantita' => 'pagnotta',
                'prezzo_fornitore' => 3.68,
            	'contributo_des'=>0.07,
            	'contributo_sm'=>0.25	
            ),
            array (
                'ordine_id' => 0,
            	'fornitore_id' => 3,
            	'tipo'=>'pane',
            	'sottotpo'=>'tipo1',
            	'descrizione'=>'Tipo 1',
                'quantita' => 'pagnotta',
                'prezzo_fornitore' => 4.16,
            	'contributo_des'=>0.08,
            	'contributo_sm'=>0.16	
            ),
            array (
                'ordine_id' => 0,
            	'fornitore_id' => 3,
            	'tipo'=>'pane',
            	'sottotpo'=>'integrale',
            	'descrizione'=>'Integrale',
                'quantita' => 'pagnotta',
                'prezzo_fornitore' => 4.16,
            	'contributo_des'=>0.08,
            	'contributo_sm'=>0.16	
            ),
            array (
                'ordine_id' => 0,
            	'fornitore_id' => 3,
            	'tipo'=>'pane',
            	'sottotpo'=>'segale',
            	'descrizione'=>'Segale',
                'quantita' => 'pagnotta',
                'prezzo_fornitore' => 4.16,
            	'contributo_des'=>0.08,
            	'contributo_sm'=>0.16	
            ),
        ));
    }
}
