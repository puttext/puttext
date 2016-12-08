<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Fornaio;
use App\Model\Ordine;

class PaneController extends Controller
{

    public function edit($anno,$mese){
    	$fornai=[];
    	if (\Auth::user()->ruolo=="coordinatore"){
    		$fornai[]=Fornaio::find(\Auth::user()->referenza->id);
    	}
    	elseif (\Auth::user()->ruolo=="admin"){
    		$fornai=Fornaio::all();
    	}
    	$date=array();
    	foreach ($fornai as $fornaio){
    		if ($fornaio->giorni_gas){
    			$giorni=$fornaio->giorni_gas()
    				->whereStagione(\Config::get("parametri.stagione"))
    				->where("valido_dal","<=",$anno."-".$mese)
    				->where("valido_al",">=",$anno."-".$mese)->get()
    				->pluck("giorno")->unique();
    			foreach ($giorni as $giorno){
    				$riga=array();
    				$riga["fornaio"]=$fornaio;
    				$refDate=\Carbon\Carbon::createFromDate($anno, $mese, 1)->subDay();
    				$data=clone $refDate;
    				$data->next($giorno);
    				$riga["giorno"]=$data->format("l");

    				$i=1;
    				$ordini=Ordine::whereFornitoreId($fornaio->id)
    					->whereCodiceGruppo("P".$giorno."-".$anno."-".sprintf('%02d',$mese))->get();
    				foreach ($ordini as $ordine){
    					$riga["data".$i."_consegna"]=$ordine->consegna;
    					$riga["data".$i."_id"]=$ordine->id;
    					$i++;
    				}
    				$date[]=$riga;
    			}
    		}
    	}
    	$this->dati["date"]=$date;
    	$this->dati["anno"]=$anno;
    	$this->dati["mese"]=$anno;
    	 
    	return view("ordini.pane_edit")->with($this->dati);
    }
	//
}
