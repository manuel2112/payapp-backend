/*=============================================
VALIDAR IMAGEN COMIDA
=============================================*/	
$(document).ready(function(){

	$(".nuevaFotoComida").change(function(){

		var imagen = this.files[0];

		/*=============================================
		VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
		=============================================*/

		if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

			$(".nuevaFotoComida").val("");

			 swal({
				  title: "Error al subir la imagen",
				  text: "¡La imagen debe estar en formato JPG o PNG!",
				  type: "error",
				  confirmButtonText: "¡Cerrar!"
				});

		}else if( imagen["size"] > 512000 ){

			$(".nuevaFotoComida").val("");

			 swal({
				  title: "Error al subir la imagen",
				  text: "¡La imagen no debe pesar más de 512KB!",
				  type: "error",
				  confirmButtonText: "¡Cerrar!"
				});

		}else{

			var datosImagen = new FileReader();
			datosImagen.readAsDataURL(imagen);

			$(datosImagen).on("load", function(event){

				var rutaImagen = event.target.result;

				$(".previsualizarComida").attr("src", rutaImagen);

			});

		}
	});

});//FIN DOCUMENT

/*=============================================
COMPROBAR TIPO COMIDA EXISTE
=============================================*/	
$(document).ready(function(){

	$("#nuevoTipoComida").keyup(function(){
		
		$(".alert").remove();

		var tipoComida = $(this).val();
		var dataString	= {tipoComida:tipoComida};
		
		 $.ajax({
			url: base_url + "tipocomida/existetipocomida",
			method:"POST",
			data: dataString,
			success:function(respuesta){
				
				$(".alert").remove();
				
				if(respuesta){

					$("#nuevoTipoComida").parent().after('<div class="alert alert-warning"><strong>Tipo de Comida</strong> ya existe en la base de datos</div>');
					
					$( "#guardarTipoComida" ).attr("disabled", true);

				}else{
					$( "#guardarTipoComida" ).attr("disabled", false);
				}

			}

		});
	});

});//FIN DOCUMENT

/*=============================================
COMPROBAR TIPO COMIDA EXISTE EDITAR
=============================================*/	
$(document).ready(function(){

	$("#editarTipoComida").keyup(function(){
		
		$(".alert").remove();

		var idTipoComida 	= $("#editarIdTipoComida").val();
		var tipoComida 		= $(this).val();
		var dataString		= {idTipoComida:idTipoComida,tipoComida:tipoComida};
		
		 $.ajax({
			url: base_url + "tipocomida/existetipocomidaedit",
			method:"POST",
			data: dataString,
			success:function(respuesta){
				
				if(respuesta){
					$(".alert").remove();
					$("#editarTipoComida").parent().after('<div class="alert alert-warning"><strong>Tipo de Comida</strong> ya existe en la base de datos</div>');
					$( "#btnEditarTipoComida" ).attr("disabled", true);
				}else{
					$( "#btnEditarTipoComida" ).attr("disabled", false);
				}
				
			}

		});
	});

});//FIN DOCUMENT

/*=============================================
ACTIVAR TIPO COMIDA
=============================================*/
$(document).ready(function(){
    $("#tipocomida").on("click", ".btnactivartipocomida", function(){
		var idtipocomida 	= $(this).attr("idtipocomida");
		var estado 			= $(this).attr("estadotipocomida");
		
		var dataString	= {idtipocomida:idtipocomida,estado:estado};

		$.ajax({

		  url: base_url + "tipocomida/estado",
		  method: "POST",
		  data: dataString,
		  success: function(respuesta){

					 swal({
					  title: "El Tipo de Comida ha sido actualizado",
					  type: "success",
					  confirmButtonText: "¡Cerrar!"
					}).then(function(result) {
						if (result.value) {
							window.location = "tipocomida";
						}
					});
			}
		});

		if( estado === "0" ){
			$(this).removeClass('btn-success');
			$(this).addClass('btn-danger');
			$(this).html('Desactivado');
			$(this).attr('estadotipocomida',1);
		}else{
			$(this).removeClass('btn-danger');
			$(this).addClass('btn-success');
			$(this).html('Activado');
			$(this).attr('estadotipocomida',0);
		}
    });
});//FIN DOCUMENT

/*=============================================
GET EDITAR TIPO COMIDA
=============================================*/
$(document).ready(function(){
	$("#tipocomida").on("click", ".btnGetEditarTipoComida", function(){
		
		$('#loading').html('<img src="' + base_url + 'public/images/loading.gif" width="30">');
		$("#editarTipoComida").val("");
		$("#respuestaeditar").html("").show();

		var idTipoComida = $(this).attr("idtipocomida");
		
		var dataString	= {idTipoComida:idTipoComida};

		$.ajax({

			url: base_url + "tipocomida/geteditar",
			method: "POST",
			data: dataString,
			dataType: "json",
			success: function(respuesta){
				$("#editarIdTipoComida").val(respuesta["TIPO_COMIDA_ID"]);
				$("#editarTipoComida").val(respuesta["TIPO_COMIDA_NOMBRE"]);
				$("#fotoActual").val(respuesta["foto"]);
				if(respuesta["TIPO_COMIDA_IMAGEN"] != ""){
					$(".previsualizarComida").attr("src", base_url + respuesta["TIPO_COMIDA_IMAGEN"]);
				}
				$('#loading').html('');
			}

		});

	});
});//FIN DOCUMENT
	
