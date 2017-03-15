<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AggiungiDefaultTimestamp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	$tables=["associazione_fornai","attori","ordini","ordini_dettagli","ordini","prodotti","users","versamenti","casse"];
    	foreach ($tables as $t){
    		Schema::table($t, function (Blueprint $table) {
    			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'))->change();
    			$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->change();
    		});
    	}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
