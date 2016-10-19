<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gas extends Attore
{
	protected $attributes = array(
		'tipo' => 'gas',
	);

	public function newQuery($excludeDeleted = true) {
		return parent::newQuery($excludeDeleted = true)
		->where('tipo', '=', 'gas');
	}
	
}
