<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
 
 <head>
 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 
<title>Demystifying Email Design</title>
 
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
 
</head>


<body style="margin: 0px; padding: 0px;">

<table  border="0" cellpadding="0" cellspacing="0" width="100%">

<tr>
	<td>
		<!-- TABLA INTERNA -->

		<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">

			<tr>
				<td bgcolor="#32E3CC" align="center">
					<h1 style="font-family: 'Helvetica';">
					 	<span>
					 		<img src="http://carreracaminatagaitera.org.ve/img/emails/brand.png" alt="" />
					 	</span>
						Validación de registro
					</h1>
				</td>
			</tr>

			<tr align="center">
				<td>
					<table  border="0" cellpadding="0" >
						
						<tr>
							<td>
								<h1 style="font-family: 'Helvetica';">
									Hola {{ $persona->nombres }}.
								</h1>
							</td>
						</tr>
						<tr>
							<td>
								<p style="font-family: 'Helvetica';"> 

									Te informamos que tu pago ha sido validado y se ha procesado tu solicitud de inscripción en el evento quedando asignado(a) en la categoría 
									@foreach($categorias as $categoria)
										@if($categoria->id != 2)
											<strong>{{ $categoria->nombre_categoria }}</strong>,
										@endif
									@endforeach
									y su número (dorsal) asignado es <strong> {{ $numero }} </strong>.
									<br />
									<!-- ENLACE AL COMPROBANTE -->
									Imprime el comprobante, ya que este deberá ser presentado con la liberación de responsabilidad el día de la entrega del kit. <br />
									De no ser retirado el kit personalmente, se debe presentar el comprobante, liberación de responsabilidad, autorización firmada, fotocopia de la cédula del participante y del autorizado.
									<!-- FIN DEL ENLACE -->
									<br />
									<br />
									<center style="font-family: 'Helvetica';">
										<h3>Reflexión:</h3>
										<br />
										El sudor se seca, el cansancio termina, pero hay algo que nunca va a desaparacer: la satisfacción de haber logrado lo que te habías propuesto.
									</center>
									
								</p>
								<br />
								<br />
								<br />
								<center style="font-family: 'Helvetica'; margin-top: 20px; margin-bottom: 33px;">
										
										<a href="http://intranet.corpozulia.gob.ve:90/index.php/comprobante?_code={{ $token }}" target="_blank" style="
											color: #fff;
											background-color: #2F88CC;
											padding-top: 20px;
											padding-left: 10px;
											padding-right: 10px;
											padding-bottom: 20px;
											border-radius: 8px;
											text-decoration: none;
											margin-bottom: 12px;
										">
											<strong>
												Comprobante de inscripción y liberación de responsabilidad
											</strong>
										</a>
								</center>
								<p style="font-family: 'Helvetica';">
									Saludos,
									<h3 style="font-family: 'Helvetica'; margin-top: -8px;">
										Comité organizador.
									</h3>
								</p>
							</td>
						</tr>

					</table>
				</td>
			</tr>

			<tr bgcolor="#EEEEEE">
				<td >
					<table border="0" cellpadding="0" cellspacing="0" style="padding-right: 8px;">
						<tr>
							<td style="padding-bottom: 10px; padding-top: 10px; padding-left: 8px;"  align="left">
								<div>
									<p style="font-family: 'Helvetica'; font-size: 12px; color: #a3a3a3;">
										Desarrollado por la gerencia de informática y sistemas
									</p>
								</div>
								<div>
									<p style="font-family: 'Helvetica'; font-size: 12px; color: #a3a3a3; margin-top: -12px;">
										Corporación para el desarrollo de la región zuliana
									</p>
								</div>
								<div>
									<p style="font-family: 'Helvetica'; font-size: 12px; color: #a3a3a3; margin-top: -12px;">
										CORPOZULIA
									</p>
								</div>
								<div>
									<p style="font-family: 'Helvetica'; font-size: 12px; color: #a3a3a3; margin-top: -12px;">
										&copy; Todos los derechos reservados.
									</p>
								</div>
							</td>
						</tr>
						<tr>
							<td align="left">
								<div>
									<p style="font-family: 'Helvetica'; font-size: 12px; color: #a3a3a3; margin-top: -12px; margin-left: 8px;">
										<a href="http://carreracaminatagaitera.org.ve/archivos/carrera.pdf" style="color:#a3a3a3;" target="_blank">
											Reglamento
										</a> | 
										<a href="http://carreracaminatagaitera.org.ve/" style="color: #a3a3a3" target="_blank">
											Inscribete
										</a>
									</p>
								</div>
							</td>
							<td align="right">
								<span style="line-height:20px;font-size:10px">
									<a href="" taget="_blank">
										<img src="https://ci3.googleusercontent.com/proxy/DPEVDIl7zTJOuNLg0B_ewL3E0lz2b_reW6NcJHxwtYzW87NjV1HxSckdR97aBc03mSpFWIL47omxZxxCaae02tnxlF4j5ju-UfDyjXZ2r91__Pb6mUpd-iJ981I6Viepc-mU0ovHzbtrYUnDWmsv0Dn9wup-l7NCgA=s0-d-e1-ft#https://dtqn2osro0nhk.cloudfront.net/static/images/email/build/19589dd1df3811138bd6da9412853037.png" alt="" />
									</a>
								</span>
								<span style="line-height:20px;font-size:10px">
									<a href="">
										<img src="http://carreracaminatagaitera.org.ve/img/emails/instagram.png" alt="" />
									</a>
								</span>	
								<span style="line-height:20px;font-size:10px">
									<a href="">
										<img src="http://carreracaminatagaitera.org.ve/img/emails/twitter.png" alt="" />
									</a>
								</span>	

							</td>
						</tr>
					</table>
				</td>
			</tr>
			
		</table>

		<!-- FIN DE LA TABLA INTERNA -->
	</td>
</tr>

</table>	

	
</body>
 
</html>
