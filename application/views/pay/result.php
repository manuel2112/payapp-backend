<?php
if( $responseCode == 0 ){
    echo '<script>window.localStorage.clear();</script>';
    echo '<script>window.localStorage.setItem("authorizationCode",'. $authorizationCode .')</script>';
    echo '<script>window.localStorage.setItem("amount",'. $amount .')</script>';
    echo '<script>window.localStorage.setItem("responseCode",'. $responseCode .')</script>';
}
?>

<?php if( $responseCode == 0 ){  ?>
<form action="<?php echo $urlRedirection; ?>" method="POST" id="return-form">
    <input type="hidden" name="token_ws" value="<?php echo $tokenWs ?>">
    <button type="submit" class="btn btn-primary">ENVIAR</button>
</form>

<script>
    document.getElementById("return-form").submit();
</script>
<?php } ?>