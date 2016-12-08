@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {!! Form::open([
	    	'method' => 'POST', 
	    	'url' => URL::to('pane/'.$anno."/".$mese."/edit"),
	    	'class' => 'form-vertical',
		]) !!}
    
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ordini Pane {{ $mese }} {{ $anno }}</div>

                <div class="panel-body">
                	{!! Form::label("chiusura","Data chiusura",["class"=>"col-md-2 control-label"]) !!}
					<div class="col-md-3">
                   		{!! Form::text("chiusura",null,["class"=>"form-control"]) !!}
                   	</div>
                   	<table>
                   		<thead>
                   			<tr>
                   				<th>Fornaio</th>
                   				<th>Giorno</th>
                   				<th>Settimana 1</th>
                   				<th>Settimana 2</th>
                   				<th>Settimana 3</th>
                   				<th>Settimana 4</th>
                   				<th>Settimana 5</th>
                   			</tr>
                   		</thead>
                   		<tbody>
                   			@foreach ($date as $riga)
	                   		<tr>
	                   			<td>{{ $riga["fornaio"]->ragione_sociale }}({{ $riga["fornaio"]->nome }})</td>
	                   			<td>{{ $riga["giorno"] }}</td>
                   				<td>
                   					{!! Form::hidden("data1_id",$riga["data1_id"]) !!}
                   					{!! Form::text("data1_consegna",$riga["data1_consegna"],["class"=>"form-control"]) !!}
                   				</td>
                   				<td>
                   					{!! Form::hidden("data2_id",$riga["data2_id"]) !!}
                   					{!! Form::text("data2_consegna",$riga["data2_consegna"],["class"=>"form-control"]) !!}
                   				</td>
                   				<td>
                   					{!! Form::hidden("data3_id",$riga["data3_id"]) !!}
                   					{!! Form::text("data3_consegna",$riga["data3_consegna"],["class"=>"form-control"]) !!}
                   				</td>
                   				<td>
                   					{!! Form::hidden("data4_id",$riga["data4_id"]) !!}
                   					{!! Form::text("data4_consegna",$riga["data4_consegna"],["class"=>"form-control"]) !!}
                   				</td>
                   				<td>
                   					@if (isset($riga["data5_id"]))
	                   					{!! Form::hidden("data5_id",$riga["data5_id"]) !!}
	                   					{!! Form::text("data5_consegna",$riga["data5_consegna"],["class"=>"form-control"]) !!}
	                   				@else
	                   					&nbsp;
	                   				@endif
                   				</td>
	                   		</tr>
	                   		@endforeach
                   		</tbody>
                   	
                   	</table>
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
