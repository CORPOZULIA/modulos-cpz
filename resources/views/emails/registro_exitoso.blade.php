<!DOCTYPE html>
<html>
<head>
	<title>Notificación de registro</title>
	<meta charset="utf-8">
</head>
<body>

<style>
	#header{
		color: #fff;
		background: red;
		font-family: 'Helvetica';
		padding-top: 12px;
		padding-bottom: 12px;
		padding-left: 12px;

	}
	
	#body{
		font-family: Helvetica;
	}
</style>

<section id="header">	
	<div class="header">
		<h1>¡Gracias por registrarte!</h1>
	</div>
</section>

<section id="body">
	
	<p>
		Hola {{ ucwords($nombres).' '.ucwords($apellidos) }}, te notificamos que has logrado registrar exitosamente, con la
		 <strong> Cedula de Identidad: {{ $nacionalidad_cod.'-'.$cedula }} </strong>,
		 el teléfono <strong> {{ $telefono }} </strong> de <strong> nacionalidad {{ $nacionalidad }}</strong> y la <strong>fecha de nacimiento {{ $fec_nac }}.</strong>
			<br><br>

		Si alguno de tus datos son incorrectos, envia un correo a carreragaitera@gmail.com. 
		Una vez que tu pago se valide recibiras un nuevo correo con mayor información.
	</p>

</section>

</body>
</html>