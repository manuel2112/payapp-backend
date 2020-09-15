<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $this->layout->getTitle(); ?></title>
    <meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>"  />
    <meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
    
    <link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap.min.css')?>">
</head>

<body>

	<div class="container-fluid">
            
		<main class="col">
			<div class="row">
				<div class="col">
					<h1 class="display-4 lead text-center text-secondary"><?php echo $empresa->EMPRESA_NOMBRE;?></h1>
					<div id="map" style="width:100%;height:600px;"></div>
				</div>
			</div>
		</main>
            
    </div>
  
<script type="text/javascript">
	var base_url	= '<?php echo base_url();?>';
</script>

<script src="http://localfood.cl/cliente/public/js/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBpfsCRBII3vxynSma0HVsFV-7QMnSDHlg"></script>
<script src="http://localfood.cl/cliente/public/js/gmaps.js"></script>
  
<script type="text/javascript">
	var map;
    $(document).ready(function(){
		
		map = new GMaps({
			el: '#map',
			lat: '<?php echo $empresa->EMPRESA_LAT;?>',
			lng: '<?php echo $empresa->EMPRESA_LONG;?>',
			zoom: 16,
			title: 'CIUDAD'
		});
		
		map.addMarker({
			lat: '<?php echo $empresa->EMPRESA_LAT;?>',
			lng: '<?php echo $empresa->EMPRESA_LONG;?>',
			title: "<?php echo $empresa->EMPRESA_NOMBRE;?>",
			label: "<?php echo $empresa->EMPRESA_NOMBRE;?>",
			labelClass: "labels",
			infoWindow: {
				content: "<h2><?php echo $empresa->EMPRESA_NOMBRE;?></h2>"
			}
		});
		
    });
	// var map;
    // $(document).ready(function(){
		
	// 	map = new GMaps({
	// 		el: '#map',
	// 		lat: '<?php echo $empresa->EMPRESA_LAT;?>',
	// 		lng: '<?php echo $empresa->EMPRESA_LONG;?>',
	// 		zoom: 17,
	// 		title: 'Lima'
	// 	});
		
	// 	map.addMarker({
	// 		lat: '<?php echo $empresa->EMPRESA_LAT;?>',
	// 		lng: '<?php echo $empresa->EMPRESA_LONG;?>',
	// 		title: '<?php echo $empresa->EMPRESA_NOMBRE;?>',
	// 		label: "<?php echo $empresa->EMPRESA_NOMBRE;?>",
	// 		labelClass: "labels",
	// 		infoWindow: {
	// 			content: '<h2><?php echo $empresa->EMPRESA_NOMBRE;?></h2>'
	// 		}
	// 	});
		
    // });
</script>

</body>
</html>