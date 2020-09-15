/*=============================================
VALIDAR IMAGEN CIUDAD
=============================================*/	
$(document).ready(function(){

	$(".nuevaFotoCiudad").change(function(){

		var imagen = this.files[0];

		/*=============================================
		VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
		=============================================*/

		if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

			$(".nuevaFotoCiudad").val("");

			 swal({
				  title: "Error al subir la imagen",
				  text: "¡La imagen debe estar en formato JPG o PNG!",
				  type: "error",
				  confirmButtonText: "¡Cerrar!"
				});

		}else if( imagen["size"] > 512000 ){

			$(".nuevaFotoCiudad").val("");

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

				$(".previsualizarCiudad").attr("src", rutaImagen);

			});

		}
	});

});//FIN DOCUMENT

/*=============================================
COMPROBAR CIUDAD EXISTE
=============================================*/	
$(document).ready(function(){

	$("#nuevaCiudad").keyup(function(){
		
		$(".alert").remove();
		$( "#guardarCiudad" ).attr("disabled", true);

		var txtCiudad = $(this).val();
		var dataString	= {txtCiudad:txtCiudad};
		
		 $.ajax({
			url: base_url + "ciudad/existeciudad",
			method:"POST",
			data: dataString,
			success:function(respuesta){
				
				$(".alert").remove();
				
				if(respuesta){

					$("#nuevaCiudad").parent().after('<div class="alert alert-warning"><strong>Ciudad</strong> ya existe en la base de datos</div>');
					
					$( "#guardarCiudad" ).attr("disabled", true);

				}else{
					$( "#guardarCiudad" ).attr("disabled", false);
				}

			}

		});
	});

});//FIN DOCUMENT

/*=============================================
ACTIVAR TIPO COMIDA
=============================================*/
$(document).ready(function(){
    $("#ciudad").on("click", ".btnactivarciudad", function(){
		var idciudad	= $(this).attr("idciudad");
		var estado		= $(this).attr("estadociudad");
		
		var dataString	= {idciudad:idciudad,estado:estado};

		$.ajax({

		  url: base_url + "ciudad/estado",
		  method: "POST",
		  data: dataString,
		  success: function(respuesta){

					 swal({
					  title: "El estado de la ciudad ha sido actualizado",
					  type: "success",
					  confirmButtonText: "¡Cerrar!"
					}).then(function(result) {
						if (result.value) {
							window.location = "ciudad";
						}
					});
			}
		});

		if( estado === "0" ){
			$(this).removeClass('btn-success');
			$(this).addClass('btn-danger');
			$(this).html('Desactivado');
			$(this).attr('estadociudad',1);
		}else{
			$(this).removeClass('btn-danger');
			$(this).addClass('btn-success');
			$(this).html('Activado');
			$(this).attr('estadociudad',0);
		}
    });
});//FIN DOCUMENT

/*=============================================
COMPROBAR TIPO COMIDA EXISTE EDITAR
=============================================*/	
$(document).ready(function(){

	$("#editarCiudad").keyup(function(){
		
		$(".alert").remove();

		var idCiudad 	= $("#editarIdCiudad").val();
		var ciudad		= $(this).val();
		
		var dataString	= {idCiudad:idCiudad,ciudad:ciudad};
		
		 $.ajax({
			url: base_url + "ciudad/existeciudadedit",
			method:"POST",
			data: dataString,
			success:function(respuesta){
				
				if(respuesta){
					$(".alert").remove();
					$("#editarCiudad").parent().after('<div class="alert alert-warning"><strong>Ciudad</strong> ya existe en la base de datos</div>');
					$( "#btnEditarCiudad" ).attr("disabled", true);
				}else{
					$( "#btnEditarCiudad" ).attr("disabled", false);
				}
				
			}

		});
	});

});//FIN DOCUMENT

/*=============================================
GET EDITAR TIPO COMIDA
=============================================*/
$(document).ready(function(){
	$("#ciudad").on("click", ".btnGetEditarCiudad", function(){
		
		$(".modal-body").hide();		
		$('#verloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');
		$("#editarTipoComida").val("");
		$("#editarCiudad").html("").show();

		var idCiudad = $(this).attr("idciudad");
		
		var dataString	= {idCiudad:idCiudad};

		$.ajax({

			url: base_url + "ciudad/geteditar",
			method: "POST",
			data: dataString,
			dataType: "json",
			success: function(respuesta){
				$("#editarIdCiudad").val(respuesta.CIUDAD_ID);
				$("#editarCiudad").val(respuesta.CIUDAD_NOMBRE);
				
				if(respuesta.CIUDAD_IMAGEN !== null){
					$(".previsualizarCiudad").attr("src", base_url + respuesta.CIUDAD_IMAGEN);
				}else{
					$(".previsualizarCiudad").attr("src", base_url + "public/images/food-defecto.png");
				}
				
				$('#verloading').html('');
				$(".modal-body").show();
			}

		});

	});
});//FIN DOCUMENT	
