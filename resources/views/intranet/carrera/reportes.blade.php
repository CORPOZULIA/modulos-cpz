@extends('layouts.dashboard_layout')

@section('titulo', 'Reportes | Carrera Caminata Gaitera')

@section('contenedor')

<section ng-app='reportes'>
	<h3 class="page-header">
		Generación de reportes
	</h3>

	<div ng-controller='reportesController'>

		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<label for="tipo_reporte">Tipo de reporte</label>
					<select 
						ng-model='tipo_reporte'
						ng-options='reporte.tipo as reporte.nombre for reporte in reportes'
						ng-change='changeTipo()'
					>
					</select>
					<a class="btn btn-primary" href="@{{ url }}?ajax=false&filtro=@{{ filtro }}&fecha_desde=@{{fecha_desde}}&fecha_hasta=@{{fecha_hasta}}" target="_blank" ng-click="generarReporte()" ng-model="button" ng-disabled=" tipo_reporte=='---' ">Generar reporte</a>
					
					<br>
					<label for="Dependencia">Solo mostrar: </label>
					<select 
						ng-model='filtro'
						ng-options='dep.tipo as dep.nombre for dep in dependencias'
						ng-change="cambioFiltro(this.value)"
						class="form-control" 

					>

					</select>
				</div>
				<section id="fechas">
					<div class="col-sm-2">
						<label for="fecha_desde">Fecha desde</label>
						<input type="text" class="form-control" ng-model="fecha_desde" name="created_at_desde" id="created_at" placeholder="FORMATO: AAAA-MM-DD">
					</div>
					<div class="col-sm-2">
						<label for="fecha_hasta">Fecha hasta</label>
						<input type="text" class="form-control" ng-model="fecha_hasta" name="created_at_hasta" id="created_at_hasta" placeholder="FORMATO: AAAA-MM-DD">
					</div>
				</section>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<table  class="table table-striped table-hover" ng-hide=" bandera ">
					<thead>
						<tr>
							<th ng-repeat="th in ths">
								@{{ th }}
							</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="persona in personas">
							<td> @{{ persona.nombres }} </td>
							<td> @{{ persona.apellidos }} </td>
							<td> @{{ persona.cedula }} </td>
							<td> @{{ persona.nombre_tipo }} </td>
							<td> @{{ persona.modalidad_pago }} </td>
							<td ng-hide= " tipo_reporte != 'PorGerencia' " > 
								@{{ persona.dependencia }} 
							</td>
							<td ng-hide=" tipo_reporte != 'PorValidacion' " >
								@{{ persona.validado }} 
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</section>


@endsection

@section('jquery')
<script src=" {{ asset('js/competencia/angular/angular.min.js') }} "></script>
<script src=" {{ asset('js/competencia/reportes_competencia.js') }} "></script>

@endsection