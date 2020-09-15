/*=============================================
VALIDATE HORARIO
=============================================*/
$(document).ready(function() {

    //MODAL HORARIO
    $("#mdlHorarioOpen").click(function() {
        $("#mdlHorario").modal({ backdrop: "static" });
    });

    /*=============================================
    VALIDAR HORARIO
    =============================================*/
    $("#btnGuardarHorario").attr("disabled", true);
    $("#idEmpresa, #diaApertura, #horaApertura, #diaCierre, #horaCierre").change(function() {

        var idEmpresa = $("#idEmpresa").val();
        var diaApertura = $("#diaApertura").val();
        var horaApertura = $("#horaApertura").val();
        var diaCierre = $("#diaCierre").val();
        var horaCierre = $("#horaCierre").val();

        //VALIDAR CIUDAD		
        var boolIdEmpresa = false;
        if (idEmpresa !== "") { boolIdEmpresa = true; }
        //VALIDAR CIUDAD		
        var boolDiaApertura = false;
        if (diaApertura !== "") { boolDiaApertura = true; }
        //VALIDAR CIUDAD		
        var boolHoraApertura = false;
        if (horaApertura !== "") { boolHoraApertura = true; }
        //VALIDAR CIUDAD		
        var boolDiaCierre = false;
        if (diaCierre !== "") { boolDiaCierre = true; }
        //VALIDAR CIUDAD		
        var boolHoraCierre = false;
        if (horaCierre !== "") { boolHoraCierre = true; }

        //COMPROBAR TODOS LOS CAMPOS
        if (boolIdEmpresa && boolDiaApertura && boolHoraApertura && boolDiaCierre && boolHoraCierre) {
            $("#btnGuardarHorario").attr("disabled", false);
        } else {
            $("#btnGuardarHorario").attr("disabled", true);
        }

    });

    /*=============================================
    INSERT HORARIO
    =============================================*/
    $("#btnGuardarHorario").on("click", function() {

        var idEmpresa = $("#idEmpresa").val();
        var diaApertura = $("#diaApertura").val();
        var horaApertura = $("#horaApertura").val();
        var diaCierre = $("#diaCierre").val();
        var horaCierre = $("#horaCierre").val();

        var dataString = { idEmpresa: idEmpresa, diaApertura: diaApertura, horaApertura: horaApertura, diaCierre: diaCierre, horaCierre: horaCierre };

        $.ajax({
            url: base_url + "horario/inserthorario",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                if (res.ok === '1') {
                    swal({
                        title: 'HORARIO',
                        text: 'HORARIO AGREGADO EXITOSAMENTE',
                        type: "success"
                    }, function() {
                        window.location = base_url + res.url;
                    });
                } else if (res.ok === '2') {
                    swal("HORARIO", "UN ERROR INESPERADO SE HA PRODUCIDO, FAVOR VOLVER A INTENTARLO.", "error");
                } else {
                    alert(res.ok);
                    swal("HORARIO", "UN ERROR INESPERADO SE HA PRODUCIDO, FAVOR VOLVER A INTENTARLO.", "error");
                }
            }
        });
    });

    /*=============================================
    GET HORARIO/EMPRESA
    =============================================*/
    $("#idEmpresaHorario").on("change", function() {

        var idEmpresa = $("#idEmpresaHorario").val();

        $("#tblHorario").html('');
        $('#loadingHorario').html('<img src="' + base_url + 'public/images/loading.gif" width="30" class="centerImg">');

        var dataString = { idEmpresa: idEmpresa };
        $.ajax({
            url: base_url + "horario/gethorarioempresa",
            method: "POST",
            data: dataString,
            dataType: "json",
            success: function(res) {

                $('#loadingHorario').html('');

                if (res.ok === '1') {
                    $("#tblHorario").html(res.horario);
                } else {
                    // $("#insertok").html('<div class="alert alert-danger">Item existente, favor ingresar otro.<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>');
                }
            }
        });
    });

    /*=============================================
    MOSTRAR HORARIO CIERRE ASINCRONO
    =============================================*/
	//var upgradeTime =  $("#secCountdown").val();
	var seconds = upgradeTime;
	function timer() {
	  var days        = Math.floor(seconds/24/60/60);
	  var hoursLeft   = Math.floor((seconds) - (days*86400));
	  var hours       = Math.floor(hoursLeft/3600);
	  var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
	  var minutes     = Math.floor(minutesLeft/60);
	  var remainingSeconds = seconds % 60;
	  function pad(n) {
		return (n < 10 ? '0' + n : n);
	  }
	  
	  if( Number.isInteger(upgradeTime) ){
		  document.getElementById('countdown').innerHTML = upgradeTime;
	  }else{
		  document.getElementById('countdown').innerHTML = 'Falta ' + pad(days) + ':' + pad(hours) + ':' + pad(minutes) + ':' + pad(remainingSeconds) + ' para abrir.';
	  }
	  
	}
	
	var countdownTimer = setInterval(timer, 1000);

}); //FIN DOCUMENT