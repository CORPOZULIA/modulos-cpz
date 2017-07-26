@extends('layouts.dashboard_layout')

@section('titulo', 'GESTION ADMINISTRATIVA DE BIENES')

@section('contenedor')

<section ng-app="index-bienes">

<div ng-controller="bienes" class="row">
	

<div class="col-sm-4">

<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	
	<thead>
		
	</thead>
	
</table>

</div>

</div>
	
</section>

@endsection
@section('jquery')
<script src=" {{ asset('js/competencia/angular/angular.min.js') }} "></script>
<script src=" {{ asset('js/bienes/index.js') }} "></script>

@endsection