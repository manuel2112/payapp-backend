/*=============================================
DELIVERY
=============================================*/
$(document).ready(function() {

    //INSERT/UPDATE MONTO MÍNIMO
    $("#mdl-valor-minimo").on("click", ".btn-guardar-monto", function() {
        var txtMonto = $('#txt-monto').val();
        var numberMonto = $('#number-monto').val();
        var dataString = { txtMonto: txtMonto, numberMonto: numberMonto };
        $.ajax({
            url: base_url + "tiponegocio/insertmonto",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {
                if (res.ok === '1') {
                    swal({
                            title: 'MONTO MÍNIMO DE ENVÍO',
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
                        title: 'MONTO MÍNIMO DE ENVÍO',
                        text: res.msn,
                        type: "error"
                    });
                }
            }
        });
    });

    //INSERT SECTOR
    $("#mdl-sector").on("click", ".btn-guardar-sector", function() {
        var txtSector = $('#txt-sector').val();
        var precioSector = $('#precio-sector').val();
        var dataString = { txtSector: txtSector, precioSector: precioSector };
        $.ajax({
            url: base_url + "tiponegocio/insertsector",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {
                if (res.ok === '1') {
                    $('#formSector')[0].reset();
                    $('#tbl-sector-php').html('');
                    tblSector();
                    swal({
                        title: 'SECTORIZAR VALORES',
                        text: res.msn,
                        type: "success"
                    });
                } else {
                    swal({
                        title: 'SECTORIZAR VALORES',
                        text: res.msn,
                        type: "error"
                    });
                }
            }
        });
    });

    //DELETE SECTOR
    $("#mdl-sector").on("click", ".btn-delete-sector", function() {

        var idSector = $(this).val();

        swal({
                title: "ESTÁS SEGURO?",
                text: 'ESTÁS SEGURO DE ELIMINAR ESTE SECTOR?',
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'SI, ELIMINAR',
                cancelButtonText: 'CANCELAR',
                closeOnConfirm: false
            },
            function() {
                var dataString = { idSector: idSector };
                $.ajax({
                    url: base_url + "tiponegocio/deletesector",
                    method: "POST",
                    data: dataString,
                    dataType: "json",
                    success: function(res) {
                        $('#tbl-sector-php').html('');
                        tblSector();
                        swal({
                            title: 'SECTORIZAR VALORES',
                            text: res.msn,
                            type: "success"
                        });
                    }
                });
            });
    });

    function tblSector() {
        $("#tbl-sector").hide();
        $('#sectorloading').html('<img src="' + base_url + 'public/images/loading.gif" width="50">');
        $.ajax({

            url: base_url + "tiponegocio/getsectores",
            method: "POST",
            dataType: "json",
            success: function(res) {

                var tblSectorData = '';
                tblSectorData += '<table class="table mt-4"><thead class="thead-dark"><tr><th scope="col">SECTOR</th><th scope="col">VALOR</th> <th scope="col">ELIMINAR</th></tr></thead><tbody>';
                $.each(res.sectores, function(index, value) {
                    tblSectorData += "<tr><td>" + value.SECTOR_OBS + "</td><td>" + value.SECTOR_VALOR + "</td><td><button  type='button'  class='btn btn-danger btn-delete-sector' value='" + value.SECTOR_ID + "'><i class='fas fa-trash'></i></button></td></tr>";
                });
                tblSectorData += '</tbody></table>';
                if (res.sectores.length == 0) {
                    $("#tbl-sector").html('');
                } else {
                    $("#tbl-sector").html(tblSectorData);
                }

                $('#sectorloading').html('');
                $("#tbl-sector").show();
            }

        });
    }

}); //FIN DOCUMENT