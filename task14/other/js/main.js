function checkParams() {
    var email = $('#email').val();
    var password = $('#password').val();

    if(email.length !== 0 && password.length !== 0) {
        $('#submit').removeAttr('disabled');
    } else {
        $('#submit').attr('disabled', 'disabled');
    }
}