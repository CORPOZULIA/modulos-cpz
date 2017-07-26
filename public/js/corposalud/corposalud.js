var url = location.href;
var total = 0.0;
$(document).ready(function(){

    var disabled = function(disabled_btn){
        if( disabled_btn.hasClass('disabled'))
        {
            alert('Esta función esta temporalmente dasabilitada, estamos trabajando en ella, por favor, tenga un poco de calma :D');
            return false;
        }
        return true;

    };

    $('#dataTables-example').DataTable({
        responsive: true,
        "language" : {
            "lengthMenu": "Mostrar _MENU_ resultados por pagina",
            "zeroRecords" : "No se han encontrado registros.",
            "info" : "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay datos para mostrar.",
            "search" : "Buscar: "
        }
    });

    /**
    *	CARGAR EL FORMULARIO SOLICITADO AL DARLE CLICK
    *	A UNO DE LOS BOTONES QUE POSEAN LA CLASE btn-forms
    *	EL FORMULARIO SE ENCUENTRA EN EL ATRIBUTO
    *	"FORMULARIO"
    *	SE REALIZA LA SOLICITUD VIA AJAX CON LA FUNCION $.getJSON de Jquery
    *   HACIA LA URL ACTUAL (location.href) 
    */
    $(".btn-forms").click(function(){

    	//$("#verificando").html('<div class="loader"></div>');
        if( disabled( $(this) ) )
        {
        	var url = location.href +'/formulario/'+$(this).attr('formulario');
        	$.getJSON(url, '', function(response){
        		
        		if(! response.fail)
        		{
        			$("#form-load").html(response.mensaje);

        		}

        	});
        }
    });

    $(".btn-consulta").click(function(){
        if( disabled( $(this) ) )
        {
            var url = location.hostname+':8000/'+$(this).attr('url')+'/'+$(this).attr('formulario');
            $.getJSON(url, '', function(response){
                alert("algo");
            })
        }
    });

    $("#modal-click").click(function(){
        var url = location.href + '/'+$('#accion').attr('value');
        var datos = $('#cargar_info').serialize();
        $.post(url,datos,function(response){
            if(! response.fail)
            {
                if (response.pdf) {
                    window.open(location.href + '/ver_reporte/' + response.pdf,'popup');
                }
                location.reload();
            }
            else alert(response.mensaje);
        });
        $("#total").attr('value', 0);

    });

});


/**
* FUNCION PARA PARA BUSCAR UN TIPO DE FACTURA, ENVIA UNA SOLICITUD AJAX
* AL SERVIDOR 
*/
function buscarTipoFactura(evento, codigo)
{
	var url = location.href +'/tipoDeFactura/'+codigo;

	$.getJSON(url, '', function(response){
        $("#descripcion_factura").attr('value', 'Buscando...');
		if(! response.fail)
		{ 
            $("#numero_factura").prop('disabled', false);
		    $("#descripcion_factura").attr('value', response.tipos.descripcion_factura);	
            $("#tipo_factura_id").attr('value', response.tipos.id);	
        }

	});
}


/**
*   FUNCION PARA ACTIVAR EL RESTO DEL FORMULARIO SI Y SOLO SI LOS DATOS DE LA FACTURA HA SIDO
*   COMPLETAMENTE INGRESADA
*/

function activarFormulario(evento, valor)
{
    if(valor!='')
    {
        $("#total").prop('disabled', false);
        $("#total").attr('onlyread', 'onlyread');
        if($("#detalles_factura").hasClass('hidden')) $("#detalles_factura").removeClass('hidden');
    }
    else alert("EL NUMERO DE LA FACTURA DEBE SER ESCRITO");
}

/**
*   FUNCION PARA CONSULTAR PERSONA EN EL SISTEMA
*   TIENE COMO TAREA BUSCAR POR UN FUNCIONARIO POR SU NUMERO DE CEDULA EN EL SISTEMA
*/

function consultarPersona(evento, cedula)
{
    if(cedula!='')
    {

        $.getJSON(url+'/consultarPersona/'+cedula, '', function(response){

            if(! response.fail){
                $("#beneficiario_id").attr('value', response.beneficiario);
                $("#nombres").attr('value', response.persona.nombres+' '+response.persona.apellidos);
                if($("#detalles").hasClass('hidden')) $("#detalles").removeClass('hidden');
            }
            else alert(response.mensaje)
        });
    }
}

/**
*   FUNCION ENCARGADA DE LIMPIAR EL FORMULARIO DE LOS DETALLES
*   DE LA FACTURA, EL INPUT DE LOS NOMBRES Y EL ID DEL BENEFICIARIO
*/

function limpiarPersona(evento, cedula)
{   
    $("#beneficiario_id").attr('value', '');
    $("#nombres").attr('value', '');
}

/**
*   FUNCIÓN QUE SE ENCARGA DE VERIFICAR QUE EL CAMPO DE DESCRIPCIÓN
*   ESTA LLENO
*/

function verificarDescripcion(evento,descripcion){
    if (evento.keyCode==13 && descripcion!='') {

        $('.costo').prop('disabled', false)
    }
}


/**
*   FUNCIÓN ENCARGADA DE CALCULAR EL TOTAL QUE SE VA MOSTRANDO
*   EN EL INPUT TIPO TOTAL
*/
function calcularTotal(evento,valor){
    if (evento.keyCode==13 && valor!='') {
        $('#costo').prop('disabled', false)
        total += parseFloat(valor);
        $('#total').attr('value',total);

        //SE INSERTA UNA NUEVA FILA EN LA TABLA DE LOS DETALLES
        $("#tbody").append('<tr><td><input type="text" name="descripcion_gasto[]" id="descripcion_gasto" onkeypress="verificarDescripcion(event,this.value)" class="form-control"></td><td><input type="number" name="costo[]" value="0" disabled onkeypress="calcularTotal(event,this.value)" class="form-control costo"></td></tr>');
    }
}

function buscarFactura(evento, numero_factura){

    if (evento.keyCode==13 && numero_factura!='') {
        evento.preventDefault();

        $.getJSON(url+'/buscarFactura/'+numero_factura, '', function(response){
            $("#nombres").val(response.beneficiario.nombres+' '+response.beneficiario.apellidos);
            $("#cedula").val(response.beneficiario.cedula);
            $("#total").val(response.factura.total);
            $("#factura_id").val(response.factura.id);

            var detalle = '';
            for(var i = 0; i< response.detalles.length; i++)
            {
                detalle += '<tr><td><input type="text" disabled name="descripcion_gasto[]" id="descripcion_gasto" onkeypress="verificarDescripcion(event,this.value)" value="'+response.detalles[i].descripcion_gasto+'" class="form-control"></td><td><input type="number" name="costo[]" disabled onkeypress="calcularTotal(event,this.value)" value="'+response.detalles[i].costo+'" class="form-control costo"></td></tr>';
            }
            if( response.suprimir)
            {
                if( $("#suprimir").hasClass('disabled')) $("#suprimir").removeClass('disabled');
            }

            $("#detalles").html(detalle);
        });
    }

}


function suprimir(evento)
{
    evento.preventDefault();
    var data = $("#cargar_info").serialize();
    alert(data);

    $.post(url+'/' + $("#accion").val(), data, function(response){

        if(! response.false)
        {
            alert(response.mensaje);
        }

    });
}