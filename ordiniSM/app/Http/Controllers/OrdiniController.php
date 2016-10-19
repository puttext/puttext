<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Debug\Dumper;

use App\Http\Requests;
use App\Model\Attore;
use App\Model\Fornaio;
use App\Model\Ordine;

class OrdiniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$this->dati["mesi"]=[
    		0=>"",
    		1=>"Gennaio",
    		2=>"Febbraio",
    		3=>"Marzo",
    		4=>"Aprile",
    		5=>"Maggio",
    		6=>"Giugno",
    		7=>"Luglio",
    		9=>"Settembre",
    		10=>"Ottobre",
    		11=>"Novembre",
    		12=>"Dicembre",
    	];
    	$data=new \Carbon\carbon();
    	if ($data->month=="12")
    		$this->dati["anno"]=$data->year+1;
    	else 
    		$this->dati["anno"]=$data->year;
    	return view('ordini.new')->with($this->dati);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dumper=(new Dumper);
        if ($request->has("pane")){
        	$mese=$request->input("mese");
        	$anno=$request->input("anno");
        	$fornai=[];
        	if (\Auth::user()->ruolo=="coordinatore"){
        		$fornai[]=Fornaio::find(\Auth::user()->referenza->id);
        	}
        	elseif (\Auth::user()->ruolo=="admin"){
        		$fornai=Fornaio::all();
        	}
    		//(new Dumper)->dump($appuntamento);
        	$dumper->dump($fornai);
        	$dumper->dump($mese);
        	$dumper->dump($anno);
        	foreach ($fornai as $fornaio){
        		$dumper->dump($fornaio, $fornaio->giorni_gas);
        		if ($fornaio->giorni_gas){
        			$dumper->dump($fornaio);
	        		$giorni=$fornaio->giorni_gas()
	        			->whereStagione(\Config::get("parametri.stagione"))
	        			->where("valido_dal","<=",$anno."-".$mese)
	        			->where("valido_al",">=",$anno."-".$mese)->get()
	        			->pluck("giorno")->unique();
	        		$dumper->dump($giorni);
	        		foreach ($giorni as $giorno){
	        			$refDate=\Carbon\Carbon::createFromDate($anno, $mese, 1)->subDay();
	        			$data=clone $refDate;
	        			$apertura=new \DateTime();
	        			$data->next($giorno);
	        			$chiusura=(clone $data);
	        			$chiusura->subDay(2);
	        			$dumper->dump($giorno);
	        			$dumper->dump($data);
	        			while ($data->month==$mese){
	        				$dumper->dump($data);
	        				$ordine=Ordine::create([
	        					"stagione"=>\Config::get("parametri.stagione"),
	        					"consegna"=>$data,
	        					"apertura"=>$apertura,
	        					"chiusura"=>$chiusura,
	        					"fornitore_id"=>$fornaio->id
	        				]);
	        				
	        				foreach ($fornaio->pane as $pane){
	        					$prodotto=$pane->replicate();
	        					$prodotto->ordine_id=$ordine->id;
	        					$prodotto->save();
	        				}
	        				//$ordine->save();
	        				$data->next($giorno);
	        			}
	        		}
        		}
        	}
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
