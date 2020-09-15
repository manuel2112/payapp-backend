/*=============================================
IMAGENES DESTACADAS
=============================================*/
    $(document).ready(function () {
		$('#file-es').fileinput({
			theme: 'explorer-fas',
			language: 'es',
			uploadUrl: '#',
			allowedFileExtensions: ['jpg', 'png'],
			overwriteInitial: false,
			maxFileSize: 1024,
			maxFileCount: 5,
			showRemove: false,
			showUpload: false
		});
		
		$('#file-not').fileinput({
			theme: 'explorer-fas',
			language: 'es',
			uploadUrl: '#',
			allowedFileExtensions: ['jpg', 'png'],
			overwriteInitial: false,
			maxFileSize: 1024,
			maxFileCount: 1,
			showRemove: false,
			showUpload: false
		});
		
    });	