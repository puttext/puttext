<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    	return view('home')->with($this->dati);
    }
}
