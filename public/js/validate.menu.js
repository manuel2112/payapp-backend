/*=============================================
GET TIPO PRODUCTO POR EMPRESA
=============================================*/
$(document).ready(function() {//OK
    $("#idEmpresaMnu").on("change", function() {

        var idEmpresa = $("#idEmpresaMnu").val();

        $("#tblMenu").html('');
        $('#loadingMnu').html('<img src="' + base_url + 'public/images/loading.gif" width="30" class="centerImg">');

        var dataString = { idEmpresa: idEmpresa };
        $.ajax({
            url: base_url + "productos/menuempresa",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                $('#loadingMnu').html('');

                if (res.ok === '1') {
                    $("#tblMenu").html(res.menu);
                    $('<script>$( ".row_position" ).sortable({ delay: 150,stop: function() {var selectedData = new Array();$(".row_position>tr").each(function() {selectedData.push($(this).attr("id"));});updateOrder(selectedData); }});function updateOrder(data) { $.ajax({ url: base_url + "productos/orderitem",  type: "post",  data: {position:data},  success: function(res){ console.log("your change successfully saved"); } }); }</script>').appendTo(document.body);
                    $('').appendTo(document.body);
                } else {
                    $("#insertok").html('<div class="alert alert-danger">Item existente, favor ingresar otro.<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>');
                }
            }
        });
    });
}); //FIN DOCUMENT

/*=============================================
VALIDAR DATOS PRODUCTO
=============================================*/
$(document).ready(function() {

    $("#btnGuardarProducto").attr("disabled", true);
    $("#idEmpresaProducto, #idTipoProducto, #txtAddProducto, #txtAddProductoValor ").keyup(function() {

        var idEmpresaProducto = $("#idEmpresaProducto").val();
        var idTipoProducto = $("#idTipoProducto").val();
        var txtAddProducto = $("#txtAddProducto").val();
        var txtAddProductoValor = $("#txtAddProductoValor").val();

        //VALIDAR CIUDAD		
        var boolIdEmpresaProducto = false;
        if (idEmpresaProducto !== "") { boolIdEmpresaProducto = true; }
        //VALIDAR CIUDAD		
        var boolIdTipoProducto = false;
        if (idTipoProducto !== "") { boolIdTipoProducto = true; }
        //VALIDAR CIUDAD		
        var boolTxtAddProducto = false;
        if (txtAddProducto !== "") { boolTxtAddProducto = true; }
        //VALIDAR CIUDAD		
        var boolTxtAddProductoValor = false;
        if (txtAddProductoValor !== "") { boolTxtAddProductoValor = true; }

        //COMPROBAR TODOS LOS CAMPOS
        if (boolIdEmpresaProducto && boolIdTipoProducto && boolTxtAddProducto && boolTxtAddProductoValor) {
            $("#btnGuardarProducto").attr("disabled", false);
        } else {
            $("#btnGuardarProducto").attr("disabled", true);
        }

    });

}); //FIN DOCUMENT