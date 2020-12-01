/*=============================================
TIPO DE NEGOCIO
=============================================*/
$(document).ready(function() {

    //ENVIAR PUSH TEST
    $("#tipo-negocio").on("click", ".btn-delivery, .btn-restaurante, .btn-retiro", function() {

        var idTipo = $(this).val();
        var descripcion = '';

        if (idTipo == 1) {
            descripcion = $('#txt-delivery').val();
        } else if (idTipo == 2) {
            descripcion = $('#txt-restaurante').val();
        } else if (idTipo == 3) {
            descripcion = $('#txt-retiro').val();
        } else {}

        var dataString = { idTipo: idTipo, descripcion: descripcion };

        $.ajax({

            url: base_url + "tiponegocio/insert",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                if (res.ok === '1') {
                    swal({
                            title: 'TIPO DE NEGOCIO',
                            text: res.msn,
                            type: "success"
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                } else {
                    swal({
                        title: 'TIPO DE NEGOCIO',
                        text: 'SE HA PRODUCIDO UN ERROR, VOLVER A INTENTARLO',
                        type: "error"
                    });
                }
            }

        });

    });

}); //FIN DOCUMENT