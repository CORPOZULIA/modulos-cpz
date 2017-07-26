function codigo(codigo_hardware){
	//window.open(location.href+'/factura', 'popup');
	html = $("#productos_lista").html();
	html = html+'<tr><td><input type="text" class="form-control" name="cantidad[]" value="3"></td><td><input type="text" class="form-control disabled" name="producto[]" value="Mouse genius"></td><td><input type="text" class="form-control disabled" name="precio[]" value="1100"></td></tr>';
	$("#productos_lista").html(html);
	$("#productos_lista").focus();
}