/*=============================================
VALIDAR IMAGEN EMPRESA
=============================================*/
$(document).ready(function() {

    $(".nuevaFotoEmpresa,.EditFotoEmpresa,.nuevaFotoPromo,.EditImgProducto").change(function() {

        var imagen = this.files[0];

        /*=============================================
        VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
        =============================================*/

        if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

            $(".nuevaFotoEmpresa").val("");

            swal({
                title: "Error al subir la imagen",
                text: "¡La imagen debe estar en formato JPG o PNG!",
                type: "error",
                confirmButtonText: "¡Cerrar!"
            });

        } else if (imagen["size"] > 512000) {

            $(".nuevaFotoEmpresa").val("");

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

                $(".previsualizarEmpresa").attr("src", rutaImagen);
                $("#guardarFoto").attr("disabled", false);

            });

        }
    });

}); //FIN DOCUMENT

/*=============================================
VALIDAR DATOS ENTRADA EMPRESA
=============================================*/
$(document).ready(function() {

    $("#btnGuardarEmpresa").attr("disabled", true);
    $("#cmbCiudad, #txtEmpresaNombre, #txtEmpresaFono, #txtEmpresaDescripcion ").change(function() {

        var cmbCiudad = $("#cmbCiudad").val();
        var txtEmpresa = $("#txtEmpresaNombre").val();
        var txtFono = $("#txtEmpresaFono").val();
        var txtDescripcion = $("#txtEmpresaDescripcion").val();

        //VALIDAR CIUDAD		
        var boolCiudad = false;
        if (cmbCiudad !== "") { boolCiudad = true; }
        //VALIDAR EMPRESA		
        var boolEmpresa = false;
        if (txtEmpresa !== "") { boolEmpresa = true; }
        //VALIDAR EMPRESA		
        var boolFono = false;
        if (txtFono !== "") { boolFono = true; }
        //VALIDAR EMPRESA		
        var boolDescripcion = false;
        if (txtDescripcion !== "") { boolDescripcion = true; }

        //COMPROBAR TODOS LOS CAMPOS
        if (boolCiudad && boolEmpresa && boolFono && boolDescripcion) {
            $("#btnGuardarEmpresa").attr("disabled", false);
        } else {
            $("#btnGuardarEmpresa").attr("disabled", true);
        }

    });

}); //FIN DOCUMENT

/*=============================================
ACTIVAR EMPRESA
=============================================*/
$(document).ready(function() {
    $("#empresa").on("click", ".btnActivarEmpresa", function() {
        var idempresa = $(this).attr("idempresa");
        var estado = $(this).attr("estadoempresa");

        var txtText = estado === "0" ? "Esta acción dará de baja a la empresa." : "Esta acción dará de alta a la empresa.";
        var buttonClass = estado === "0" ? "btn-danger" : "btn-success";
        var buttonText = estado === "0" ? "Si, eliminar empresa!" : "Si, activar empresa!";

        swal({
                title: "Estás seguro?",
                text: txtText,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: buttonClass,
                confirmButtonText: buttonText,
                closeOnConfirm: false
            },
            function() {
                var dataString = { idempresa: idempresa, estado: estado };
                $.ajax({
                    url: base_url + "empresa/estado",
                    method: "POST",
                    data: dataString,
                    dataType: "json",
                    success: function(respuesta) {
                        swal({
                            title: respuesta.title,
                            text: respuesta.text,
                            type: "success"
                        }, function() {
                            window.location = base_url + "empresa";
                        });
                    }
                });
            });

    });
}); //FIN DOCUMENT

/*=============================================
GET VER EMPRESA
=============================================*/
$(document).ready(function() {
    $("#empresa").on("click", ".btnGetVerEmpresa", function() {

        $(".modal-body").hide();
        $('#verloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');
        $("#verUbicacionEmpresa").html("");
        $("#verWebUrlEmpresa").html("");

        var idEmpresa = $(this).attr("idempresa");

        var dataString = { idEmpresa: idEmpresa };

        $.ajax({

            url: base_url + "empresa/geteditar",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(respuesta) {
                $("#verIdEmpresa").text(respuesta.empresa.EMPRESA_ID);
                $("#verCiudadEmpresa").text(respuesta.empresa.CIUDAD_NOMBRE);
                $("#verNmbEmpresa").text(respuesta.empresa.EMPRESA_NOMBRE);
                $("#verNmbEmpresa2").text(respuesta.empresa.EMPRESA_NOMBRE);
                $("#verRazonSocial").text(respuesta.empresa.EMPRESA_RAZON);
                $("#verRutEmpresa").text(respuesta.empresa.EMPRESA_RUT);
                $("#verDireccionEmpresa").text(respuesta.empresa.EMPRESA_DIRECCION);
                $("#verLatEmpresa").text(respuesta.empresa.EMPRESA_LAT);
                $("#verLongEmpresa").text(respuesta.empresa.EMPRESA_LONG);
                $("#verWebEmpresa").text(respuesta.empresa.EMPRESA_WEB);
                $("#verFacebookEmpresa").text(respuesta.empresa.EMPRESA_FACEBOOK);
                $("#verInstagramEmpresa").text(respuesta.empresa.EMPRESA_INSTAGRAM);
                $("#verFonoEmpresa").text(respuesta.empresa.EMPRESA_FONO);
                $("#verEmailEmpresa").text(respuesta.empresa.EMPRESA_EMAIL);
                $("#verDescEmpresa").text(respuesta.empresa.EMPRESA_DESCRIPCION);
                $("#verComercioEmpresa").text(respuesta.empresa.EMPRESA_COD_COMERCIO);
                $("#verIngresoEmpresa").text(respuesta.empresa.EMPRESA_INGRESO);

                if (respuesta.empresa.EMPRESA_LAT !== null && respuesta.empresa.EMPRESA_LONG !== null) {
                    $("#verUbicacionEmpresa").html('<a href="' + base_url + 'map/index/' + respuesta.empresa.EMPRESA_ID + '" class="btn btn-warning" target="_blank"><i class="fa fa-map-pin"></i></a>');
                }

                if (respuesta.empresa.EMPRESA_WEB !== null) {
                    $("#verWebUrlEmpresa").html('<a href="' + respuesta.empresa.EMPRESA_WEB + '" class="btn btn-warning" target="_blank"><i class="fa fa-link"></i></a>');
                }

                if (respuesta.empresa.EMPRESA_LOGOTIPO !== null) {
                    $(".previsualizarVerLogoEmpresa").attr("src", base_url + respuesta.empresa.EMPRESA_LOGOTIPO);
                } else {
                    $(".previsualizarVerLogoEmpresa").attr("src", base_url + "public/images/food-defecto.png");
                }

                $('#verloading').html('');
                $(".modal-body").show();
            }

        });

    });
}); //FIN DOCUMENT

/*=============================================
GET VER EDITAR EMPRESA
=============================================*/
$(document).ready(function() {
    $("#empresa").on("click", ".btnGetEditarEmpresa", function() {

        $(".modal-body").hide();
        $('#editarloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');
        $(".previsualizarEmpresa").attr("src", base_url + "public/images/food-defecto.png");

        var idEmpresa = $(this).attr("idempresa");
        var dataString = { idEmpresa: idEmpresa };

        $.ajax({

            url: base_url + "empresa/geteditar",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(respuesta) {
                $("#idEditEmpresa").val(respuesta.empresa.EMPRESA_ID);
                $("#cmbEditCiudad").val(respuesta.empresa.CIUDAD_ID);
                $("#txtEditEmpresa").val(respuesta.empresa.EMPRESA_NOMBRE);
                $("#txtEditRazon").val(respuesta.empresa.EMPRESA_RAZON);
                $("#txtEditRut").val(respuesta.empresa.EMPRESA_RUT);
                $("#txtEditDireccion").val(respuesta.empresa.EMPRESA_DIRECCION);
                $("#txtEditLatitud").val(respuesta.empresa.EMPRESA_LAT);
                $("#txtEditLongitud").val(respuesta.empresa.EMPRESA_LONG);
                $("#txtEditUrl").val(respuesta.empresa.EMPRESA_WEB);
                $("#txtEditFacebook").val(respuesta.empresa.EMPRESA_FACEBOOK);
                $("#txtEditInstagram").val(respuesta.empresa.EMPRESA_INSTAGRAM);
                $("#txtEditFono").val(respuesta.empresa.EMPRESA_FONO);
                $("#txtEditEmail").val(respuesta.empresa.EMPRESA_EMAIL);
                $("#txtEditComercio").val(respuesta.empresa.EMPRESA_COD_COMERCIO);
                $("#txtEditIngreso").val(respuesta.empresa.EMPRESA_INGRESO);
                $("#txtEditDescripcion").val(respuesta.empresa.EMPRESA_DESCRIPCION);

                $("#fotoActualEmpresa").val(respuesta.empresa.EMPRESA_LOGOTIPO);
                if (respuesta.empresa.EMPRESA_LOGOTIPO !== null) {
                    $(".previsualizarEmpresa").attr("src", base_url + respuesta.empresa.EMPRESA_LOGOTIPO);
                }

                $('#editarloading').html('');
                $(".modal-body").show();
            }

        });

    });
}); //FIN DOCUMENT

/*=============================================
GET VER HORARIO EMPRESA
=============================================*/
$(document).ready(function() {
    $("#empresa").on("click", ".btnInsertHorario", function() {

        $(".modal-body").hide();
        $('#horaloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');

        var idEmpresa = $(this).attr("idempresa");
        var tblHorario = "";

        var dataString = { idEmpresa: idEmpresa };

        $.ajax({

            url: base_url + "empresa/gethorario",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(respuesta) {
                $("#verNmbEmpresaHorario").text(respuesta.empresa.EMPRESA_NOMBRE);
                $("#idEmpresaHour").val(respuesta.empresa.EMPRESA_ID);

                if (respuesta.empresa.EMPRESA_LOGOTIPO !== null) {
                    $(".previsualizarVerLogoEmpresa").attr("src", base_url + respuesta.empresa.EMPRESA_LOGOTIPO);
                } else {
                    $(".previsualizarVerLogoEmpresa").attr("src", base_url + "public/images/food-defecto.png");
                }

                tblHorario += '<table class="table table-striped" style="width:100%">';
                $.each(respuesta.horario, function(index, value) {
                    tblHorario += "<tr><td>" + value.DIA_NOMBRE + "</td><td>" + value.HORARIO_APERTURA + " - " + value.HORARIO_CIERRE + "</td><td><button class='btn btn-danger btndeletehorario' idhorario='" + value.HORARIO_ID + "' idempresa='" + idEmpresa + "'><i class='fa fa-trash'></i></button></td></tr>";
                });
                tblHorario += '</table>';
                $("#tblHorario").html(tblHorario);

                $('#horaloading').html('');
                $(".modal-body").show();
            }

        });

    });
}); //FIN DOCUMENT

/*=============================================
VALIDAR DATOS ENTRADA HORARIO EMPRESA
=============================================*/
$(document).ready(function() {

    $("#guardarHorario").attr("disabled", true);
    $(".cmbDiaInicio, .cmbHoraInicio, .cmbDiaCierre, .cmbHoraCierre").change(function() {

        var diainicio = $('input[name=cmbDiaInicio]:checked').val();
        var horainicio = $('input[name=cmbHoraInicio]:checked').val();
        var horacierre = $('input[name=cmbHoraCierre]:checked').val();
        //alert(diainicio.length);

        //VALIDAR DiaInicio		
        var boolDiaInicio = false;
        if (diainicio.length) { boolDiaInicio = true; }
        //VALIDAR HoraInicio		
        var boolHoraInicio = false;
        if (horainicio.length) { boolHoraInicio = true; }
        //VALIDAR HoraCierre		
        var boolHoraCierre = false;
        if (horacierre.length) { boolHoraCierre = true; }

        //COMPROBAR TODOS LOS CAMPOS
        if (boolDiaInicio && boolHoraInicio && boolHoraCierre) {
            $("#guardarHorario").attr("disabled", false);
        } else {
            $("#guardarHorario").attr("disabled", true);
        }

    });

}); //FIN DOCUMENT

/*=============================================
INSERT HORARIO EMPRESA
=============================================*/
$(document).ready(function() {
    $("#guardarHorario").on("click", function() {

        var idempresa = $("#idEmpresaHour").val();
        var diainicio = $('input[name=cmbDiaInicio]:checked').val();
        var horainicio = $('input[name=cmbHoraInicio]:checked').val();
        var diacierre = $('input[name=cmbDiaCierre]:checked').val();
        var horacierre = $('input[name=cmbHoraCierre]:checked').val();
        var tblHorario = "";

        var dataString = { idempresa: idempresa, diainicio: diainicio, horainicio: horainicio, diacierre: diacierre, horacierre: horacierre };

        $.ajax({
            url: base_url + "empresa/inserthorario",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(respuesta) {

                $("#horarioingresado").html('<div class="alert alert-success">HORARIO INGRESADO EXITOSAMENTE<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>');
                $('#formInsertHorario').trigger("reset");
                $("#guardarHorario").attr("disabled", true);

                tblHorario += '<table class="table table-striped" style="width:100%">';
                $.each(respuesta.horario, function(index, value) {
                    tblHorario += "<tr><td>" + value.DIA_NOMBRE + "</td><td>" + value.HORARIO_APERTURA + " - " + value.HORARIO_CIERRE + "</td><td><button class='btn btn-danger btndeletehorario' idhorario='" + value.HORARIO_ID + "' idempresa='" + idempresa + "'><i class='fa fa-trash'></i></button></td></tr>";
                });
                tblHorario += '</table>';
                $("#tblHorario").html(tblHorario);

            }
        });

    });
}); //FIN DOCUMENT

/*=============================================
DELETE HORARIO EMPRESA
=============================================*/
$(document).on('click', '.btndeletehorario', function() {

    $(".modal-body").hide();
    $('#horaloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');

    var idEmpresa = $(this).attr("idempresa");
    var idHorario = $(this).attr("idhorario");
    var tblHorario = "";

    var dataString = { idEmpresa: idEmpresa, idHorario: idHorario };

    $.ajax({

        url: base_url + "empresa/deletehorario",
        method: "POST",
        data: dataString,
        dataType: "json",
        success: function(respuesta) {

            tblHorario += '<table class="table table-striped" style="width:100%">';
            $.each(respuesta.horario, function(index, value) {
                tblHorario += "<tr><td>" + value.DIA_NOMBRE + "</td><td>" + value.HORARIO_APERTURA + " - " + value.HORARIO_CIERRE + "</td><td><button class='btn btn-danger btndeletehorario' idhorario='" + value.HORARIO_ID + "' idempresa='" + idEmpresa + "'><i class='fa fa-trash'></i></button></td></tr>";
            });
            tblHorario += '</table>';
            $("#tblHorario").html(tblHorario);

            $('#horaloading').html('');
            $(".modal-body").show();
        }

    });
});

/*=============================================
GET VER FOTOS PROMOCIÓN EMPRESA
=============================================*/
$(document).ready(function() {
    $("#empresa").on("click", ".btnInsertFoto", function() {

        $(".modal-body").hide();
        $('#fotoloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');
        $(".previsualizarEmpresa").attr("src", base_url + "public/images/food-defecto.png");

        var idempresa = $(this).attr("idempresa");
        var tblFoto = "";

        var dataString = { idEmpresa: idempresa };

        $.ajax({

            url: base_url + "empresa/getfoto",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(respuesta) {
                $("#verNmbEmpresaFoto").text(respuesta.empresa.EMPRESA_NOMBRE);
                $("#idEmpresaFoto").val(respuesta.empresa.EMPRESA_ID);

                if (respuesta.empresa.EMPRESA_LOGOTIPO !== null) {
                    $(".previsualizarVerLogoEmpresa").attr("src", base_url + respuesta.empresa.EMPRESA_LOGOTIPO);
                } else {
                    $(".previsualizarVerLogoEmpresa").attr("src", base_url + "public/images/food-defecto.png");
                }

                tblFoto += '<div class="show-images" style="width:100%">';
                $.each(respuesta.fotos, function(index, value) {
                    tblFoto += "<a href='" + value.FOTO_URL + "' target='_blank'><img src='" + value.FOTO_URL + "' class='img-thumbnail' ></a>";
                });
                tblFoto += '</div>';
                $("#tblFoto").html(tblFoto);

                $('#fotoloading').html('');
                $(".modal-body").show();
            }

        });

    });
}); //FIN DOCUMENT

/*=============================================
INSERT FOTO PROMOCIÓN EMPRESA
=============================================*/
$(document).ready(function() {
    $("#guardarFoto").on("click", function() {

        $(".modal-body").hide();
        $('#fotoloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');

        var tblFoto = "";
        var idempresa = $("#idEmpresaFoto").val();
        var imagen = $("#nuevaFotoPromo")[0].files[0];

        var datosImagen = new FileReader();
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event) {

            var rutaimagen = event.target.result;
            var dataString = { idempresa: idempresa, rutaimagen: rutaimagen };

            $.ajax({
                type: "POST",
                url: base_url + "empresa/insertfoto",
                data: dataString,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
                },
                success: function(respuesta) {

                    respuesta = JSON.parse(respuesta);

                    $("#fotoingresado").html('<div class="alert alert-success">IMAGEN INGRESADA EXITOSAMENTE<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>');
                    $(".previsualizarEmpresa").attr("src", base_url + 'public/images/food-defecto.png');
                    $("#nuevaFotoPromo").val("");
                    $("#guardarFoto").attr("disabled", true);

                    tblFoto += '<table class="table table-striped" style="width:100%">';
                    $.each(respuesta.fotos, function(index, value) {
                        tblFoto += "<tr><td><a href='" + value.FOTO_URL + "' target='_blank'><img src='" + value.FOTO_URL + "' width='30' ></a></td><td>" + value.FOTO_DATE + "</td><td><button class='btn btn-danger btndeletefotopromo' idfoto='" + value.FOTO_ID + "' idempresa='" + idempresa + "'><i class='fa fa-trash'></i></button></td></tr>";
                    });
                    tblFoto += '</table>';
                    $("#tblFoto").html(tblFoto);

                    $('#fotoloading').html('');
                    $(".modal-body").show();

                }
            });

        });


    });
}); //FIN DOCUMENT

/*=============================================
DELETE FOTO PROMOCIÓN EMPRESA
=============================================*/
$(document).on('click', '.btndeletefotopromo', function() {

    $(".modal-body").hide();
    $('#fotoloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');

    var idempresa = $(this).attr("idempresa");
    var idfoto = $(this).attr("idfoto");
    var tblFoto = "";

    var dataString = { idEmpresa: idempresa, idfoto: idfoto };

    $.ajax({

        url: base_url + "empresa/deletefotopromo",
        method: "POST",
        data: dataString,
        dataType: "json",
        success: function(respuesta) {

            tblFoto += '<table class="table table-striped" style="width:100%">';
            $.each(respuesta.fotos, function(index, value) {
                tblFoto += "<tr><td><a href='" + value.FOTO_URL + "' target='_blank'><img src='" + value.FOTO_URL + "' width='30' ></a></td><td>" + value.FOTO_DATE + "</td><td><button class='btn btn-danger btndeletefotopromo' idfoto='" + value.FOTO_ID + "' idempresa='" + idempresa + "'><i class='fa fa-trash'></i></button></td></tr>";
            });
            tblFoto += '</table>';
            $("#tblFoto").html(tblFoto);

            $('#fotoloading').html('');
            $(".modal-body").show();
        }

    });
});

/*=============================================
GET PLAN EMPRESA
=============================================*/
$(document).ready(function() {
    $("#empresa").on("click", ".btnInsertPlan", function() {

        $(".modal-body").hide();
        $('#planloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');

        var idEmpresa = $(this).attr("idempresa");
        var tblPlanes = "";

        var dataString = { idEmpresa: idEmpresa };

        $.ajax({

            url: base_url + "empresa/getplan",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(respuesta) {
                $("#verNmbEmpresaPlan").text(respuesta.empresa.EMPRESA_NOMBRE);
                $("#idEmpresaPlan").val(respuesta.empresa.EMPRESA_ID);

                if (respuesta.empresa.EMPRESA_LOGOTIPO !== null) {
                    $(".previsualizarVerLogoEmpresa").attr("src", base_url + respuesta.empresa.EMPRESA_LOGOTIPO);
                } else {
                    $(".previsualizarVerLogoEmpresa").attr("src", base_url + "public/images/food-defecto.png");
                }

                tblPlanes += '<table class="table table-striped" style="width:100%">';
                $.each(respuesta.planes, function(index, value) {
                    fechaFin = value.EMPRESA_PLAN_FIN ? value.EMPRESA_PLAN_FIN : '---------------';
                    tblPlanes += "<tr><td>" + value.PLAN_NOMBRE + "</td><td>" + value.EMPRESA_PLAN_COMIENZO + "</td><td>" + fechaFin + "</td></tr>";
                });
                tblPlanes += '</table>';
                $("#tblPlanes").html(tblPlanes);

                $('#planloading').html('');
                $(".modal-body").show();
            }

        });

    });
}); //FIN DOCUMENT

/*=============================================
INSERT PLAN EMPRESA
=============================================*/
$(document).ready(function() {
    $("#guardarPlan").on("click", function() {

        var idempresa = $("#idEmpresaPlan").val();
        var cmbPlan = $("#cmbPlan").val();
        var tblPlanes = "";

        var dataString = { idempresa: idempresa, cmbPlan: cmbPlan };

        $.ajax({

            url: base_url + "empresa/insertplan",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(respuesta) {

                $("#planingresado").html('<div class="alert alert-success">PLAN INGRESADO EXITOSAMENTE<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>');
                $("#cmbPlan").val("");

                tblPlanes += '<table class="table table-striped" style="width:100%">';
                $.each(respuesta.planes, function(index, value) {
                    fechaFin = value.EMPRESA_PLAN_FIN ? value.EMPRESA_PLAN_FIN : '---------------';
                    tblPlanes += "<tr><td>" + value.PLAN_NOMBRE + "</td><td>" + value.EMPRESA_PLAN_COMIENZO + "</td><td>" + fechaFin + "</td></tr>";
                });
                tblPlanes += '</table>';
                $("#tblPlanes").html(tblPlanes);

            }
        });

    });
}); //FIN DOCUMENT

/*=============================================
PERMISOS BACKEND INGRESO EMPRESA
=============================================*/
$(document).on('click', '.btnDarPermisos', function() {

    var idempresa = $(this).attr("idempresa");
    var valor = $(this).attr("valor");

    var txtText = valor === "0" ? "Esta acción eliminará los permisos de ingreso a la empresa." : "Esta acción otorgará los permisos de ingreso a la empresa.";
    var buttonClass = valor === "0" ? "btn-danger" : "btn-success";
    var buttonText = valor === "0" ? "Si, eliminar permisos!" : "Si, dar permisos!";

    swal({
            title: "Estás seguro?",
            text: txtText,
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: buttonClass,
            confirmButtonText: buttonText,
            closeOnConfirm: false
        },
        function() {
            var dataString = { idempresa: idempresa, valor: valor };
            $.ajax({
                url: base_url + "empresa/updatepermisos",
                method: "POST",
                data: dataString,
                dataType: "json",
                success: function(respuesta) {
                    swal({
                        title: respuesta.title,
                        text: respuesta.text,
                        type: "success"
                    }, function() {
                        window.location = base_url + "empresa";
                    });
                }
            });
        });

}); //FIN DOCUMENT

/*=============================================
VALIDAR NOMBRE EMPRESA EXISTENTE INGRESO
=============================================*/
$(document).on('change', '#txtEmpresa', function() {

    var nmbEmpresa = $(this).val();

    var dataString = { nmbEmpresa: nmbEmpresa };

    $.ajax({

        url: base_url + "empresa/insertValidarEmpresa",
        method: "POST",
        data: dataString,
        success: function(respuesta) {

            if (respuesta) {
                swal({
                    title: "Error!!!",
                    text: "Nombre empresa existente, favor ingresar otro.",
                    type: "error",
                    confirmButtonText: "¡Cerrar!"
                });
            }

        }
    });

}); //FIN DOCUMENT

/*=============================================
VALIDAR NOMBRE EMPRESA EXISTENTE UPDATE
=============================================*/
$(document).on('change', '#txtEditEmpresa', function() {

    var idEmpresa = $("#idEditEmpresa").val();
    var nmbEmpresa = $(this).val();

    var dataString = { idEmpresa: idEmpresa, nmbEmpresa: nmbEmpresa };

    $.ajax({

        url: base_url + "empresa/updateValidarEmpresa",
        method: "POST",
        data: dataString,
        success: function(respuesta) {

            if (respuesta) {
                swal({
                    title: "Error!!!",
                    text: "Nombre empresa existente, favor ingresar otro.",
                    type: "error",
                    confirmButtonText: "¡Cerrar!"
                });
            }

        }
    });

}); //FIN DOCUMENT

/*=============================================
VALIDAR EMAIL EXISTENTE INGRESO
=============================================*/
$(document).on('change', '#txtEmail', function() {

    var email = $(this).val();

    var dataString = { email: email };

    $.ajax({

        url: base_url + "empresa/insertValidarEmail",
        method: "POST",
        data: dataString,
        success: function(respuesta) {

            if (respuesta) {
                swal({
                    title: "Error!!!",
                    text: "Email existente, favor ingresar otro.",
                    type: "error",
                    confirmButtonText: "¡Cerrar!"
                });
            }

        }
    });

}); //FIN DOCUMENT

/*=============================================
VALIDAR EMAIL EXISTENTE UPDATE
=============================================*/
$(document).on('change', '#txtEditEmail', function() {

    var idEmpresa = $("#idEditEmpresa").val();
    var emailEmpresa = $(this).val();

    var dataString = { idEmpresa: idEmpresa, emailEmpresa: emailEmpresa };

    $.ajax({

        url: base_url + "empresa/updateValidarEmail",
        method: "POST",
        data: dataString,
        success: function(respuesta) {

            if (respuesta) {
                swal({
                    title: "Error!!!",
                    text: "Email existente, favor ingresar otro.",
                    type: "error",
                    confirmButtonText: "¡Cerrar!"
                });
            }

        }
    });

}); //FIN DOCUMENT