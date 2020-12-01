/*=============================================
TEST PUSH
=============================================*/
$(document).ready(function() {
	
	//ENVIAR PUSH TEST
    $("#empresa").on("click", ".btnPushTest", function() {

        var idEmpresa = $(this).attr("idempresa");

        var dataString = { idEmpresa: idEmpresa };

        $.ajax({

            url: base_url + "push/test",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                if (res.ok === '1') {
                    swal({
                        title: 'PUSH TEST',
                        text: res.msn,
                        type: "success"
                    });
                } else {
                    swal({
                        title: 'PUSH TEST',
                        text: 'SE HA PRODUCIDO UN ERROR, VOLVER A INTENTARLO',
                        type: "error"
                    });
                }
            }

        });

    });
	
	//INGRESAR PUSH
    $("#mdlPush").on("click", "#btnGuardarPush", function() {
		
		//alert('hola');
		var txtPushTitle = $("#txtPushTitle").val();
		var txtPushTexto = $("#txtPushTexto").val();
		var idProducto	 = $("#idProductoPush").val();

        var dataString = { txtPushTitle: txtPushTitle,txtPushTexto: txtPushTexto, idProducto: idProducto };

        $.ajax({

            url: base_url + "push/insertpush",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                if (res.ok === '1') {
					
					swal({
					  title: "ENVÍO DE NOTIFICACIÓN",
					  text: res.msn,
					  type: "success",
					  showCancelButton: false,
					  confirmButtonText: "CERRAR",
					  closeOnConfirm: false
					},
					function(isConfirm){
					  if (isConfirm) {
						location.reload();
					  }
					});
					
                } else {
                    swal({
                        title: 'ENVÍO DE NOTIFICACIÓN',
                        text: res.msn,
                        type: "error"
                    });
                }
            }

        });

    });
}); //FIN DOCUMENT