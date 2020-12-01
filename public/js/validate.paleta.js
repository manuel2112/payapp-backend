/*=============================================
VALIDAR DATOS PRODUCTO
=============================================*/
$(document).ready(function() {
    $(" .btn-color-01, .btn-color-02, .btn-color-03 ").click(function() {

        var posicion = this.name;
        if (this.name === 'btn-color-01') {
            var idColor = $("#slc-color-01").val();
        } else if (this.name === 'btn-color-02') {
            var idColor = $("#slc-color-02").val();
        } else if (this.name === 'btn-color-03') {
            var idColor = $("#slc-color-03").val();
        } else {}

        var dataString = { posicion: posicion, idColor: idColor };

        $.ajax({

            url: base_url + "paleta/update",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                swal({
                        title: "CAMBIAR COLOR",
                        text: res.txt,
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
            }

        });
    });

    $(" #slc-color-01, #slc-color-02, #slc-color-03 ").change(function() {

        var idColor = this.value;
        if (this.id === 'slc-color-01') {
            var card = '#card-01';
        } else if (this.id === 'slc-color-02') {
            var card = '#card-02';
        } else if (this.id === 'slc-color-03') {
            var card = '#card-03';
        } else {}

        var dataString = { idColor: idColor };

        $.ajax({

            url: base_url + "paleta/getcolor",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                $(card).css('background-color', res.color.COLOR_HEX);
            }

        });

    });


}); //FIN DOCUMENT