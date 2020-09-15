/*=============================================
MODAL EN GRÁFICO
=============================================*/
$(document).ready(function(){	
	
	$('#modalGetGraphAdmin').on('shown.bs.modal',function(event){

		$("#mychartadmin").html('');
		$(".modal-body").hide();
		$('#graphloading').html('<img src="' + base_url + 'public/images/loading.gif" width="300">');		

		var button	= $(event.relatedTarget);
        var title	= button.data('title');
        var seccion	= button.data('seccion');
		$("#title-modal").html(title);
		
		var dataString	= {seccion:seccion};
		
		$.ajax({

			url: base_url + "index/graphajax",
			method: "POST",
			data: dataString,
			dataType: "json",
			success: function(respuesta){
				
				//alert(respuesta);
				
				$('#graphloading').html('');
				$(".modal-body").show();

				new Morris.Bar({

					element: 'mychartadmin',
					data: respuesta,
					xkey: 'dia',
					ykeys: ['value'],
					labels: [title],
					resize: 'true'

				});//FIN Morris
				
			}//FIN success

		});//FIN AJAX

	});//FIN #modalGetGraphAdmin

});//FIN DOCUMENT
