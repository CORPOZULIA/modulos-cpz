<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Comprobante de participación</title>
</head>
<body>

<table border="1" align="center" border="0" cellpadding="0" cellspacing="0" >
	
	<tr>
		<td>
			
			<table  align="center" border="0" cellpadding="0" cellspacing="0"> 
				
				<tr>
					<td align="center" border="0" cellpadding="0" cellspacing="0">
					</td>
					<td style="font-family: 'Helvetica'" align="center">
						<h3 >
							Comprobante de inscripción
						</h3>
						<span style="margin-top: 0px;">
							Carrera Caminata Gaitera 2017
						</span>
					</td>
				</tr>

			</table>

		</td>
	</tr>
	<tr>
		<td style="font-family: 'Helvetica';">
			
			<table  align="center"  cellpadding="0" cellspacing="0">

				<tr>
					@foreach($tipos as $tipo)
						@if( $tipo->nombre_tipo == $solicitud->tipo_competencia->nombre_tipo )
							<td> Inscrito en <strong>{{ $tipo->nombre_tipo }} </strong> </td>
						@endif
					@endforeach
				</tr>

				<tr >
					<td> Nombre: {{ $persona->nombres }} </td>
				</tr>
				<tr>
					<td> Apellido: {{ $persona->apellidos }} </td>
				</tr>
				<tr>
					<td> Cedula: {{ $persona->nacionalidad->codigo_nac.'-'.$persona->cedula }} </td>
				</tr>
				<tr>
					<td> <strong>Número asignado: {{ $solicitud->mi_numero }}</strong> </td>
				</tr>
				<tr>
					<td> Talla:</td>
					@foreach($tallas as $clave => $talla)
						@if ( $talla == $solicitud->talla )
							<td> {{ $talla }} [ <strong>X</strong> ] </td>
							@else
							<td> {{ $talla }} [ &nbsp; ] </td>
						@endif
					@endforeach
				</tr>
				<tr align="center">
					<td> _______________</td>
				</tr>
				<tr align="center">
					<td> Recibido por: </td>
				</tr>
			</table>

		</td>
	</tr>

</table>
<strong>----------------------------------------------------------------------------------------------------------------------------------------------</strong>
<table border="1" align="center" border="0" cellpadding="0" cellspacing="0">
	
	<tr>
		<td>
			
			<table  align="center" border="0" cellpadding="0" cellspacing="0"> 
				
				<tr>
					<td align="center" border="0" cellpadding="0" cellspacing="0">
						<!--<img src="{{ asset('img/brand.png') }}" alt="">-->
					</td>
					<td style="font-family: 'Helvetica'" align="center">
						<h3 >
							Liberación de Responsabilidad
						</h3>
						<span style="margin-top: 0px;">
							Carrera Caminata Gaitera 2017
						</span> 
					</td>
				</tr>
			</table>

		</td>
	</tr>

	<tr>
		<td style="font-family: 'Helvetica';">
			<table  border="0" cellpadding="0" cellspacing="0">
				<tr>

					<td> ¿Como te enteraste del evento?</td>
					<td>Redes sociales [ &nbsp; ]</td>
					<td>Televisión [ &nbsp; ]</td>
					<td>Radio [ &nbsp; ]</td>
					<td>Prensa [ &nbsp; ]</td>
					<td>Un amigo [ &nbsp; ]</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="font-family: 'Helvetica';">
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center">
						<strong style="text-decoration: underline;">
							Descargo de Responsabilidades y Protección de Datos
						</strong>
					</td>
				</tr>
				<tr>
					<td align="center">
						<p style="text-align: justify;">
							Declaro que en forma voluntaria he decidido participar en la Carrera Caminata Gaitera 2017 y

							entiendo que participar en ella representa una actividad riesgosa, y que estoy en perfectas

							condiciones de salud y debidamente entrenado.

							<br><br>

							Estoy de acuerdo en cumplir con cualquier decisión proveniente de algún juez o cualquier otra

							autoridad del evento, en cuanto a mi capacidad para concluir con seguridad la carrera o sobre

							cualquier otro aspecto en relación a mi participación en la misma.

							<br><br>

							Asumo todos los riesgos asociados a mi participación en esta Carrera Caminata Gaitera 2017,

							incluyendo, pero sin carácter limitativo, caídas, contacto con otros participantes, efectos

							relacionados con el clima como temperatura y/o humedad, condiciones de las vías y tránsito

							vehicular en el trayecto, y cualesquiera otras condiciones de la ruta que repercutan en cualquier

							tipo de daño; riesgos todos conocidos y tomados en cuenta por mí.

							<br><br>

							Habiendo leído esta dimisión y conociendo los hechos y riesgos asociados a mi participación en la

							Carrera Caminata Gaitera 2017, por medio de la presente libero al Comité Organizador y a

							Corpozulia, de reclamos o responsabilidades de cualquier índole, y/o pago por daños y perjuicios

							que pudieran surgir por causas imputables. Así mismo, se libera de cualquier responsabilidad por

							los hechos que se produzcan por caso fortuito y/o fuerza mayor, antes o durante el desarrollo del

							evento, así como de cualquier extravío, robo y/o hurto que pudiera sufrir. De la misma manera,

							autorizo al Comité Organizador para hacer uso de mis fotografías, pelicular, videos y grabaciones o

							cualquier registro realizado durante mi participación en la Carrera Caminata Gaitera 2017, sin

							compensación económica, para cualquier propósito lícito.
						</p>
					</td>
				</tr>
				<tr>
					<td align="center">
						 <strong>_________________________</strong>
						<br>  Firma del titular.
					</td>
				</tr>
			</table>
		</td>
	</tr>

</table>
	
</body>
</html>