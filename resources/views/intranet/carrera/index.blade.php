@extends('layouts.dashboard_layout')

@section('titulo', 'Modulo de gestion de competencias de CORPOZULIA')
@section('css')

<link rel="stylesheet" href="{{ asset('css/competencia/competencia.css') }}">

@endsection

@section('contenedor')

<h3 class="page-header">Validación de pagos</h3>

<div ng-app="competenciaApp">
<section ng-controller="controlador_validaciones">

    <div class="panel-body">
				
		<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
			<thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cedula</th>
                    <th>Numero de depósito</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr class="odd gradeX user_field" ng-repeat='persona in personas'>
          					<td>@{{ persona.personas.nombres | uppercase }}</td>
          					<td>@{{ persona.personas.apellidos | uppercase }}</td>
          					<td>@{{ persona.personas.cedula }}</td>
          					<td>@{{ persona.solicitud.numero_deposito}}</td>
          					<td>
                        <button class='btn btn-warning'  ng-click="modalButton( persona.solicitud.id )" data-toggle="modal" data-target="#modal_forms"> 
                            <i class="glyphicon glyphicon-eye-open"></i> 
                        </button>

                        <button class="btn btn-success" ng-click='validateBtn(persona.solicitud.id, personas.indexOf(persona))'>
                            <i class="glyphicon glyphicon-ok"></i>
                        </button>           
                    </td>
                </tr>
            </tbody>
		</table>

    </div>

<!-- VENTANA MODAL -->
<div class="modal fade" id="modal_forms" tabindex="-1" role="dialog" aria-labelledby="modal_formsLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalles de solicitud &nbsp;&nbsp;&nbsp;&nbsp; <span id="verificando"></span> </h4>
      </div>
      <div class="modal-body">

        <div class="container">
            <div class="row">
            <!-- INICIO DEL FORMULARIO -->
                <form action="" method="post"   id="cargar_info">
                  <div class="row">
                        <div class="col-sm-5">
                            <label for="nombres">Email</label>
                            <input type="text" name="nombres" id="nombres" ng-model="email" readonly class="form-control">
                            
                        </div> 
                  </div>
                    <div class="row" id="row-form">
                        <input type="hidden" id="user_id" name="user_id" value="">

                       
                        <div class="col-sm-3">
                            <label for="nombres">Nombres</label>
                            <input type="text" name="nombres" id="nombres" ng-model="nombres" readonly class="form-control">
                            
                        </div>
                        <div class="col-sm-3">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" ng-model="apellidos" readonly class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <label for="cedula">Cedula</label>
                            <input type="text" name="cedula" ng-model="cedula" readonly class="form-control">
                        </div>
                        <div class="separator"></div>
                        
                    </div>
                    <input type="hidden" value="{{ csrf_token() }}" id="token">
                    <div class="row">
                       <!-- SECCION DE LOS INPUTS CON LOS DATOS
                            DE LA TRANSACCION BANCARIA -->
                       <div class="col-sm-4">
                           <section id="inputs">
                               <div class="container">
                                   <div class="row">
                                       <div class="col-sm-2">
                                            <label for="numero_deposito">Número de movimiento</label>
                                            <input type="text" name="numero_transaccion" readonly class="form-control" ng-model=" numero_deposito">
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-sm-2">
                                            <label for="tipo_pago">Modalidad de pago</label>
                                            <input type="text" name="tipo_pago" readonly class="form-control" ng-model="modalidad_pago">
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-sm-2">
                                            <label for="tipo_carrera">Tipo de competencia</label>
                                            <input type="text" name="tipo_competencia" readonly class="form-control" ng-model="tipo_competencia">
                                        </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-sm-2">
                                            <label for="tipo_carrera">Número de contacto</label>
                                            <input type="text" name="tipo_competencia" readonly class="form-control" ng-model="num_tlfno">
                                        </div>
                                   </div>

                               </div>
                           </section>
                       </div>
                       <!-- fin de la seccion -->

                       <!-- SOPORTE DEL PAGO -->
                       <div class="col-sm-4 form-details">
                           <section id="soporte">
                               <div class="container">
                                    <div class="row">
                                        <div class="col-sm-4">
                                             <h3 class="page-header">
                                                <strong>Soporte de la transacción</strong>
                                            </h3>
                                        </div>
                                    </div>
                                   <div class="row">
                                       <div class="col-sm-6">
                                            <img ng-src="@{{imagen_deposito}}" alt="" id="imagen_deposito" style="max-width: 350px; max-height: 370px;">
                                        </div>
                                   </div>
                                   <br>
                                   <div class="row">
                                        <div class="col-sm-7">
                                            <a href="@{{ imagen_deposito }}" class="btn btn-danger">
                                               <i class="glyphicon glyphicon-save"></i> Click aquí para descargar soporte
                                            </a>
                                        </div>
                                   </div>
                               </div>
                           </section>
                       </div>

                    </div>

                </form>
            </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar ventana</button>
        <button type="button" class="btn btn-primary" id="modal-click">Salvar cambios</button>
      </div>
    </div>
  </div>
</div>

<!-- FIN DE LA VENTANA MODAL -->
</div>

</section>

</div>


@endsection
@section('jquery')
<script src=" {{ asset('js/competencia/angular/angular.min.js') }} "></script>
<script src=" {{ asset('js/competencia/validacion_modulo.js') }} "></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src=" {{ asset('js/dataTables.bootstrap.min.js') }} "></script>
<script src="{{ asset('js/dataTables.responsive.js')  }}"></script>
<script>
    $(document).ready(function(){
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>

@endsection