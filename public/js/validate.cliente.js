/*=============================================
UPDATE PASSWORD
=============================================*/
$(document).ready(function() {
    $("#formpassword").on("click", ".btnEditarPw", function() {

        $('#loadingpw').html('<img src="' + base_url + 'public/images/loading.gif" width="30">');
        var idCliente = $("#idCliente").val();
        var actualPw = $("#actualPw").val();
        var nuevoPw = $("#nuevoPw").val();
        var repitePw = $("#repitePw").val();

        var dataString = { idCliente: idCliente, actualPw: actualPw, nuevoPw: nuevoPw, repitePw: repitePw };

        $.ajax({

            url: base_url + "cliente/passwordeditajax",
            method: "POST",
            data: dataString,
            success: function(respuesta) {

                if (respuesta === "1") {
                    $('#loadingpw').html('');
                    $("#actualPw").val('');
                    $("#nuevoPw").val('');
                    $("#repitePw").val('');
                    swal({
                        title: "Éxito!",
                        text: 'Contraseña editada con éxito',
                        type: "success"
                    });
                } else {
                    $('#loadingpw').html('');
                    swal({
                        title: "Error!",
                        text: respuesta,
                        type: "error"
                    });
                }
            }

        });

    });
}); //FIN DOCUMENT

/*=============================================
VALIDAR IMAGEN LOGOTIPO
=============================================*/
$(document).ready(function() {

    $(".EditFotoLogoCliente").change(function() {

        var imagen = this.files[0];

        /*=============================================
        VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
        =============================================*/

        if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

            $(".EditFotoLogoCliente").val("");

            swal({
                title: "Error al subir la imagen",
                text: "¡La imagen debe estar en formato JPG o PNG!",
                type: "error",
                confirmButtonText: "¡Cerrar!"
            });

        } else if (imagen["size"] > 512000) {

            $(".EditFotoLogoCliente").val("");

            swal({
                title: "Error al subir la imagen",
                text: "¡La imagen no debe pesar más de 512KB!",
                type: "error",
                confirmButtonText: "¡Cerrar!"
            });

        } else {

            var datosImagen = new FileReader();
            datosImagen.readAsDataURL(imagen);

            $(datosImagen).on("load", function(event) {

                var rutaImagen = event.target.result;

                $(".previsualizarLogoCliente").attr("src", rutaImagen);

            });

        }
    });

}); //FIN DOCUMENT

/*=============================================
GET MODAL CONTACTO
=============================================*/
$(document).ready(function() {
    $(".btnContacto").on("click", function() {

        $(".modal-body").hide();
        $('#contactoloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');

        var asunto = $(this).attr("asunto");
        $("#verAsuntoContacto").text(asunto);
        $("#txtAsuntoContacto").val(asunto);
        $("#txtMensajeContacto").val("");

        $('#contactoloading').html('');
        $(".modal-body").show();

    });
}); //FIN DOCUMENT

/*=============================================
CONTACTO LOGIN
=============================================*/
$(document).ready(function() {
    $("#mdlContacto").on("click", "#sendContacto", function() {

        $("#loadingContacto").addClass("fa-spin");
        var txtAsuntoContacto = $("#txtAsuntoContacto").val();
        var txtNombreContacto = $("#txtNombreContacto").val();
        var txtEmailContacto = $("#txtEmailContacto").val();
        var txtMensajeContacto = $("#txtMensajeContacto").val();

        var dataString = { asunto: txtAsuntoContacto, nombre: txtNombreContacto, email: txtEmailContacto, mensaje: txtMensajeContacto };

        $.ajax({

            url: base_url + "contacto/formcliente",
            method: "POST",
            data: dataString,
            success: function(respuesta) {
                if (respuesta === "") {
                    $("#loadingContacto").removeClass("fa-spin");
                    swal({
                        title: "Mensaje Enviado!",
                        text: "Pronto nos contactaremos contigo",
                        type: "success"
                    });
                    $('#mdlContacto').modal('hide');
                } else {
                    $("#loadingContacto").removeClass("fa-spin");
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
}); //FIN DOCUMENT

/*=============================================
EDITAR CLIENTE
=============================================*/
$(document).ready(function() {
    $("#btnEditarEmpresa").on("click", function() {

        var idCliente = $("#idEditCliente").val();
        var txtEditDireccion = $("#txtEditDireccion").val();
        var txtEditFono = $("#txtEditFono").val();
        var txtEditUrl = $("#txtEditUrl").val();
        var txtEditFacebook = $("#txtEditFacebook").val();
        var txtEditInstagram = $("#txtEditInstagram").val();
        var txtEditDescripcion = $("#txtEditDescripcion").val();

        var formData = new FormData();
        var files = $('#EditFotoLogoCliente')[0].files[0];
        if (files !== undefined) {
            formData.append('imagen', files);
        } else {
            formData.append('imagen', '');
        }

        formData.append('idCliente', idCliente);
        formData.append('txtEditDireccion', txtEditDireccion);
        formData.append('txtEditFono', txtEditFono);
        formData.append('txtEditUrl', txtEditUrl);
        formData.append('txtEditFacebook', txtEditFacebook);
        formData.append('txtEditInstagram', txtEditInstagram);
        formData.append('txtEditDescripcion', txtEditDescripcion);

        $.ajax({
            url: base_url + "cliente/updatecliente",
            method: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(res) {

                if (res.ok === '1') {
                    swal({
                        title: 'CLIENTE',
                        text: 'DATOS ACTUALIZADOS EXITOSAMENTE',
                        type: "success"
                    }, function() {
                        window.location = base_url + "cliente";
                    });
                } else if (res.ok === '2') {
                    swal("CLIENTE", "UN ERROR INESPERADO SE HA PRODUCIDO, FAVOR VOLVER A INTENTARLO.", "error");
                } else {
                    alert(res.ok);
                    swal("CLIENTE", "UN ERROR INESPERADO SE HA PRODUCIDO, FAVOR VOLVER A INTENTARLO.", "error");
                }
            }
        });
    });
}); //FIN DOCUMENT

/*=============================================
EDITAR TIEMPOO ENTREGA
=============================================*/
$(document).ready(function() {
    $("#btnTiempoEntrega").on("click", function() {

        var idCliente = $("#tiempoIdEmpresa").val();
        var txtTiempoEntrega = $("#txtTiempoEntrega").val();

        var formData = new FormData();
        formData.append('idCliente', idCliente);
        formData.append('txtTiempoEntrega', txtTiempoEntrega);

        $.ajax({
            url: base_url + "cliente/updatetiempoentrega",
            method: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(res) {

                if (res.ok === '1') {
                    swal({
                        title: 'TIEMPO DE ENTREGA',
                        text: 'DATOS ACTUALIZADOS EXITOSAMENTE',
                        type: "success"
                    }, function() {
                        window.location = base_url + "cliente";
                    });
                } else if (res.ok === '2') {
                    swal("CLIENTE", "UN ERROR INESPERADO SE HA PRODUCIDO, FAVOR VOLVER A INTENTARLO.", "error");
                } else {
                    alert(res.ok);
                    swal("CLIENTE", "UN ERROR INESPERADO SE HA PRODUCIDO, FAVOR VOLVER A INTENTARLO.", "error");
                }
            }
        });
    });
}); //FIN DOCUMENT