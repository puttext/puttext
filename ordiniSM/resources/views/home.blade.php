@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {!! Form::open([
	    	'method' => 'POST', 
	    	'url' => URL::to('ordini'),
	    	'class' => 'form-vertical',
		]) !!}
    
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Azioni</div>

                <div class="panel-body">
                   	{!! Form::hidden("pane",true) !!}
                   	{!! Form::text("anno",$anno,["class"=>"Form-control"]) !!}
                	{!! Form::select("mese",$mesi,null,['class'=>'selectpicker', 'data-none-selected-text'=>'-- Seleziona il mese']) !!}
                	{!! Form::submit("Crea", ['class'=>'btn btn-primary']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
@section('page-script')
<script>
	$(document).ready(function(){
		$(".selectpicker").selectpicker();
	}
</script>
@endsection
