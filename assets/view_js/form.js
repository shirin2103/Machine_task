function error_msg(data) {
    for (var key in data) {
        if (data[key] != '') {
            $("#" + key + "_error").html(data[key]).show();
        } else {
            $("#" + key + "_error").html('').hide();
        }
    }
    $('.error_msg').delay(5000).fadeOut();
}