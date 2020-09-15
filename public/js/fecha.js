$(document).ready(function() {
    function getDateNow() {

        $.ajax({
            type: "POST",
            url: base_url + "base/showdate",
            dataType: "json",
            success: function(res) {
                if (res.ok === '1') {
                    $('#clockDiv').text(res.fecha);
                } else {
                    window.location = base_url + "login";
                }

            }
        });
    }

    setInterval(getDateNow, 1000);
});