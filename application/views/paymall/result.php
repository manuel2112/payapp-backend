<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Localfood</title>
  </head>
  <body>
    <form action="<?php echo $urlRedirection; ?>" method="POST" id="return-form">
		<input type="hidden" name="token_ws" value="<?php echo $tokenWs ?>">
		<!-- <button type="submit" class="btn btn-primary">ENVIAR</button> -->
	</form>

	<script>
		document.getElementById("return-form").submit();
	</script>
  </body>
</html>