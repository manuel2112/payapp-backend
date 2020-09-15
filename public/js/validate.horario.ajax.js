/*=============================================
VALIDATE HORARIO AJAX
=============================================*/
$(document).ready(function() {

    /*=============================================
    DELETE HORARIO/EMPRESA
    =============================================*/
    $(".deleteHorario").on("click", function() {
        var idHorario = $(this).attr("idhorario");

        swal({
                title: "ESTÁS SEGURO?",
                text: 'ESTA ACCIÓN ELIMINARÁ ESTE HORARIO',
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-warning',
                confirmButtonText: 'SI, ELIMINAR HORARIO',
                closeOnConfirm: false
            },
            function() {
                var dataString = { idHorario: idHorario };
                $.ajax({
                    url: base_url + "horario/horariodelete",
                    method: "POST",
                    data: dataString,
                    dataType: "json",
                    success: function(res) {
                        swal({
                            title: res.title,
                            text: res.text,
                            type: "success"
                        }, function() {
                            window.location = base_url + res.url;
                        });
                    }
                });
            });
    });

}); //FIN DOCUMENT