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
    	$data=new \Carbon\carbon();
    	if ($data->month=="12")
    		$this->dati["anno"]=$data->year+1;
    	else 
    		$this->dati["anno"]=$data->year;
    	return view('home')->with($this->dati);
    }
}
