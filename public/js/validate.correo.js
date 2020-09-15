/*=============================================
ACTIVAR NOTIFICACIÓN
=============================================*/
$(document).ready(function(){
    $("#tblemailciudades").on("click", ".btnestadocorreo", function(){
		var idcorreo 	= $(this).attr("idcorreo");
		var estado		= $(this).attr("estado");
		
		var dataString	= {idcorreo:idcorreo,estado:estado};

		$.ajax({

		  url: base_url + "correo/estadocorreo",
		  method: "POST",
		  data: dataString,
		  success: function(respuesta){

					 swal({
					  title: "El email ha sido actualizado",
					  type: "success",
					  confirmButtonText: "¡Cerrar!"
					}).then(function(result) {
						if (result.value) {
							window.location = "correo";
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
