@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
		<div class="panel panel-warning">
	        <div class="panel-heading">
				<h3 class="panel-title text-center">Prossimi Ordini</h3>
		    </div>
			<div class="panel-body">
	       	<table class="table table-striped table-bordered table-condensed">
	       		<thead>
	       			<tr>
	       				<th class="col-md-4">Descrizione</th>
	       				<th class="col-md-1">Apertura</th>
	       				<th class="col-md-1">Chiusura</th>
	       				<th class="col-md-2">Fornitori</th>
	       				<th class="col-md-4">Consegne</th>
	       				<th class="col-md-1">Operazioni</th>
	       			</tr>
	       		</thead>
	       		<tbody>
					@foreach ($prossimi as $gruppo)
	       			<tr>
	       				<td class="col-md4">{{ $gruppo["descrizione"] }}</td>
	       				<td class="col-md1">{{ $gruppo["apertura"] }}</td>
	       				<td class="col-md1">{{ $gruppo["chiusura"] }}</td>
	       				<td class="col-md2">{{ $gruppo["fornitori"] }}</td>
	       				<td class="col-md4">{{ $gruppo["consegne"] }}</td>
	       				<td class="col-md1">
	       					<a class="btn btn-sm btn-success" href="{{ $gruppo['url'] }}">Modifica</a>
	       					</td>
	       			</tr>
	       		</tbody>
	       	</table>
	        @endforeach
			</div>
	    </div>
	</div>
</div>
@endsection
@section('page-scripts')
<script>
	$(document).ready(function(){
		$(".selectpicker").selectpicker();
	});
</script>
@endsection
