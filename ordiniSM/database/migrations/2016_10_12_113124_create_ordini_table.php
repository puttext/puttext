<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdiniTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordini', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('stagione', 9);
			$table->date('consegna');
			$table->date('apertura');
			$table->date('chiusura');
			$table->date('fornitore_id');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ordini');
	}

}
