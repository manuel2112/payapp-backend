/*=============================================
DELETE DESTACADO
=============================================*/
$(document).on('click', '.btndeletedestacado', function() {
	
	var idDestacado = $(this).attr("iddestacado");
	
	swal({
		title: "Estás seguro?",
		text: "Esta acción eliminará el destacado seleccionado!!!",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Si, Eliminar!",
		closeOnConfirm: false
	},
	function(){
		var dataString	= {idDestacado:idDestacado};
		$.ajax({
			url: base_url + "destacados/deletedestacado",
			method: "POST",
			data: dataString,
			success: function(respuesta){
				swal({
					title: "Eliminado!",
					text: "El destacado seleccionado ha sido eliminado!!!",
					type: "success"
				}, function() {
					window.location = base_url + "destacados";
				});				
			}
		});
	});

});

/*=============================================
GET VER EMPRESA
=============================================*/
$(document).on('click', '.btngetverdestacado', function() {

		$(".modal-body").hide();
		$('#verloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');

		var idDestacado 	= $(this).attr("iddestacado");
		var txtVerDestFotos = "";
		var dataString		= {idDestacado:idDestacado};

		$.ajax({

			url: base_url + "destacados/getdestacado",
			method: "POST",
			data: dataString,
			dataType: "json",
			success: function(respuesta){
				$("#verNmbEmpresaDest").text(respuesta.destacado.EMPRESA_NOMBRE);
				$("#verDescEmpresaDest").text(respuesta.destacado.DESTACADO_DESCRIPCION);
				$("#verDateEmpresaDest").text(respuesta.destacado.DESTACADO_INGRESO);
				
				txtVerDestFotos += '<div class="show-images" style="width:100%">';
				$.each(respuesta.fotos , function( index, value ) {
					txtVerDestFotos += "<a href='" + base_url + value.EMP_DES_IMG + "' target='_blank'><img src='" + base_url + value.EMP_DES_IMG + "' class='img-thumbnail' ></a>";
				});
				txtVerDestFotos += '</div>';
				$("#txtVerDestFotos").html(txtVerDestFotos);
				
				if(respuesta.destacado.EMPRESA_LOGOTIPO !== null){
					$(".previsualizarVerLogoEmpresa").attr("src", base_url + respuesta.destacado.EMPRESA_LOGOTIPO);
				}else{
					$(".previsualizarVerLogoEmpresa").attr("src", base_url + "public/images/food-defecto.png");
				}
				
				$('#verloading').html('');
				$(".modal-body").show();
			}

		});
});//FIN DOCUMENT
