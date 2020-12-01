<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Localfood</title>
  </head>
  <body>
    <form action="<?php echo $formAction ?>" method="POST" id="send-form">
		<input type="hidden" name="token_ws" value="<?php echo $tokenWs ?>">
		<!-- <button type="submit" class="btn btn-primary">ENVIAR</button> -->
	</form>

	<script>
		document.getElementById("send-form").submit();
	</script>
  </body>
</html>