/*=============================================
ACTIVAR NOTIFICACIÓN
=============================================*/
$(document).ready(function(){
    $("#tblnotificacion").on("click", ".btnnotificacionprogramada", function(){
		var idnotificacion 	= $(this).attr("idnotificacion");
		var estado			= $(this).attr("estado");
		
		var dataString	= {idnotificacion:idnotificacion,estado:estado};

		$.ajax({

		  url: base_url + "notificacion/estadoprogramado",
		  method: "POST",
		  data: dataString,
		  success: function(respuesta){

					 swal({
					  title: "La Notificación ha sido actualizado",
					  type: "success",
					  confirmButtonText: "¡Cerrar!"
					}).then(function(result) {
						if (result.value) {
							window.location = "notificacion";
						}
					});
			}
		});

		if( estado === "0" ){
			$(this).removeClass('btn-success');
			$(this).addClass('btn-danger');
			$(this).html("<i class='fa fa-times'></i>");
			$(this).attr('estado',1);
		}else{
			$(this).removeClass('btn-danger');
			$(this).addClass('btn-success');
			$(this).html("<i class='fa fa-check'></i>");
			$(this).attr('estado',0);
		}
    });
});//FIN DOCUMENT

/*=============================================
GET VER NOTIFICACIÓN
=============================================*/
$(document).ready(function(){
	$("#tblnotificacion").on("click", ".btnGetVerNotificacion", function(){
		
		$(".modal-body").hide();		
		$('#getNotificacionloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');

		var idnotificacion = $(this).attr("idnotificacion");

		var dataString	= {idnotificacion:idnotificacion};

		$.ajax({

			url: base_url + "notificacion/getnotificacion",
			method: "POST",
			data: dataString,
			dataType: "json",
			success: function(respuesta){
				$("#getNotificacionId").text(respuesta.notificacion.NOTIFICACION_ID);
				$("#getNotificacionIdEmpresa").text(respuesta.notificacion.EMPRESA_ID);
				$("#getNotificacionEmpresa").text(respuesta.notificacion.EMPRESA_NOMBRE);
				$("#getNotificacionTexto").text(respuesta.notificacion.NOTIFICACION_TEXTO);
				$("#getNotificacionIngreso").text(respuesta.notificacion.NOTIFICACION_INGRESO);
				$("#getNotificacionEnvio").text(respuesta.notificacion.NOTIFICACION_ENVIO);
				var programada = ( respuesta.notificacion.NOTIFICACION_PROGRAMADA === "1" ? "SI" : "NO");
				$("#getNotificacionProgramada").text(programada);
				$("#getNotificacionTipoCompra").text(respuesta.notificacion.TIPO_COMPRA_NOMBRE);
				$("#getNotificacionObs").text(respuesta.notificacion.NOTIFICACION_TIPO_OBS);
				$("#getNotificacionTipoMonto").text(respuesta.notificacion.TIPO_MONTO_NOMBRE);
				var aprobado = ( respuesta.notificacion.NOTIFICACION_FLAG === "1" ? "SI" : "NO");
				$("#getNotificacionFlag").text(aprobado);

				if(respuesta.notificacion.NOTIFICACION_IMG !== null){
					$("#getNotificacionImg").html('<a href="'+respuesta.notificacion.NOTIFICACION_IMG+'" target="_blank"><img src="'+respuesta.notificacion.NOTIFICACION_IMG+'" class="img-thumbnail" width="50%"></a>');
				}else{
					$(".previsualizarNotificacion").attr("src", base_url + "public/images/food-defecto.png");
				}

				if(respuesta.notificacion.EMPRESA_LOGOTIPO !== null){
					$(".previsualizarVerLogoEmpresa").attr("src", base_url + respuesta.notificacion.EMPRESA_LOGOTIPO);
				}else{
					$(".previsualizarVerLogoEmpresa").attr("src", base_url + "public/images/food-defecto.png");
				}

				$('#getNotificacionloading').html('');
				$(".modal-body").show();
			}

		});

	});
});//FIN DOCUMENT

/*=============================================
GET TIPO DE PAGO NOTIFICACIÓN
=============================================*/
$(document).ready(function(){
	$("#tblnotificacion").on("click", ".btnInsertTipoPago", function(){

		$("#pago-efectivo").hide();
		$("#txt-obs").hide();
		$("#btnInsertTipoPagoDiv").hide();
		$(".modal-body").hide();
		$('.btn-group-toggle label').removeClass("active");
		$('#getPagoNotificacionloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');

		var idnotificacion = $(this).attr("idnotificacion");
		
		var dataString	= {idnotificacion:idnotificacion};

		$.ajax({

			url: base_url + "notificacion/getnotificacion",
			method: "POST",
			data: dataString,
			dataType: "json",
			success: function(respuesta){
				$("#getPagoNotificacionId").text(respuesta.notificacion.NOTIFICACION_ID);
				$("#getPagoNotificacionEmpresa").text(respuesta.notificacion.EMPRESA_NOMBRE);
				$("#getPagoNotificacionTexto").text(respuesta.notificacion.NOTIFICACION_TEXTO);
				
				if(respuesta.notificacion.NOTIFICACION_IMG !== null){
					$("#getPagoNotificacionImg").html('<a href="'+respuesta.notificacion.NOTIFICACION_IMG+'" target="_blank"><img src="'+respuesta.notificacion.NOTIFICACION_IMG+'" class="img-thumbnail" width="80%"></a>');
				}else{
					$(".previsualizarNotificacion").attr("src", base_url + "public/images/food-defecto.png");
				}
				
				if(respuesta.notificacion.EMPRESA_LOGOTIPO !== null){
					$(".previsualizarVerLogoEmpresa").attr("src", base_url + respuesta.notificacion.EMPRESA_LOGOTIPO);
				}else{
					$(".previsualizarVerLogoEmpresa").attr("src", base_url + "public/images/food-defecto.png");
				}

				$('#getPagoNotificacionloading').html('');
				$(".modal-body").show();
			}

		});

	});
});//FIN DOCUMENT

/*=============================================
AGREGAR TEXTAREA/MONTO PAGO NOTIFICACIÓN
=============================================*/
$(document).ready(function(){
	$("#pago-efectivo").hide();
	$("#txt-obs").hide();
	$("#btnInsertTipoPagoDiv").hide();
	$("input[name=opttipopago]").change(function () {
		
		var opttipopago = $(this).val();
		
		if( opttipopago === "1" ){
			$("#pago-efectivo").show(500);
		}else{
			$("#pago-efectivo").hide(500);
		}
		
		$("#txt-obs").show(500);
		$("#btnInsertTipoPagoDiv").show(500);
		
	});
});

/*=============================================
INSERT TIPO DE PAGO NOTIFICACIÓN
=============================================*/
$(document).ready(function(){
	$("#modalInsertTipoPago").on("click", "#btnInsertTipoPago", function(){
		
		var idNotificacion 	= $("#getPagoNotificacionId").text();
		var opttipopago 	= $("input[name=opttipopago]:checked").val();
		var optpagoefectivo = $("input[name=optpagoefectivo]:checked").val();
		var observacion 	= $("#observacion").val();
		
		var dataString	= {idNotificacion:idNotificacion, opttipopago:opttipopago, optpagoefectivo:optpagoefectivo, observacion:observacion};

		$.ajax({

			url: base_url + "notificacion/insertnotificacionpago",
			method: "POST",
			data: dataString,
			success: function(respuesta){				
//				alert(idNotificacion);
				
				if( respuesta === "1" ){
					swal({
						title: "Ingresado!",
						text: "El tipo de pago ha sido ingresado con éxito!!!",
						type: "success"
					}, function() {
						window.location = base_url + "notificacion";
					});
				}else{
//					$('#loading').html('');
					swal({
						title: "Error!",
						text: respuesta,
						type: "error"
					});
				}
				
			}

		});

	});
});//FIN DOCUMENT

/*=============================================
GET EDIT NOTIFICACIÓN
=============================================*/
$(document).ready(function(){
	$("#tblnotificacion").on("click", ".btnGetEditarNotificacion", function(){
		
		$(".modal-body").hide();		
		$('#editNotificacionloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');
		$('select[name="cmbEditTipoCompra"] option:selected').removeAttr('selected');
		$('select[name="cmbEditTipoMonto"] option:selected').removeAttr('selected');

		var idnotificacion = $(this).attr("idnotificacion");
		
		var dataString	= {idnotificacion:idnotificacion};

		$.ajax({

			url: base_url + "notificacion/getnotificacion",
			method: "POST",
			data: dataString,
			dataType: "json",
			success: function(respuesta){
				$("#editNotificacionId").val(respuesta.notificacion.NOTIFICACION_ID);
				$("#editNotificacionIdEmpresa").val(respuesta.notificacion.EMPRESA_ID);
				$("#editNotificacionEmpresa").text(respuesta.notificacion.EMPRESA_NOMBRE);
				$("#editNotificacionTexto").val(respuesta.notificacion.NOTIFICACION_TEXTO);
				$("#editNotificacionEnvio").val(respuesta.notificacion.NOTIFICACION_ENVIO);
				$("#editNotificacionEnviados").val(respuesta.notificacion.NOTIFICACION_ENVIADOS);
				$("#editNotificacionAperturas").val(respuesta.notificacion.NOTIFICACION_APERTURA);
			
				var tipoCompra = respuesta.notificacion.TIPO_COMPRA_ID ? respuesta.notificacion.TIPO_COMPRA_ID : '0' ;
				$('select[name="cmbEditTipoCompra"]').find('option[value="'+tipoCompra+'"]').attr("selected",true);
				
				respuesta.notificacion.TIPO_MONTO_ID ? $("#pago-efectivo-edit").show() : $("#pago-efectivo-edit").hide() ;
				var tipoMonto = respuesta.notificacion.TIPO_MONTO_ID ? respuesta.notificacion.TIPO_MONTO_ID : '' ;
				$('select[name="cmbEditTipoMonto"]').find('option[value="'+tipoMonto+'"]').attr("selected",true);
				
				$("#editNotificacionObs").val(respuesta.notificacion.NOTIFICACION_TIPO_OBS);
				
				$("#editNotificacionImg").val(respuesta.notificacion.NOTIFICACION_IMG);
				if(respuesta.notificacion.NOTIFICACION_IMG !== null){
					$(".previsualizarEmpresa").attr("src", base_url + respuesta.notificacion.NOTIFICACION_IMG);
				}else{
					$(".previsualizarEmpresa").attr("src", base_url + "public/images/food-defecto.png");
				}
				
				if(respuesta.notificacion.EMPRESA_LOGOTIPO !== null){
					$(".previsualizarVerLogoEmpresa").attr("src", base_url + respuesta.notificacion.EMPRESA_LOGOTIPO);
				}else{
					$(".previsualizarVerLogoEmpresa").attr("src", base_url + "public/images/food-defecto.png");
				}

				$('#editNotificacionloading').html('');
				$(".modal-body").show();
			}

		});

	});
});//FIN DOCUMENT

/*=============================================
EDIT TEXTAREA/MONTO PAGO NOTIFICACIÓN
=============================================*/
$(document).ready(function(){
	$("#cmbEditTipoCompra").change(function () {
		
		var opttipopago = $(this).val();
		
		if( opttipopago === "1" ){
			$("#pago-efectivo-edit").show(500);
		}else{
			$("#pago-efectivo-edit").hide(500);
		}
		
	});
});
