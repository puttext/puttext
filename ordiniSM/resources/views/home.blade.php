@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		@if (true)
			<div class="alert alert-info">
				<h3 class="text-center">
					Ci sono ordini in corso
					<a href="{{ url('/ordini/compila') }}" class="btn btn-success">Compila!</a>
				</h3> 
			</div>
		@endif
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
