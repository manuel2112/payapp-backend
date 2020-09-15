/*=============================================
ACTIVAR NOTIFICACIÓN
=============================================*/
$(document).ready(function(){
    $("#collapse4").on("click", "#btnUpdateDescargas", function(){
		var newvalor 	= $("#updateDescargas").val();
		
		var dataString	= {newvalor:newvalor};

		$.ajax({

		  url: base_url + "base/updatedescarga",
		  method: "POST",
		  data: dataString,
		  success: function(respuesta){
			  
			  $("#ok-descarga").html('<div class="alert alert-success">DESCARGA ACTUALIZADA<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>').show();
			  
		  	}
		});
    });
});//FIN DOCUMENT
