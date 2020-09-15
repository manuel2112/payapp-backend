/*=============================================
MODAL MENUS EMPRESA
=============================================*/
$(document).ready(function() {
	
	$('#mdlOrderItems').on('hide.bs.modal', function () {
		window.location = base_url + "productos";
	});
    //ITEM MODAL
	//OK
    $("#mdlOrderItemsOpen").click(function() {
        $("#mdlOrderItems").modal({ backdrop: "static" });
        var idEmpresa = $(this).attr("idempresa");
        var tblItemsOrder = "";
        var dataString = { idEmpresa: idEmpresa };
        $.ajax({
            url: base_url + "productos/menuitemempresa",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                tblItemsOrder += '<table class="table table-striped" style="width:100%"><tr><th>Ordenar(Drag & Drop)</th><th>Item</th></tr><tbody class="row_items">';
                var i = 1;
                $.each(res.items, function(index, value) {
                    tblItemsOrder += "<tr id=" + value.TIPO_PRODUCTO_ID + "><td width='35%'><i class='fas fa-bars btn btn-secondary cursor'></i></td><td>" + value.TIPO_PRODUCTO_NOMBRE + "</td></tr>";
                });
                tblItemsOrder += '</tbody></table>';
                $("#titleOrdenarItems").html('<h4 class="modal-title">' + res.empresa.EMPRESA_NOMBRE + ' - ORDENAR ITEMS</h4>');
                $("#tblItemsOrder").html(tblItemsOrder);
                $('<script>$( ".row_items" ).sortable({ delay: 150,stop: function() {var selectedData = new Array();$(".row_items>tr").each(function() {selectedData.push($(this).attr("id"));});updateOrder(selectedData); }});function updateOrder(data) { $.ajax({ url: base_url + "productos/orderitem",  type: "post",  data: {position:data},  success: function(res){ console.log("HECHO"); } }); }</script>').appendTo(document.body);
                $('').appendTo(document.body);

            }
        });

    });

    //ITEM PRODUCTO
    $(".mdlEditProductoOpen").click(function() {
		var nmbProducto = $(this).attr("nmbProducto");
		$("#ttlProducto").html('<h4 class="modal-title">' + nmbProducto + ' - ORDENAR PRODUCTOS</h4>');
    });

	$('#mdlOrderVaVar').on('hide.bs.modal', function () {
		window.location = base_url + "productos";
	});
    //ITEM VALORES VARIABLES
	//OK
    $(".mdlOrderVaVarOpen").click(function() {
        $("#mdlOrderVaVar").modal({ backdrop: "static" });
        var idProducto = $(this).attr("idproducto");
        var tblVaVarOrder = "";
        var dataString = { idProducto: idProducto };
        $.ajax({
            url: base_url + "productos/menuvavarempresa",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                tblVaVarOrder += '<table class="table table-striped" style="width:100%"><tr><th>ORDENAR</th><th>VALOR VARIABLE</th></tr><tbody class="row_vavar">';
                var i = 1;
                $.each(res.vavar, function(index, value) {
					if ( value.PROVAR_BASE == '1' ){ nmbVaVar = 'BASE' }
					else{ nmbVaVar = value.PROVAR_DESC }
                    tblVaVarOrder += "<tr id=" + value.PROVAR_ID + "><td width='30%'><i class='fas fa-bars btn btn-secondary cursor'></i></td><td>" + nmbVaVar + "</td></tr>";
                });
                tblVaVarOrder += '</tbody></table>';
                $("#titleOrdenarVaVar").html('<h4 class="modal-title">' + res.producto.PRODUCTO_NOMBRE + ' - ORDENAR VALORES VARIABLES DEL PRODUCTO</h4>');
                $("#tblVaVarOrder").html(tblVaVarOrder);
                $('<script>$( ".row_vavar" ).sortable({ delay: 150,stop: function() {var selectedData = new Array();$(".row_vavar>tr").each(function() {selectedData.push($(this).attr("id"));});updateOrder(selectedData); }});function updateOrder(data) { $.ajax({ url: base_url + "productos/ordervavar",  type: "post",  data: {position:data},  success: function(res){ console.log("your change successfully saved"); } }); }</script>').appendTo(document.body);
                $('').appendTo(document.body);

            }
        });

    });

    /*=============================================
    EDITAR ITEM MENÚ
    =============================================*/

    //GET ITEM MODAL
	//OK
	$('#mdlEditItems').on('hide.bs.modal', function () {
		window.location = base_url + "productos";
	});
    $(".mdlEditItemsGetOpen").click(function() {
        $("#mdlEditItems").modal({ backdrop: "static" });
        var idItem = $(this).attr("iditem");
        var dataString = { idItem: idItem };
        $.ajax({
            url: base_url + "productos/getitem",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                $("#titleEditarItemGet").html('<h4 class="modal-title">EDITAR ITEM - ' + res.item.TIPO_PRODUCTO_NOMBRE + '</h4>');
                $("#txtEditItem").val(res.item.TIPO_PRODUCTO_NOMBRE);
                $("#idEditItem").val(res.item.TIPO_PRODUCTO_ID);
                $("#idEditEmpresa").val(res.item.EMPRESA_ID);

            }
        });
    });
    //EDIT ITEM MODAL
	//OK
    $("#btnEditarItem").click(function() {
        var idItem = $('#idEditItem').val();
        var idEmpresa = $('#idEditEmpresa').val();
        var txtItem = $('#txtEditItem').val();
        var dataString = { idItem: idItem, idEmpresa: idEmpresa, txtItem: txtItem };
        $.ajax({
            url: base_url + "productos/edititem",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {
                if (res.ok === '1') {
                    $("#updateOkEditItem").html('<div class="alert alert-success">ITEM ACTUALIZADO EXITOSAMENTE<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>');
                } else {
                    $("#updateOkEditItem").html('<div class="alert alert-danger">ITEM EXISTENTE, INGRESAR OTRO!!!<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>');
                }

            }
        });
    });

    //GET PRODUCTO MODAL
	//OK
    $(".mdlEditProductoOpen").click(function() {
        $("#mdlEditProducto").modal({ backdrop: "static" });
        var idProducto = $(this).attr("idproducto");
        var dataString = { idProducto: idProducto };
        $.ajax({
            url: base_url + "productos/getproducto",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                $("#idEditProducto").val(res.producto.PRODUCTO_ID);
                $("#idEditItemProducto").val(res.producto.TIPO_PRODUCTO_ID);
                $("#titleEditarProductoGet").html('<h4 class="modal-title">EDITAR PRODUCTO: ' + res.producto.PRODUCTO_NOMBRE + '</h4>');
                $("#txtEditProducto").val(res.producto.PRODUCTO_NOMBRE);
                $("#txtEditProductoDesc").val(res.producto.PRODUCTO_DESC);

                $("#fotoActualProducto").val(res.producto.PRODUCTO_IMG);

                var chkOferta = res.producto.PRODUCTO_OFERTA === '1' ? true : false;
                $("#chkEditProductoOferta").prop("checked", chkOferta);

                var chkDest = res.producto.PRODUCTO_DESTACADO === '1' ? true : false;
                $("#chkEditProductoDest").prop("checked", chkDest);

                if (res.producto.PRODUCTO_IMG !== null) {
                    $(".previsualizarEmpresa").attr("src", base_url + res.producto.PRODUCTO_IMG);
                } else {
                    $(".previsualizarEmpresa").attr("src", img_defecto);
                }

            }
        });
    });
	
    //EDIT PRODUCTO MODAL
	//OK
    $("#btnEditarProducto").click(function() {
        var idProducto 	= $('#idEditProducto').val();
        var idItem 		= $('#idEditItemProducto').val();
        var txtProducto = $('#txtEditProducto').val();
        var txtProductoDesc = $('#txtEditProductoDesc').val();
        var chkProductoOferta = null;
        var chkProductoDest = null;
        $("#updateOkEditProducto").html('');

        if ($("#chkEditProductoOferta").is(':checked')) {
            chkProductoOferta = $("#chkEditProductoOferta").val();
        }
        if ($("#chkEditProductoDest").is(':checked')) {
            chkProductoDest = $("#chkEditProductoDest").val();
        }

        var formData = new FormData();
        var files = $('#EditImgProducto')[0].files[0];

        formData.append('idProducto', idProducto);
        formData.append('idItem', idItem);
        formData.append('txtProducto', txtProducto);
        formData.append('txtProductoDesc', txtProductoDesc);
        formData.append('chkProductoOferta', chkProductoOferta);
        formData.append('chkProductoDest', chkProductoDest);
        formData.append('imagen', files);
		
        $.ajax({
            url: base_url + "productos/editproducto",
            method: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(res) {

                if (res.ok === '1') {
                    swal({
                        title: 'PRODUCTO',
                        text: 'PRODUCTO ACTUALIZADO EXITOSAMENTE',
                        type: "success"
                    }, function() {
                        window.location = base_url + "productos";
                    });
                } else if (res.ok === '2') {
                    swal("PRODUCTO", "YA EXISTE UN PRODUCTO CON ESTE NOMBRE, FAVOR INGRESAR OTRO.", "error");
                } else {
                    alert(res.ok);
                    swal("PRODUCTO", "UN ERROR INESPERADO SE HA PRODUCIDO, FAVOR VOLVER A INTENTARLO.", "error");
                }

            }
        });
    });


    //VALIDAR INSERT VALOR VARIABLE
    $("#btnAddVaVar").attr("disabled", true);
    $("#txtAddProductoDescVar, #txtAddProductoValorVar ").keyup(function() {

        var idProducto 		= $("#idAddProductoVaVar").val();
        var txtProducto 	= $('#txtAddProductoDescVar').val();
        var txtPrecioVaVar 	= $('#txtAddProductoValorVar').val();

        //VALIDAR ID PRODUCTO		
        var boolIdProducto = false;
        if (idProducto !== "") { boolIdProducto = true; }
        //VALIDAR NOMBRE VALOR VARIABLE		
        var boolNmbPro = false;
        if (txtProducto !== "") { boolNmbPro = true; }
        //VALIDAR PRECIO VALOR VARIABLE		
        var boolPrecioVaVar = false;
        if (txtPrecioVaVar !== "") { boolPrecioVaVar = true; }

        //COMPROBAR TODOS LOS CAMPOS
        if ( boolIdProducto && boolNmbPro && boolPrecioVaVar ) {
            $("#btnAddVaVar").attr("disabled", false);
        } else {
            $("#btnAddVaVar").attr("disabled", true);
        }
    });
	
    //GET ADD VALOR VARIABLE MODAL
    $(".mdlAddVaVarOpen").click(function() {
        $("#mdlAddVaVar").modal({ backdrop: "static" });
        var idproducto	= $(this).attr("idproducto");
        var nmbProducto	= $(this).attr("nmbProducto");

        $("#idAddProductoVaVar").val(idproducto);
        $("#titleAddVaVarGet").html('<h4 class="modal-title">AGREGAR VALOR VARIABLE DEL PRODUCTO: ' + nmbProducto + '</h4>');

    });
	
    //ADD VALOR VARIABLE MODAL
	//OK
    $("#btnAddVaVar").click(function() {
        var idProducto = $('#idAddProductoVaVar').val();
        var txtProductoDescVar = $('#txtAddProductoDescVar').val();
        var txtProductoValorVar = $('#txtAddProductoValorVar').val();
        var txtProductoStockVar = $('#txtAddProductoStockVar').val();

        var dataString = { idProducto: idProducto, txtProductoDescVar: txtProductoDescVar, txtProductoValorVar: txtProductoValorVar, txtProductoStockVar: txtProductoStockVar };
        $.ajax({
            url: base_url + "productos/insertvavar",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                if (res.ok === '1') {
                    swal({
                        title: 'VALOR VARIABLE',
                        text: 'VALOR VARIABLE AGREGADO EXITOSAMENTE',
                        type: 'success'
                    }, function() {
                        window.location = base_url + "productos";
                    });
                } else {
                    swal("VALOR VARIABLE", "VALOR VARIABLE EXISTENTE, INGRESAR OTRO.", "error");
                }

            }
        });
    });
    //GET EDIT VALOR VARIABLE MODAL
	//OK
    $(".mdlEditVaVarOpen").click(function() {
        $("#mdlEditVaVar").modal({ backdrop: "static" });
        var idVaVar = $(this).attr("idvavar");
        var nmbProducto = $(this).attr("nmbProducto");
        var dataString = { idVaVar: idVaVar };
        $.ajax({
            url: base_url + "productos/getvavar",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                var nmbVavar = res.vavar.PROVAR_BASE === '1' ? 'VALOR BASE' : res.vavar.PROVAR_DESC;

                $("#idEditVaVar").val(res.vavar.PROVAR_ID);
                $("#idEditProductoVaVar").val(res.vavar.PRODUCTO_ID);
                $("#titleEditarVaVarGet").html('<h4 class="modal-title">EDITAR VALOR VARIABLE ' + nmbVavar + ', DEL PRODUCTO ' + nmbProducto + '</h4>');
                $("#txtEditProductoDescVar").val(nmbVavar);
                $("#txtEditProductoValorVar").val(res.vavar.PROVAR_VALOR);
                $("#txtEditProductoStockVar").val(res.vavar.PROVAR_STOCK);

            }
        });
    });
	
    //EDIT VALOR VARIABLE MODAL
	//OK
    $("#btnEditarVaVar").click(function() {
        var idProducto = $('#idEditProductoVaVar').val();
        var idVaVar = $('#idEditVaVar').val();
        var txtProductoDescVar = $('#txtEditProductoDescVar').val();
        var txtProductoValorVar = $('#txtEditProductoValorVar').val();
        var txtProductoStockVar = $('#txtEditProductoStockVar').val();

        $("#updateOkEditVaVar").html('');

        var dataString = { idProducto: idProducto, idVaVar: idVaVar, txtProductoDescVar: txtProductoDescVar, txtProductoValorVar: txtProductoValorVar, txtProductoStockVar: txtProductoStockVar };
        $.ajax({
            url: base_url + "productos/editvavar",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                if (res.ok === '1') {
                    swal({
                        title: 'VALOR VARIABLE',
                        text: 'VALOR VARIABLE ACTUALIZADO EXITOSAMENTE',
                        type: 'success'
                    }, function() {
                        window.location = base_url + "productos";
                    });
                } else {
                    swal("VALOR VARIABLE", "VALOR VARIABLE EXISTENTE, INGRESAR OTRO.", "error");
                }

            }
        });
    });

    /*=============================================
    HIDDEN
    =============================================*/

	//OK
    $(".hideItem").on("click", function() {
        var idItem = $(this).attr("iditem");
        var value = $(this).attr("hiddenitemvalue");

        var txtText = value === "0" ? "Esta acción ocultará el item." : "Esta acción mostrará el item.";
        var buttonClass = value === "0" ? "btn-danger" : "btn-success";
        var buttonText = value === "0" ? "Si, ocultar item!" : "Si, activar item!";

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
                var dataString = { idItem: idItem, value: value };
                $.ajax({
                    url: base_url + "productos/itemhidden",
                    method: "POST",
                    data: dataString,
                    dataType: "json",
                    success: function(respuesta) {
                        swal({
                            title: respuesta.title,
                            text: respuesta.text,
                            type: "success"
                        }, function() {
                            window.location = base_url + "productos";
                        });
                    }
                });
            });

    });

	//OK
    $(".hiddenProducto").on("click", function() {
        var idProducto = $(this).attr("idproducto");
        var value = $(this).attr("hiddenproductovalue");

        var txtText = value === "0" ? "Esta acción ocultará el producto." : "Esta acción mostrará el producto.";
        var buttonClass = value === "0" ? "btn-danger" : "btn-success";
        var buttonText = value === "0" ? "Si, ocultar producto!" : "Si, activar producto!";

        swal({
                title: "ESTÁS SEGURO?",
                text: txtText,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: buttonClass,
                confirmButtonText: buttonText,
                closeOnConfirm: false
            },
            function() {
                var dataString = { idProducto: idProducto, value: value };
                $.ajax({
                    url: base_url + "productos/productohidden",
                    method: "POST",
                    data: dataString,
                    dataType: "json",
                    success: function(respuesta) {
                        swal({
                            title: respuesta.title,
                            text: respuesta.text,
                            type: "success"
                        }, function() {
                            window.location = base_url + "productos";
                        });
                    }
                });
            });

    });

    $(".hiddenVaVar").on("click", function() {
        var idVaVar = $(this).attr("idvavar");
        var value = $(this).attr("hiddenvavarvalue");

        var txtText = value === "0" ? "Esta acción ocultará el valor variable." : "Esta acción mostrará el valor variable.";
        var buttonClass = value === "0" ? "btn-danger" : "btn-success";
        var buttonText = value === "0" ? "Si, ocultar valor variable!" : "Si, activar valor variable!";

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
                var dataString = { idVaVar: idVaVar, value: value };
                $.ajax({
                    url: base_url + "productos/vavarhidden",
                    method: "POST",
                    data: dataString,
                    dataType: "json",
                    success: function(respuesta) {
                        swal({
                            title: respuesta.title,
                            text: respuesta.text,
                            type: "success"
                        }, function() {
                            window.location = base_url + "productos";
                        });
                    }
                });
            });

    });

	//ok
    $(".destacarProducto").on("click", function() {
        var idProducto = $(this).attr("idproducto");
        var value = $(this).attr("destacarproductovalue");

        var txtText = value === "1" ? "Esta acción marcará el producto como destacado." : "Esta acción marcará el producto como no destacado.";
        var buttonClass = value === "1" ? "btn-warning" : "btn-warning";
        var buttonText = value === "1" ? "Si, activar destacado!" : "Si, desactivar destacado!";

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
                var dataString = { idProducto: idProducto, value: value };
                $.ajax({
                    url: base_url + "productos/productodestacado",
                    method: "POST",
                    data: dataString,
                    dataType: "json",
                    success: function(respuesta) {
                        swal({
                            title: respuesta.title,
                            text: respuesta.text,
                            type: "success"
                        }, function() {
                            window.location = base_url + "productos";
                        });
                    }
                });
            });

    });

	//OK
    $(".ofertaProducto").on("click", function() {
        var idProducto = $(this).attr("idproducto");
        var value = $(this).attr("ofertaproductovalue");

        var txtText = value === "1" ? "Esta acción marcará el producto como oferta." : "Esta acción marcará el producto como no oferta.";
        var buttonClass = value === "1" ? "btn-warning" : "btn-warning";
        var buttonText = value === "1" ? "Si, activar oferta!" : "Si, desactivar oferta!";

        swal({
                title: "ESTÁS SEGURO?",
                text: txtText,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: buttonClass,
                confirmButtonText: buttonText,
                closeOnConfirm: false
            },
            function() {
                var dataString = { idProducto: idProducto, value: value };
                $.ajax({
                    url: base_url + "productos/productooferta",
                    method: "POST",
                    data: dataString,
                    dataType: "json",
                    success: function(respuesta) {
                        swal({
                            title: respuesta.title,
                            text: respuesta.text,
                            type: "success"
                        }, function() {
                            window.location = base_url + "productos";
                        });
                    }
                });
            });

    });

    /*=============================================
    ELIMINAR
    =============================================*/

	//OK
    $(".deleteVaVar").on("click", function() {
        var idVaVar = $(this).attr("idvavar");

        swal({
                title: "ESTÁS SEGURO?",
                text: 'ESTA ACCIÓN ELIMINARÁ ESTE VALOR VARIABLE',
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-warning',
                confirmButtonText: 'SI, ELIMINAR VALOR VARIABLE',
                closeOnConfirm: false
            },
            function() {
                var dataString = { idVaVar: idVaVar };
                $.ajax({
                    url: base_url + "productos/vavardelete",
                    method: "POST",
                    data: dataString,
                    dataType: "json",
                    success: function(respuesta) {
                        swal({
                            title: respuesta.title,
                            text: respuesta.text,
                            type: "success"
                        }, function() {
                            window.location = base_url + "productos";
                        });
                    }
                });
            });

    });

	//OK
    $(".deleteProducto").on("click", function() {
        var idProducto = $(this).attr("idproducto");

        swal({
                title: "ESTÁS SEGURO?",
                text: 'ESTA ACCIÓN ELIMINARÁ ESTE PRODUCTO',
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-warning',
                confirmButtonText: 'SI, ELIMINAR PRODUCTO',
                closeOnConfirm: false
            },
            function() {
                var dataString = { idProducto: idProducto };
                $.ajax({
                    url: base_url + "productos/productodelete",
                    method: "POST",
                    data: dataString,
                    dataType: "json",
                    success: function(respuesta) {
                        swal({
                            title: respuesta.title,
                            text: respuesta.text,
                            type: "success"
                        }, function() {
                            window.location = base_url + "productos";
                        });
                    }
                });
            });

    });

	//OK
    $(".deleteItem").on("click", function() {
        var idItem = $(this).attr("iditem");

        swal({
                title: "ESTÁS SEGURO?",
                text: 'ESTA ACCIÓN ELIMINARÁ ESTE ITEM, PRODUCTOS Y LOS VALORES VARIABLES ASOCIADOS',
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-warning',
                confirmButtonText: 'SI, ELIMINAR ITEM',
                closeOnConfirm: false
            },
            function() {
                var dataString = { idItem: idItem };
                $.ajax({
                    url: base_url + "productos/itemdelete",
                    method: "POST",
                    data: dataString,
                    dataType: "json",
                    success: function(respuesta) {
                        swal({
                            title: respuesta.title,
                            text: respuesta.text,
                            type: "success"
                        }, function() {
                            window.location = base_url + "productos";
                        });
                    }
                });
            });

    });

    /*=============================================
    IMAGENES PRODUCTO
    =============================================*/

    //VALIDAR BOTON GALERÍA
	//OK
    $("#btnAddGaleriaProducto").attr("disabled", true);
    $("#file-es").change(function() {

        var validateFile = true;
        var validateCount = true;
        var validateBtn = true;
        //var files = $('#file-es')[0].files[0];
        var numFiles = $(this)[0].files.length;

        for (var i = 0; i < numFiles; i++) {
            imagen = $('#file-es')[0].files[i];
            if (imagen.type === 'image/png' || imagen.type === 'image/jpeg') {
                validateFile = false;
            }
        }
        if (numFiles > 0) {
            validateCount = false;
        }
        if (!validateFile && !validateCount) {
            validateBtn = false;
        }

        $("#btnAddGaleriaProducto").attr("disabled", validateBtn);

    });

    //GET GALERIA PRODUCTO
	//OK
    $(".mdlAddGaleriaProductoOpen").click(function() {
        $("#mdlAddGaleriaProducto").modal({ backdrop: "static" });
        var idProducto 	= $(this).attr("idproducto");
        var nmbProducto = $(this).attr("nmbProducto");
        var idEmpresa 	= $(this).attr("idEmpresa");
        var tblGaleria 	= "";

        var dataString = { idProducto: idProducto };
        $.ajax({
            url: base_url + "productos/productogetgaleria",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                $("#idGaleriaProducto").val(idProducto);
                $("#idGaleriaEmpresa").val(idEmpresa);
                $("#titleAddGaleriaProducto").html('<h4 class="modal-title">AGREGAR/EDITAR IMÁGENES PARA EL PRODUCTO ' + nmbProducto + '</h4>');

                tblGaleria += '<table class="table table-striped" style="width:100%"><tr><th>Ordenar</th><th>IMAGEN</th><th>ELIMINAR</th></tr><tbody class="row_galeria">';
                var i = 1;
                $.each(res.imagenes, function(index, value) {
                    tblGaleria += "<tr id=" + value.IMAGEN_ID + ">";
                    tblGaleria += "<td width='35%'><i class='fas fa-bars btn btn-secondary cursor'></i></td>";
                    tblGaleria += "<td><img src='" + base_url + value.IMAGEN_RUTA + "' width='50' ></td>";
                    tblGaleria += '<td><button type="button" class="btn btn-danger deleteImg" title="ELIMINAR IMAGEN" idimg="' + value.IMAGEN_ID + '"><i class="fas fa-trash-alt"></i></button></td>';
                    tblGaleria += "</tr>";
                });
                tblGaleria += '</tbody></table>';
                $("#tblGaleria").html(tblGaleria);
                $('<script>$( ".row_galeria" ).sortable({ delay: 150,stop: function() {var selectedData = new Array();$(".row_galeria>tr").each(function() {selectedData.push($(this).attr("id"));});updateOrder(selectedData); }});function updateOrder(data) { $.ajax({ url: base_url + "productos/ordergaleria",  type: "post",  data: {position:data},  success: function(res2){ console.log("OK"); } }); }</script>').appendTo(document.body);
				
                $('<script>$(".deleteImg").click(function() { var idimg = $(this).attr("idimg"); var dataString = { idimg: idimg }; $.ajax({ url: base_url + "productos/deletegaleriaimg", method: "POST",  data: dataString, dataType: "json", success: function(res3) { $("#"+res3.idImg).fadeTo(400, 0, function() { $("#"+res3.idImg).remove(); }); } }); });</script>').appendTo(document.body);

            }
        });
    });

}); //FIN DOCUMENT

//TOOLTIP INSTANCIAR
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});