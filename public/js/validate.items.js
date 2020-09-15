/*=============================================
MODAL ITEM
=============================================*/
$(document).ready(function() {

    //FIJAR MODAL
    $("#mdlItemsOpen").click(function() {
        $("#mdlItems").modal({ backdrop: "static" });
    });

    //RESET MODAL AL CERRAR
    $('#mdlItems').on('hide.bs.modal', function(event) {
        $('#formAddItem').trigger("reset");
        $("#insertok").html('');
        $("#tblItems").html('');
    }); //FIN #mdlItems

    //RESET MODAL AL ABRIR
    $('#mdlItems').on('shown.bs.modal', function(event) {
        $('#formAddItem').trigger("reset");
        $("#insertok").html('');
        $("#tblItems").html('');
    }); //FIN #mdlItems

}); //FIN DOCUMENT

/*=============================================
VALIDAR DATOS ENTRADA EMPRESA
=============================================*/
$(document).ready(function() {

    $("#btnGuardarItem").attr("disabled", true);
    $("#idEmpresaItem, #txtAddItem ").keyup(function() {

        var idEmpresaItem = $("#idEmpresaItem").val();
        var txtAddItem = $("#txtAddItem").val().trim();

        //VALIDAR CIUDAD		
        var boolIdEmpresa = false;
        if (idEmpresaItem !== "") { boolIdEmpresa = true; }
        //VALIDAR EMPRESA		
        var boolTxt = false;
        if (txtAddItem !== "") { boolTxt = true; }

        //COMPROBAR TODOS LOS CAMPOS
        if (boolIdEmpresa && boolTxt) {
            $("#btnGuardarItem").attr("disabled", false);
        } else {
            $("#btnGuardarItem").attr("disabled", true);
        }

    });

}); //FIN DOCUMENT

/*=============================================
INSERT ITEM
=============================================*/
$(document).ready(function() {//OK
    $("#btnGuardarItem").on("click", function() {

        var idEmpresa = $("#idEmpresaItem").val();
        var txtItem = $("#txtAddItem").val();

        var dataString = { idEmpresa: idEmpresa, txtItem: txtItem };
        $.ajax({
            url: base_url + "productos/insertitem",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                if (res.ok === '1') {
                    $('#formAddItem')[0].reset();
                    swal({
                        title: 'ITEM',
                        text: 'ITEM AGREGADO EXITOSAMENTE',
                        type: "success"
                    }, function() {
                        window.location = base_url + "productos";
                    });
                } else if (res.ok === '2') {
                    swal("ITEM", "ITEM EXISTENTE, FAVOR INGRESAR OTRO.", "error");
                } else {
					alert(res.ok);
                    swal("ITEM", "UN ERROR INESPERADO SE HA PRODUCIDO, FAVOR VOLVER A INTENTARLO.", "error");
                }
            }
        });
        $("#btnGuardarItem").attr("disabled", true);
    });
}); //FIN DOCUMENT

/*=============================================
ORDER ITEM
=============================================*/
$(document).ready(function() {

    // $(".row_position").sortable({
    //     delay: 150,
    //     stop: function() {
    //         var selectedData = new Array();
    //         $('.row_position>tr').each(function() {
    //             selectedData.push($(this).attr("id"));
    //         });
    //         updateOrder(selectedData);
    //     }
    // });

    // function updateOrder(data) {
    //     $.ajax({
    //         url: base_url + "productos/orderitem",
    //         type: 'post',
    //         data: { position: data },
    //         success: function(res) {
    //             console.log('your change successfully saved');
    //         }
    //     });
    // }

}); //FIN DOCUMENT