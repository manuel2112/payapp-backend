/*=============================================
GUARDAR TIPO DE NEGOCIO
=============================================*/
$(function(){
	
	$("#guardarTipoNegocio").on("click",function()
	{
		var tipoNegocio = $.trim($('#nuevoTipoNegocio').val());
		var dataString	= {tipoNegocio:tipoNegocio};
		
		$.ajax({

		  url: base_url + "tiponegocio/insert",
		  method: "POST",
		  data: dataString,
		  success:function(respuesta){
			$("#respuesta").html(respuesta).show();
		  }

		});

	});

});

/*=============================================
ACTIVAR TIPO NEGOCIO
=============================================*/
$(document).ready(function(){
    $("#tiponegocio").on("click", ".btnactivartiponegocio", function(){
		var idtiponegocio 	= $(this).attr("idtiponegocio");
		var estado 			= $(this).attr("estado");
		
		var dataString	= {idtiponegocio:idtiponegocio,estado:estado};

		$.ajax({

		  url: base_url + "tiponegocio/estado",
		  method: "POST",
		  data: dataString,
		  success: function(respuesta){

					 swal({
					  title: "El Tipo de Negocio ha sido actualizado",
					  type: "success",
					  confirmButtonText: "¡Cerrar!"
					}).then(function(result) {
						if (result.value) {
							window.location = "tiponegocio";
						}
					});
			}
		});

		if( estado === "0" ){
			$(this).removeClass('btn-success');
			$(this).addClass('btn-danger');
			$(this).html('Desactivado');
			$(this).attr('estado',1);
		}else{
			$(this).removeClass('btn-danger');
			$(this).addClass('btn-success');
			$(this).html('Activado');
			$(this).attr('estado',0);
		}
    });
});

/*=============================================
GET EDITAR TIPO NEGOCIO
=============================================*/
$(document).ready(function(){
    $("#tiponegocio").on("click", ".btnGetEditarTipoNegocio", function(){
		
		$('#loading').html('<img src="' + base_url + 'public/images/loading.gif" width="30">');
		$("#editarTipoNegocio").val("");
		$("#respuestaeditar").html("").show();
		
		var idtiponegocio = $(this).attr("idtiponegocio");
		
		var dataString	= {idtiponegocio:idtiponegocio};

		$.ajax({

			url: base_url + "tiponegocio/geteditar",
			method: "POST",
			data: dataString,
			dataType: "json",
			success: function(respuesta){
				$("#editarIdTipoNegocio").val(respuesta["TIPO_NEGOCIO_ID"]);
				$("#editarTipoNegocio").val(respuesta["TIPO_NEGOCIO_NOMBRE"]);
				$('#loading').html('');
			}
		});		
    });	
});

/*=============================================
EDITAR TIPO NEGOCIO
=============================================*/
$(function(){
	
	$("#btnEditarTipoNegocio").on("click",function()
	{		
		var idtiponegocio 	= $.trim($('#editarIdTipoNegocio').val());
		var txtTipoNegocio 	= $.trim($('#editarTipoNegocio').val());
		
		var dataString	= {idtiponegocio:idtiponegocio,txtTipoNegocio:txtTipoNegocio};

		$.ajax({

			url: base_url + "tiponegocio/editar",
			method: "POST",
			data: dataString,
			success: function(respuesta){
				$("#respuestaeditar").html(respuesta).show();
			}
		});		
    });	
});
