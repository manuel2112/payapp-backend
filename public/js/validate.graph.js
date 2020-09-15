/*=============================================
MODAL EN GRÁFICO
=============================================*/
$(document).ready(function(){	
	
	$('#modalGetGraph').on('shown.bs.modal',function(event){

		$("#myfirstchart").html('');
		$(".modal-body").hide();
		$('#graphloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');		

		var button	= $(event.relatedTarget);
        var title	= button.data('title');
        var seccion	= button.data('seccion');
        var campo	= button.data('campo');
		$("#title-modal").html(title);
		
		var dataString	= {seccion:seccion,campo:campo};
		
		$.ajax({

			url: base_url + "cliente/graphajax",
			method: "POST",
			data: dataString,
			dataType: "json",
			success: function(respuesta){
				
				//alert(respuesta);
				
				$('#graphloading').html('');
				$(".modal-body").show();

				new Morris.Line({

					element: 'myfirstchart',
					data: respuesta,
					xkey: 'dia',
					ykeys: ['value'],
					labels: [title],
					resize: 'true'

				});//FIN Morris
				
			}//FIN success

		});//FIN AJAX

	});//FIN #modalGetGraph

});//FIN DOCUMENT
