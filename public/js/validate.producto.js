/*=============================================
MODAL PRODUCTO
=============================================*/
$(document).ready(function() {

    //FIJAR MODAL
    $("#mdlProductoOpen").click(function() {
        $("#mdlProducto").modal({ backdrop: "static" });
    });

    //RESET MODAL AL CERRAR
    $('#mdlProducto').on('hide.bs.modal', function(event) {
        $('#formAddProducto').trigger("reset");
        $("#datosProducto").show();
        $('#addValorVariable').html('');
    }); //FIN #mdlProducto

    //RESET MODAL AL CERRAR
    $('#mdlOrderProductos').on('hide.bs.modal', function(event) {
		window.location = base_url + "productos";
    }); //FIN #mdlProducto

    //RESET MODAL AL ABRIR
    $('#mdlProducto').on('shown.bs.modal', function(event) {
        $('#formAddProducto').trigger("reset");
        $("#datosProducto").show();
        $('#addValorVariable').html('');
		var item = $("#mdlProductoOpen").attr("iditem");
    }); //FIN #mdlProducto

}); //FIN DOCUMENT

/*=============================================
GET TIPO PRODUCTO POR EMPRESA
=============================================*/

$(document).ready(function() {

    //RESET MODAL AL ABRIR
    $('.mdlProducto').on('click', function(event) {
        var nmbProducto = $(this).attr("nmbProducto");
        var IdProducto = $(this).attr("iditem");
		$("#ttlProducto").html('<h4 class="modal-title">AGREGAR PRODUCTO - ' + nmbProducto + '</h4>');
		$("#idTipoProducto").val(IdProducto);
    }); //FIN #mdlProducto

	//OK
    $(".mdlOrderProductosOpen").click(function() {
        $("#mdlOrderProductos").modal({ backdrop: "static" });

        var idItem = $(this).attr("iditem");
        var tblProductosOrder = "";
        var dataString = { idItem: idItem };
        $.ajax({
            url: base_url + "productos/menuproductosempresa",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {
				
				$("#titleOrdenarProductos").html('<h4 class="modal-title">ORDENAR PRODUCTOS POR ITEM: '+ res.item.TIPO_PRODUCTO_NOMBRE +'</h4>');
				
                tblProductosOrder += '<table class="table table-striped" style="width:100%"><tr><th>ORDENAR</th><th>PRODUCTO</th></tr><tbody class="row_productos">';
                var i = 1;
                $.each(res.productos, function(index, value) {
                    tblProductosOrder += "<tr id=" + value.PRODUCTO_ID + "><td width='30%'><i class='fas fa-bars btn btn-secondary cursor'></i></td><td>" + value.PRODUCTO_NOMBRE + "</td></tr>";
                });
                tblProductosOrder += '</tbody></table>';
                $("#tblProductosOrder").html(tblProductosOrder);
                $('<script>$( ".row_productos" ).sortable({ delay: 150,stop: function() {var selectedData = new Array();$(".row_productos>tr").each(function() {selectedData.push($(this).attr("id"));});updateOrder(selectedData); }});function updateOrder(data) { $.ajax({ url: base_url + "productos/orderproducto",  type: "post",  data: {position:data},  success: function(res){ console.log("OK"); } }); }</script>').appendTo(document.body);
                $('').appendTo(document.body);

            }
        });

    });
	
    $("#mdlProducto").on("change", "#idEmpresaProducto", function() {

        var idEmpresa = $(this).val();
        var cmbItems = "";
        $("#datosProducto").hide("slow");

        var dataString = { idEmpresa: idEmpresa };
        $("#idTipoProducto").html('');
        $("#idTipoProducto").append('<option value="">SELECCIONAR ITEM (*)...</option>');

        $.ajax({

            url: base_url + "productos/getitemporempresa",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {
				
                $.each(res.items, function(index, value) {
                    $("#idTipoProducto").append('<option value=' + value.TIPO_PRODUCTO_ID + ' class="clickItem">' + value.TIPO_PRODUCTO_NOMBRE + '</option>');
                });
				}
			});
		});

		$("#mdlProducto").on("click", ".clickItem", function() {
			var idItem = $(this).val();
			$("#datosProducto").show("slow");
		});
});

/*=============================================
VALIDAR DATOS PRODUCTO
=============================================*/
$(document).ready(function() {

    $("#btnGuardarProducto").attr("disabled", true);
    $("#btnGuardarProductoVaVar").attr("disabled", true);
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
            $("#btnGuardarProductoVaVar").attr("disabled", false);
        } else {
            $("#btnGuardarProducto").attr("disabled", true);
            $("#btnGuardarProductoVaVar").attr("disabled", true);
        }

    });

}); //FIN DOCUMENT

/*=============================================
INSERT PRODUCTO
=============================================*/
//OK
$(document).ready(function() {
    $("#btnGuardarProducto").on("click", function() {

        var idEmpresaProducto 		= $("#idEmpresaProducto").val();
        var idTipoProducto 			= $("#idTipoProducto").val();
        var txtAddProducto 			= $("#txtAddProducto").val();
        var txtAddProductoValor 	= $("#txtAddProductoValor").val();
        var txtAddProductoStock 	= $("#txtAddProductoStock").val();
        var txtAddProductoDesc 		= $("#txtAddProductoDesc").val();
        var chkProductoOferta 		= null;
        var chkProductoDest 		= null;
        var txtAddProductoDescVar 	= $('input[name="txtAddProductoDescVar[]"]').map(function() { return $(this).val(); }).get();
        var txtAddProductoValorVar 	= $('input[name="txtAddProductoValorVar[]"]').map(function() { return $(this).val(); }).get();
        var txtAddProductoStockVar 	= $('input[name="txtAddProductoStockVar[]"]').map(function() { return $(this).val(); }).get();

        if ($("#chkProductoOferta").is(':checked')) {
            chkProductoOferta = $("#chkProductoOferta").val();
        }
        if ($("#chkProductoDest").is(':checked')) {
            chkProductoDest = $("#chkProductoDest").val();
        }

        var formData = new FormData();
        var files = $('#imgProductoPrincipal')[0].files[0];

        formData.append('idEmpresaProducto', idEmpresaProducto);
        formData.append('idTipoProducto', idTipoProducto);
        formData.append('txtAddProducto', txtAddProducto);
        formData.append('txtAddProductoValor', txtAddProductoValor);
        formData.append('txtAddProductoStock', txtAddProductoStock);
        formData.append('txtAddProductoDesc', txtAddProductoDesc);
        formData.append('chkProductoOferta', chkProductoOferta);
        formData.append('chkProductoDest', chkProductoDest);
        formData.append('txtAddProductoDescVar', JSON.stringify(txtAddProductoDescVar));
        formData.append('txtAddProductoValorVar', JSON.stringify(txtAddProductoValorVar));
        formData.append('txtAddProductoStockVar', JSON.stringify(txtAddProductoStockVar));
        formData.append('imagen', files);
		
        $.ajax({
            url: base_url + "productos/insertproducto",
            method: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(res) {

                if (res.ok === '1') {
                    swal({
                        title: 'PRODUCTO',
                        text: 'PRODUCTO AGREGADO EXITOSAMENTE',
                        type: "success"
                    }, function() {
                        window.location = base_url + "productos";
                    });
                } else if (res.ok === '2') {
                    swal("PRODUCTO", "UN ERROR INESPERADO SE HA PRODUCIDO, FAVOR VOLVER A INTENTARLO.", "error");
                } else {
                    swal("PRODUCTO", "UN ERROR INESPERADO SE HA PRODUCIDO, FAVOR VOLVER A INTENTARLO.", "error");
                }
            }
        });
    });
}); //FIN DOCUMENT

/*=============================================
AGREGAR VALOR VARIABLE
=============================================*/
$(document).ready(function() {
    $(".variable").on("click", function() {

        var countVar = $('.numfila').length + 1;
        var campos = "";

        campos += '<hr>';
        campos += '<div class="row numfila" style="padding:0 15px 10px">';
        campos += '<div class="col-12">';
        campos += '<div class="form-group">';
        campos += '<div class="input-group"> ';
        campos += '<span class="input-group-addon">' + countVar + '</span>';
        campos += '<input type="text" class="form-control" name="txtAddProductoDescVar[]" placeholder="DESCRIPCIÓN PRODUCTO VARIABLE (*)..." required>';
        campos += '</div>';
        campos += '</div>';
        campos += '</div>';
        campos += '<div class="col-12">';
        campos += '<div class="form-group">';
        campos += '<div class="input-group">';
        campos += '<span class="input-group-addon">' + countVar + '</span>';
        campos += '<input type="number" class="form-control" name="txtAddProductoValorVar[]" placeholder="VALOR PRODUCTO VARIABLE (*)..." required>';
        campos += '</div>';
        campos += '</div>';
        campos += '</div>';
        campos += '<div class="col-12">';
        campos += '<div class="form-group">';
        campos += '<div class="input-group">';
        campos += '<span class="input-group-addon">' + countVar + '</span>';
        campos += '<input type="number" class="form-control" name="txtAddProductoStockVar[]" placeholder="INGRESAR STOCK, DEJAR EN BLANCO PARA STOCK INFINITO ...">';
        campos += '</div>';
        campos += '</div>';
        campos += '</div>';
        campos += '</div>';

        $('#addValorVariable').append(campos);

    });
}); //FIN DOCUMENT