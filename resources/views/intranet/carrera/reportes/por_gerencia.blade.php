<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte por gerencia</title>
	<style>
		body{
			font-family: 'Helvetica';
		}
		.page-break{
			page-break-after: always;
		}
	</style>
</head>
<body>

<center>
	
	@if( !empty($filtro) )
		<h3>Relación de inscritos {{ $filtro }} </h3>
	@else
		<h3>Relación de inscritos por gerencia</h3>
	@endif

</center>

<table border="1" cellspacing="0" cellpadding="0" align="center">
	
	<thead>
		<tr>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Cedula</th>
			@if( empty($filtro) )
				<th>Gerencia</th>
			@else
				<th>Estatus</th>
			@endif
		</tr>
	</thead>
	<tbody>
		
		@foreach($datos as $dato)
			<tr>
				<td> {{ $dato->nombres }} </td>
				<td> {{ $dato->apellidos }} </td>
				<td> {{ $dato->cedula }} </td>
				@if( empty($filtro) )
					<td> {{ $dato->dependencia }} </td>
				@else
					<td> {{ $dato->validado }} </td>
				@endif
			</tr>
		@endforeach

	</tbody>

</table>


<div class="page-break"></div>
<center>
	<h3>Totales por depencias</h3>
</center>

<table border="1" cellspacing="0" cellpadding="0" align="center">

	<thead>
		<tr>
			<th>Dependencias</th>
			<th>Totales</th>
		</tr>
	</thead>
	@foreach($totales as $total)
		@if($total->dependencia == 'Externo')
			<tr bgcolor="#CC0000" style="color: #fff">
		@else
		 	<tr>
		 @endif
			<td> {{ $total->dependencia }} </td>
			<td> {{ $total->totales }} </td>
		</tr>
	@endforeach

</table>

<center>
	
	<strong>Total inscritos en: </strong>
	@foreach($por_evento as $evento)
		<strong> {{ $evento->nombre_tipo }} : {{ $evento->cantidad }} </strong>
	@endforeach

</center>

</body>
</html>