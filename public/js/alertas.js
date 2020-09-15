//ALERTA DELETE CATEGORIA
$('#delete-categoria').on('show.bs.modal', function(e) {
	$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
	
	$('.msn-alerta').html('<strong>ESTÁS SEGURO DE ELIMINAR ESTA CATEGORÍA?</strong>');	
});

//ALERTA DELETE PRODUCTO
$('#delete-producto').on('show.bs.modal', function(e) {
	$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
	
	$('.msn-alerta').html('<strong>ESTÁS SEGURO DE ELIMINAR ESTE PRODUCTO?</strong>');	
});

//ALERTA UP PRODUCTO
$('#up-producto').on('show.bs.modal', function(e) {
	$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
	
	$('.msn-alerta').html('<strong>ESTÁS SEGURO DE SUBIR ESTE PRODUCTO?</strong>');	
});