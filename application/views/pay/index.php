<ul>
    <li>MONTO: $<?php echo number_format($amount, 0, ',','.') ?></li>
    <li>ORDEN: <?php echo $buyOrder ?></li>
    <li>ACTION: <?php echo $formAction ?></li>
    <li>TOKEN: <?php echo $tokenWs ?></li>
</ul>

<form action="<?php echo $formAction ?>" method="POST">
    <input type="hidden" name="token_ws" value="<?php echo $tokenWs ?>">
    <button type="submit" class="btn btn-primary">ENVIAR</button>
</form>