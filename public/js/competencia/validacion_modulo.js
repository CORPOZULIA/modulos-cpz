var app = angular.module('competenciaApp', []);

app.controller('controlador_validaciones', function($scope, $http, $interval){
	var url = location.href;

	function successCallback(data, status, headers){
	 	var datos = data.data;
	 	if( data.status == 200){
	 		$scope.personas = datos;
	 	}
	 	else alert('Ha ocurrido un error interno, contacte con el administrador de sistema')
	}

	function errorCallback(err){
		console.log(err);
	}

	/**
	 * cuando se le da click a un boton que
	 * dispare la apertura de una ventana modal
	 * @param  {integer} id       id para buscar informacion
	 * @param  {String} tipoModal informacion que se desea buscar
	 * @param  {String} metodo    metodo por el que se enviara la informacfion
	 */
	$scope.modalButton = function (id, tipoModal='', metodo = ''){
		
		var url = location.host;
	
		var data = $scope.personas.length;
		for(var i= 0; i <=data; i++ ){
			if( id == $scope.personas[i].solicitud.id )
			{
				$scope.nombres = $scope.personas[i].personas.nombres;
				$scope.apellidos = $scope.personas[i].personas.apellidos;
				$scope.cedula = $scope.personas[i].personas.cedula;
				$scope.numero_deposito = $scope.personas[i].solicitud.numero_deposito;
				$scope.modalidad_pago = $scope.personas[i].pago.denominacion_tipo;
				$scope.tipo_competencia = $scope.personas[i].solicitud.competencia.nombre_tipo;
				$scope.imagen_deposito =  'http://'+url+'/img/depositos/'+$scope.personas[i].solicitud.imagen_deposito;
				$scope.num_tlfno = $scope.personas[i].personas.telefono_personal
				$scope.email = $scope.personas[i].personas.email
				break;
			}
		}

	}

	/**
	 * CUANDO SE PRESIONA EL BOTON DE VALIDAR SE ACTIVA ESTA FUNCIÓN
	 * @param  {integer} id ID DE LA SOLICITUD
	 */
	$scope.validateBtn = function(id, pos){
		var url = location.href +'/validarSolicitud';
		var token = document.getElementById('token').value;
		
		var correcto = function (data){
			datos = data.data
			alert(datos.mensaje);
			if(!datos.error){
				$scope.personas.splice( pos, 1 );
			}
		}
		var error = function(err){
			console.log(err);
		}

		if(confirm('¿Seguro que quiere validar esta persona?'))
		{
			$http.post(url, {'solicitud_id': id, '_token': token})
					.then(correcto, error);
		}

	}

	var promise = $http.get(url+'/getSolicitudes');
	promise.then(successCallback, errorCallback);

});