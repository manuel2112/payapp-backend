/*=============================================
LOGIN
=============================================*/
$(document).ready(function(){
	$("#form-signin").on("click", ".btnlogin", function(){
		
		$( "#loadinglogin" ).addClass( "fa-spin" );
		var usuario = $("#txtUsuario").val();
		var pass	= $("#txtPass").val();
		
		var dataString	= {usuario:usuario,pass:pass};

		$.ajax({

			url: base_url + "login/login",
			method: "POST",
			data: dataString,
			success: function(respuesta){
				if( respuesta === "1" ){
					window.location.href = base_url;
				}else{
					$( "#loadinglogin" ).removeClass( "fa-spin" );
					swal({
						title: "Error!",
						text: respuesta,
						type: "error"
					});
				}
			}

		});
		return false; 
	});
});//FIN DOCUMENT

/*=============================================
CONTACTO LOGIN
=============================================*/
$(document).ready(function(){
	$("#mdlContacto").on("click", "#sendContactoLogin", function(){
		
		$( "#loadingLoginContacto" ).addClass( "fa-spin" );
		var txtLoginAsuntoContacto	= "Formulario - Problemas Ingreso";
		var txtLoginNombreContacto	= $("#txtLoginNombreContacto").val();
		var txtLoginEmailContacto	= $("#txtLoginEmailContacto").val();
		var txtLoginMensajeContacto	= $("#txtLoginMensajeContacto").val();
		
		var dataString	= {asunto:txtLoginAsuntoContacto, nombre:txtLoginNombreContacto, email:txtLoginEmailContacto, mensaje:txtLoginMensajeContacto};

		$.ajax({

			url: base_url + "contacto",
			method: "POST",
			data: dataString,
			success: function(respuesta){
				if( respuesta === "" ){
					$( "#loadingLoginContacto" ).removeClass( "fa-spin" );
					swal({
						title: "Mensaje Enviado!",
						text: "Pronto nos contactaremos contigo",
						type: "success"
					});
					$('#mdlContacto').modal('hide');
				}else{
					$( "#loadingLoginContacto" ).removeClass( "fa-spin" );
					swal({
						title: "Error!",
						text: respuesta,
						type: "error"
					});
				}
			}

		});
		return false; 
	});
});//FIN DOCUMENT

/*=============================================
NUEVO PASSWORD
=============================================*/
$(document).ready(function(){
	$("#mdlPassForget").on("click", "#sendPassLogin", function(){
		
		$( "#loadingLoginPass" ).addClass( "fa-spin" );
		var txtLoginAsuntoContacto	= "Formulario - Problemas Ingreso";
		var txtLoginEmailPassContacto	= $("#txtLoginEmailPassContacto").val();
		
		var dataString	= {asunto:txtLoginAsuntoContacto, email:txtLoginEmailPassContacto};

		$.ajax({

			url: base_url + "contacto/recuperarpass",
			method: "POST",
			data: dataString,
			success: function(respuesta){
				if( respuesta === "" ){
					$( "#loadingLoginPass" ).removeClass( "fa-spin" );
					swal({
						title: "Mensaje Enviado!",
						text: "Hemos enviado tu nueva contraseña a tu email. Gracias!!!",
						type: "success"
					});
					$('#mdlPassForget').modal('hide');
				}else{
					$( "#loadingLoginPass" ).removeClass( "fa-spin" );
					swal({
						title: "Error!",
						text: respuesta,
						type: "error"
					});
				}
			}

		});
		return false; 
	});
});//FIN DOCUMENT
	
