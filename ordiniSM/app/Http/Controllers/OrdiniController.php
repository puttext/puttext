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
    	$gruppi=Ordine::all()->groupBy("codice_gruppo");

    	$oggi=new \Carbon\Carbon();
    	$this->dati["in_corso"]=array();
    	$this->dati["prossimi"]=array();
    	$this->dati["storico"]=array();
    	 
    	foreach ($gruppi as $codice_gruppo=>$ordini){
    		$gruppo=array();
    		foreach ($ordini[0]->toArray() as $key=>$value){
    			$gruppo[$key]=$value;
    		}
    		$gruppo["apertura"]=$ordini[0]->apertura;
    		$gruppo["chiusura"]=$ordini[0]->chiusura;
    		
    		$fornitori=array();
    		$consegne=array();
    		foreach ($ordini as $ordine){
    			$consegne[]=$ordine->consegna->format("d/m");
    			$fornitori[$ordine->fornitore_id]=$ordine->fornitore->nome;
    		}
    		$gruppo["fornitori"]=implode($fornitori,", ");
    		
    		$gruppo["consegne"]=implode($consegne,", ");
    		
    		if (substr($gruppo["codice_gruppo"],0,1)=="P")
    			$gruppo["url"]=url('/ordini/pane/'.$ordini[0]->consegna->format("Y/m").'/edit');
    		else
    			$gruppo["url"]=url('/ordini/'.$gruppo['codice_gruppo'].'/edit');
    		
    		if ($ordini[0]->apertura>$oggi){
    			$this->dati["prossimi"][]=$gruppo;
    		}
    		else{
    			$this->dati["prossimi"][]=$gruppo;
    		}
    		//dd($ordini->pluck("consegna"));
    	}
    	//dd($this->dati);
    	return view("ordini.elenco")->with($this->dati);
    	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$this->dati["mesi"]=\Config::get("parametri.mesi_txt");
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
        	$mese_f=sprintf('%02d',$mese);
        	$anno=$request->input("anno");
        	$fornai=[];
        	if (\Auth::user()->ruolo=="coordinatore"){
        		$fornai[]=Fornaio::find(\Auth::user()->referenza->id);
        	}
        	elseif (\Auth::user()->ruolo=="admin"){
        		$fornai=Fornaio::all();
        	}
    		//(new Dumper)->dump($appuntamento);
        	/*$dumper->dump($fornai);
        	$dumper->dump($mese);
        	$dumper->dump($anno);*/
        	foreach ($fornai as $fornaio){
        		/*$dumper->dump($fornaio);
        		$dumper->dump($fornaio->giorni_gas);*/
        		if ($fornaio->giorni_gas){
        			//$dumper->dump($fornaio);
	        		$giorni=$fornaio->giorni_gas()
	        			->whereStagione(\Config::get("parametri.stagione"))
	        			->where("valido_dal","<=",$anno."-".$mese_f)
	        			->where("valido_al",">=",$anno."-".$mese_f)->get()
	        			->pluck("giorno")->unique();
	        		//$dumper->dump($giorni);
	        		foreach ($giorni as $giorno){
	        			$refDate=\Carbon\Carbon::createFromDate($anno, $mese, 1)->subDay();
	        			$data=clone $refDate;
	        			$apertura=new \DateTime();
	        			$data->next($giorno);
	        			$chiusura=(clone $data);
	        			$chiusura->subDay(2);
	        			/*$dumper->dump($giorno);
	        			$dumper->dump($data);*/
	        			while ($data->month==$mese){
	        				//$dumper->dump($data);
	        				$ordine=Ordine::create([
	        					"stagione"=>\Config::get("parametri.stagione"),
	        					"codice_gruppo"=>"P".$giorno."-".$anno."-".$mese_f,
	        					"consegna"=>$data,
	        					"apertura"=>$apertura,
	        					"chiusura"=>$chiusura,
	        					"descrizione"=>"Ordine pane " . config("parametri.mesi_txt")[$mese] . " " . $anno,
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
        	return redirect("ordini/pane/$anno/$mese/edit/");
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
		if ($id=="current" || !$id){
			//compila tutti gli ordini aperti
			if (\Auth::user()->gas_id)
				return $this->compila();
			else
				return view("errore")->with(["messaggio"=>"Nessun GAS di riferimento per cui compilare"]);
		}
		else {
			$ordine=Ordine::find($id);
			$oggi=new \Carbon\Carbon();
			if ($ordine->apertura <= $oggi && $ordine->chiusura>=$oggi){
				//compila singolo ordine
				return $this->compila($id);
			}
			if ($ordine->apertura < $oggi && \Auth::user()->livello >= 20){
				//edit singolo ordine
			}
		}
    	
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

    public function compila($id){
		$oggi=new \Carbon\Carbon();    
    	if ($id=="current" || !$id){
    		$this->dati["gruppi"]=array();	

    		$fornai=\Auth::user()->gas->fornai;
    	   	$gruppi=Ordine::where("apertura","<=",$oggi)
	    		->where("chiusura",">=",$oggi)
	    		->whereIn("fornitore_id",$fornai->pluck("id")->all())
	    		->get()
	    		->groupBy("codice_gruppo");
	    
	    	return $gruppi;
    	}
    }
}
