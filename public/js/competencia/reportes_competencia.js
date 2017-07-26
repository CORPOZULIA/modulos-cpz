var app = angular.module('reportes', []);

app.controller('reportesController', function($scope, $http){
	var personas = [];
	$scope.fecha_desde = '';
	$scope.fecha_hasta = '';

	$scope.dependencias = []
	$scope.reportes = [
		{
			tipo: '---',
			nombre: '----',
			ths: []
		},
		{
			tipo: 'PorGerencia',
			nombre: 'Por gerencia',
			filtro: 'validado',
			ths: [ 'Nombres', 'Apellidos', 'Cedula', 'Competencia', 'Modo de pago', 'Gerencia' ],
			depende: [],
		},
		{
			tipo: 'PorValidacion',
			nombre: 'Por validación',
			filtro: 'validado',
			ths: [ 'Nombres', 'Apellidos', 'Cedula', 'Competencia', 'Modo de pago' , 'Estatus'],
			depende: [
				{
					nombre: 'Solo validados',
					tipo: 'VALIDADO'
				},
				{
					nombre: 'Sin validar',
					tipo: 'SIN VALIDAR',
				},
			],
		},
		{
			tipo: 'PorPago',
			nombre: 'Por tipo de pago',
			ths: [ 'Nombres', 'Apellidos', 'Cedula', 'Competencia', 'Modo de pago' ,],
			filtro: 'denominacion_tipo',
			depende: [
				{
					nombre: 'Depósito',
					tipo: 'DEPOSITO'
				},
				{
					nombre: 'Por transferencia',
					tipo: 'TRANSFERENCIA',
				},
				{
					nombre: 'Caja de ahorros',
					tipo: 'CAJA DE AHORROS',
				},
			],
		},	

	];

	$scope.changeTipo = function()
	{
		var success = function(data){
			if(data.status == 200){ 
				personas = $scope.personas = data.data;
			}

		};
		var err = function(data){
			$scope.personas = []
		};

		$scope.url = location.href+'/generarReporte/'+$scope.tipo_reporte;
		if($scope.tipo_reporte == '---')
		{
			$scope.bandera=true;
			return false;
		}
		
		if( personas.length == 0 )
			$http.get($scope.url).then(success, err);

		$scope.reportes.forEach(function(reporte, indice){
			if($scope.tipo_reporte == reporte.tipo && reporte.tipo != '---'){
				$scope.ths = reporte.ths;
				$scope.bandera = false;
				$scope.dependencias = reporte.depende;
			}
		});
	}

	/**
	 * ENVIA SOLICITUD AJAX AL SERVIDOR DEPENDIENDO DEL 
	 * TIPO DE REPORTE QUE SE GENERARA
	 * 
	 */
	$scope.cambioFiltro = function (filtro = ''){
		if($scope.tipo_reporte == 'PorValidacion')
		{
			$scope.personas = [];
			personas.forEach(function(persona, indice){

				if(persona['validado'] == $scope.filtro)
				{
					$scope.personas.push(persona);
				}
			})
		}
		else $scope.personas = personas;
	}

});