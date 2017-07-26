
function desabilitar_bancos(parametro){

  var carga_banco=document.getElementById("txtbanco");

  document.getElementById('banco').value='';
  document.getElementById('denominacion').value='';

   document.getElementById('buscar_banco').innerHTML = '';

   $("#muestra_bancos").css({
    	display: 'none',
    });
   
   if (parametro=="un_banco") {

    document.getElementById('buscar_banco').innerHTML = '<img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Cuentas Bancarias">'   
    $("#muestra_bancos").css({
    	display: 'block',
    });
   
   }

}

function desabilitar_cuentas(parametro){

  var carga_cuenta=document.getElementById("cuenta");
  document.getElementById('cuenta').value='';
  document.getElementById('nombre_cuenta').value='';
   document.getElementById('buscar_cuenta').innerHTML = '';

    $("#muestra_cuentas").css({
    	display: 'none',
    });


   if (parametro=="una_cuenta") {

    document.getElementById('buscar_cuenta').innerHTML = '<img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Cuentas Bancarias">'
    $("#muestra_cuentas").css({
    	display: 'block',
    });


   }

}



function ue_imprimir()
{
  ld_fecdesde    = f.txtfecdesde.value;
  ld_fechasta    = f.txtfechasta.value;
  ls_codban      = f.txtcodban.value;
  ls_nomban      = f.txtdenban.value;
  ls_modo_rep    = f.tipo_reporte1.value;
  if (ls_modo_rep=='una_cuenta') {

    ls_ctaban      = f.txtcuenta.value;
  ls_denctaban   = f.txtdenominacion.value;

  }
  else{
    ls_ctaban      = f.tipo_reporte1.value;
    ls_denctaban   ='TODAS';
  }
  
  
  ls_orden       = f.orden.value;
  ls_codconmov   = f.cmbconmov.value;
  li_fila        = f.cmbconmov.selectedIndex;
  ls_tiporeporte = f.cmbbsf.value;
  ls_desconmov   = f.cmbconmov.options[li_fila].text;
  if (f.chktipdes.checked==true)
     {
	   li_tipdes  = '1'; 
	   ls_reporte = "sigesp_scb_rpp_libro_banco_detallado.php";
	   ls_tiprep  = "D";
	 }
  else
     {
	   li_tipdes  = '0';
	   ls_reporte = "sigesp_scb_rpp_libro_banco_pdf.php";   
	   ls_tiprep  = "C";
	 }
  li_imprimir  = f.imprimir.value;
  if (li_imprimir=='1')
     {
       if ((ld_fecdesde!="")&&(ld_fechasta!="")&&(ls_codban!="")&&(ls_ctaban!=""))
          {
	        pagina="reportes/"+ls_reporte+"?fecdes="+ld_fecdesde+"&fechas="+ld_fechasta+"&codban="+ls_codban+"&ctaban="+ls_ctaban+"&orden="+ls_orden+"&nomban="+ls_nomban+"&denctaban="+ls_denctaban+"&tipdes="+li_tipdes+"&codconmov="+ls_codconmov+"&tiprep="+ls_tiprep+"&desconmov="+ls_desconmov+"&tiporeporte="+ls_tiporeporte+"&modo_reporte="+ls_modo_rep;
	        window.open(pagina,"catalogo","menubar=no,toolbar=no,scrollbars=yes,width=800,height=600,resizable=yes,location=no");
          }
        else
          {
   	        alert("Seleccione los parámetros de búsqueda !!!");
          }
	 }
  else
     {
	   alert("No tiene permiso para realizar esta operación !!!");
	 }
}

function ue_openexcel()
{
  ld_fecdesde    = f.txtfecdesde.value;
  ld_fechasta    = f.txtfechasta.value;
  ls_codban      = f.txtcodban.value;
  ls_ctaban      = f.txtcuenta.value;
  ls_orden       = f.orden.value;
  li_imprimir    = f.imprimir.value;
  ls_nomban      = f.txtdenban.value;
  ls_tiporeporte = f.cmbbsf.value;
  if (li_imprimir=='1')
     {
	  if (f.chktipdes.checked==true)
		 {
		   li_tipdes  = '1'; 
		   ls_reporte = "sigesp_scb_rpp_libro_banco_detallado_excel.php";
		   ls_tiprep  = "D";
		 }
	  else
		 {
		   li_tipdes  = '0';
		   ls_reporte = "sigesp_scb_rpp_libro_banco_excel.php";   
		   ls_tiprep  = "C";
		 }       
	 	  if ((ld_fecdesde!="")&&(ld_fechasta!="")&&(ls_codban!="")&&(ls_ctaban!=""))
          {
	        pagina="reportes/"+ls_reporte+"?fecdes="+ld_fecdesde+"&fechas="+ld_fechasta+"&codban="+ls_codban+"&ctaban="+ls_ctaban+"&orden="+ls_orden+"&nomban="+ls_nomban+"&tiporeporte="+ls_tiporeporte;
	        window.open(pagina,"catalogo","menubar=no,toolbar=no,scrollbars=yes,width=800,height=600,resizable=yes,location=no");
          }
        else
          {
   	        alert("Seleccione los parámetros de búsqueda !!!");
          }
	 }
  else
     {
	   alert("No tiene permiso para realizar esta operación !!!");
	 }
}

function uf_catalogoprov()
{
    f.operacion.value="BUSCAR";
    pagina="sigesp_catdin_prove.php";
    window.open(pagina,"catalogo","menubar=no,toolbar=no,scrollbars=yes,width=520,height=400,resizable=yes,location=no");
}

function rellenar_cad(cadena,longitud,objeto)
{
	var mystring=new String(cadena);
	cadena_ceros="";
	lencad=mystring.length;

	total=longitud-lencad;
	if (cadena!="")
	   {
		for (i=1;i<=total;i++)
			{
			  cadena_ceros=cadena_ceros+"0";
			}
		cadena=cadena_ceros+cadena;
		if (objeto=="txtcodprov1")
		   {
			 document.form1.txtcodprov1.value=cadena;
		   }
		 else
		   {
			 document.form1.txtcodprov2.value=cadena;
		   }  
        }
}

 function currencyDate(date)
  { 
	ls_date=date.value;
	li_long=ls_date.length;
			 
		if(li_long==2)
		{
			ls_date=ls_date+"/";
			ls_string=ls_date.substr(0,2);
			li_string=parseInt(ls_string,10);

			if((li_string>=1)&&(li_string<=31))
			{
				date.value=ls_date;
			}
			else
			{
				date.value="";
			}
			
		}
		if(li_long==5)
		{
			ls_date=ls_date+"/";
			ls_string=ls_date.substr(3,2);
			li_string=parseInt(ls_string,10);
			if((li_string>=1)&&(li_string<=12))
			{
				date.value=ls_date;
			}
			else
			{
				date.value=ls_date.substr(0,3);
			}
		}
		if(li_long==10)
		{
			ls_string=ls_date.substr(6,4);
			li_string=parseInt(ls_string,10);
			if((li_string>=1900)&&(li_string<=2090))
			{
				date.value=ls_date;
			}
			else
			{
				date.value=ls_date.substr(0,6);
			}
		}
   }

//Catalogo de cuentas catalogo_cuentabanco
	
	
	function cat_bancos()
	 {
	   pagina="sigesp_cat_bancos2.php";
	   window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=516,height=400,resizable=yes,location=no");
	 }


	function catalogo_cuentabanco()
	 {
	 	
		
	   ls_codban=document.getElementById('banco').value;
		
	   ls_denban=document.getElementById('denominacion').value;
	
	  	   if((ls_codban!=""))
		   {
			   pagina="sigesp_cat_ctabanco2.php?codigo="+ls_codban+"&hidnomban="+ls_denban;
			   window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=630,height=400,resizable=yes,location=no");
		   }
		   else
		   {
				alert("Seleccione el Banco");   
		   }
	 }	
	 	 

	function cat_conceptos()
	{
	   ls_codope=f.cmboperacion.value;
	   pagina="sigesp_cat_conceptos.php?codope="+ls_codope;
	   window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=516,height=400,resizable=yes,location=no");
	}

$("#imagen_buscar").on('click', function(){
	$("#bancos").html('');
	$.getJSON('http://192.168.0.17/sigesp/scb/views/bancos.php','',function(respuesta){
		alert("asdsd")

	});
});