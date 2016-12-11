<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
			'password', 'remember_token',
	];
	
	public function referenza(){
		return $this->belongsTo('App\Model\Attore','attore_id');
	}
	
	public function gas(){
		return $this->belongsTo('App\Model\Gas');
	}
	
	public function getLivelloAttribute(){
		switch ($this->ruolo){
			case "coordinatore": return 20; break;
			case "gestore": return 30; break;
			case "admin": return 90; break;
			default: return 10; 
		}
	}
}
