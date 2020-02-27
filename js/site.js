jQuery(document).ready(function($) {
    $("#province").change(e => {
        provId = $("#province").val();
        $.post("filter.php", {"provId":provId}, data => {
            $("#district").html(data);
        });
    });
});

jQuery(document).ready(function($) {
    provId = $("#province").val();
    $.post("filter.php", {"provId":provId}, data => {
        $("#district").html(data);
    });
});
    