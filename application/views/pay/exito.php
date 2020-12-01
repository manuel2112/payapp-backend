<table>
    <tr>
        <td>MONTO</td>
        <td id="amount"></td>
    </tr>
    <tr>
        <td>CÓDIGO DE AUTORIZACIÓN</td>
        <td id="authorizationCode"></td>
    </tr>
    <tr>
        <td>CÓDIGO DE RESPUESTA</td>
        <td id="responseCode"></td>
    </tr>
</table>

<script>
    document.getElementById('amount').innerHTML = window.localStorage.getItem("amount");
    document.getElementById('authorizationCode').innerHTML = window.localStorage.getItem("authorizationCode");
    document.getElementById('responseCode').innerHTML = window.localStorage.getItem("responseCode");
</script>