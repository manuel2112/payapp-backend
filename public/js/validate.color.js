/*=============================================
COLOR
=============================================*/
$(document).ready(function() {

    //INSERT COLOR
    $("#modalAgregarColor").on("click", "#btnGuardarColor", function() {

        var txtColorNombre = $("#txtColorNombre").val();
        var txtColorHexa = $("#txtColorHexa").val();

        var dataString = { txtColorNombre: txtColorNombre, txtColorHexa: txtColorHexa };

        $.ajax({

            url: base_url + "color/insert",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                if (res.ok === '1') {

                    swal({
                            title: "COLOR",
                            text: res.msn,
                            type: "success",
                            showCancelButton: false,
                            confirmButtonText: "CERRAR",
                            closeOnConfirm: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });

                } else {
                    swal({
                        title: 'COLOR',
                        text: res.msn,
                        type: "error"
                    });
                }
            }

        });

    });

    //GET COLOR
    $("#color").on("click", ".btnGetEditarColor", function() {

        $(".modal-body").hide();
        $('#editarloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');

        var idColor = $(this).attr("idcolor");
        var dataString = { idColor: idColor };

        $.ajax({

            url: base_url + "color/geteditar",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(respuesta) {
                // alert(respuesta.tipoNegocio);
                $("#idEditColor").val(respuesta.color.COLOR_ID);
                $("#nmbEditColor").val(respuesta.color.COLOR_NOMBRE);
                $("#hexaEditColor").val(respuesta.color.COLOR_HEX.substring(1));

                $('#editarloading').html('');
                $(".modal-body").show();
            }

        });

    });

    //UPDATE COLOR
    $("#modalEditarColor").on("click", "#btnEditarColor", function() {

        var idEditColor = $("#idEditColor").val();
        var nmbEditColor = $("#nmbEditColor").val();
        var hexaEditColor = $("#hexaEditColor").val();

        var dataString = { idEditColor: idEditColor, nmbEditColor: nmbEditColor, hexaEditColor: hexaEditColor };

        $.ajax({

            url: base_url + "color/editar",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                if (res.ok === '1') {

                    swal({
                            title: "COLOR",
                            text: res.msn,
                            type: "success",
                            showCancelButton: false,
                            confirmButtonText: "CERRAR",
                            closeOnConfirm: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });

                } else {
                    swal({
                        title: 'COLOR',
                        text: res.msn,
                        type: "error"
                    });
                }
            }

        });

    });

    //DELETE COLOR
    $("#color").on("click", ".btnDeleteColor", function() {

        var idColor = $(this).attr("idcolor");

        swal({
                title: "Estás seguro?",
                text: "Esta acción eliminará el color seleccionado!!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Si, Eliminar!",
                closeOnConfirm: false
            },
            function() {
                var dataString = { idColor: idColor };
                $.ajax({
                    url: base_url + "color/delete",
                    method: "POST",
                    data: dataString,
                    success: function(respuesta) {
                        swal({
                            title: "Eliminado!",
                            text: "El color seleccionado ha sido eliminado!!!",
                            type: "success"
                        }, function() {
                            window.location = base_url + "color";
                        });
                    }
                });
            });

    });
}); //FIN DOCUMENT