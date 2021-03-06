<?php  

/*
/-------------------------------------------------------------
/	CONFIGURACION DE MODULOS PRE CARGADOS EN EL SISTEMA
/-------------------------------------------------------------
/ 	ESTE ARCHIVO CONTIENE TODOS LOS MODULOS DEL SISTEMA
/ 	PARA EFECTOS DE LA INSTALACIÓN DEL SISTEMA 
/	ESTE ARCHIVO CONTIENE TODOS LOS MODULOS POR DEFECTO QUE
/	POSEE EL SISTEMA. PARA EFECTOS DE CONTROL, SE RECOMIENDA
/	REGISTRAR LOS MODULOS EN ESTE APARTADO.
/-------------------------------------------------------------
/		ESTRUCTURA PARA REGISTRAR UN MODULO
/-------------------------------------------------------------
/
/	[
/		*--- ATRIBUTOS DEL MODULO ---*
/		programas[del modulo] => [ *--- ATRIBUTOS DEL PROGRAMA --* ]
/	]
/
/	* SI EL MODULO ES CREADO POSTERIOR A LA INSTALACIÓN, ENTONCES
/		SE RECOMIENDA REGISTRAR EL MODULO Y SUS PROGRAMAS MANUALMENTE EN LA
/		BASE DE DATOS *
*/

return [
	
	/**
	 * MODULO DE GESTION DE USUARIOS (MODULO PRINCIPAL)
	 */
	
	[
		'nombre_modulo'		=> 'Gestion de usuarios',
		'descripcion_modulo' => 'Modulo para gestionar usuarios del sistema',
		'url_modulo'	=> 'usuarios',
		'programas'		=> [

			//PROGRAMAS DEL MODULO
			[
				'nombre_programa'	=> 'Usuarios del sistema' ,
				'descripcion_programa' => 'Programa para listar, ver, suprimir y crear usuarios en el sistema',
				'url_programa'	=> 'usuarios/Usuarios',
			],

			//FIN DE LOS PROGRAMAS DEL MODULO
		],
	],

	/*
	*	MODULO DE CORPOSALUD (GASTOS MEDICOS)
	*/
	[
		'nombre_modulo'	=> 'Corposalud',
		'descripcion_modulo' => 'MODULO DE GASTOS MEDICOS',
		'url_modulo'	=> 'corposalud',

		'programas' => [

			//PROGRAMAS DE CORPOALUD
			[		
				'nombre_programa' => 'Gestion de facturas',
				'descripcion_programa' => 'Programa para gestionar las facturas de CORPOSALUD',
				'url_programa' 	=> 'corposalud/Corposalud'
			]

		],
	],

	/*
		PROGRAMA PARA LA SOLICITUD DE LAS DIFERENTES CONSTANCIAS Y RECIBOS
	*/
	[
		'nombre_modulo'	=> 'Constancias',
		'descripcion_modulo' => 'Modulo para la revisión y  emisión de  constancias en el trabajp',
		'url_modulo'	=> 'constancias',

		'programas' => [

			//PROGRAMAS DE CORPOALUD
			[		
				'nombre_programa' => 'Recibo de pago',
				'descripcion_programa' => 'Programa para revisión de recibos de pago de los empleados',
				'url_programa' 	=> 'constancias/Recibos'
			],

			[
				'nombre_programa' => 'Trabajo',
				'descripcion_programa' => 'Programa para revision de constancias de trabajo del personal contratado',
				'url_programa' => 'constancias/Trabajo'
			],

			[
				'nombre_programa' => 'Buena Conducta',
				'descripcion_programa' =>'Programa para solicitud de catara de buena conducta',
				'url_programa' => 'constancias/Conducta'
			],

		],
	],
	/**
	 * MODULO PARA LA CARRERA
	 */
	[
		'nombre_modulo'		=> 'Gestion de CARRERACAMINATA',
		'descripcion_modulo' => 'MODULO PARA GESTION ADMINISTRATIVA DE LA CARRERA CAMINATA GAITERA',
		'url_modulo'	=> 'competencia',
		'programas'		=> [

			//PROGRAMAS DEL MODULO
			[
				'nombre_programa'	=> 'Validaciones de solicitudes' ,
				'descripcion_programa' => 'PROGRAMA PARA GESTIONAR LAS SOLICITUDES DE INSCRIPCION',
				'url_programa'	=> 'competencia/Solicitud',
			],

			//PROGRAMAS DEL MODULO
			[
				'nombre_programa'	=> 'Registro de competencias' ,
				'descripcion_programa' => 'Programa para crear, editar y gestionar eventos (nuevas competencias)',
				'url_programa'	=> 'competencia/Registro',
			],

			//FIN DE LOS PROGRAMAS DEL MODULO
		],
	],

	[
		'nombre_modulo'		=> 'GESTION ADMINISTRATIVA DE BIENES',
		'descripcion_modulo' => 'MODULO PARA GESTION ADMINISTRATIVA DEL MODULO DE BIENES',
		'url_modulo'	=> 'competencia',
		'programas'		=> [

			//FIN DE LOS PROGRAMAS DEL MODULO
		],
	],
	[
		'nombre_modulo' => 'Administracion',
		'descripcion_modulo' => 'Modulo para la administracion a distancia mediante GIT',
		'url_modulo' => 'administracion',
		'programas' => [
			[
				'nombre_programa' => 'Consola GIT',
				'descripcion_programa' => 'Consola de manejo de GIT',
				'url_modulo' => 'administracion/git'
			],
		]
	]

];