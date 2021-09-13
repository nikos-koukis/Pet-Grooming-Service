function show_hide_password_modal_login() {

    var pass = document.getElementById("user_password");
    if (pass.type === "password") {
        pass.type = "text";
        $("#eye").removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        pass.type = "password";
        $("#eye").removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }

}

$(document).ready( function () {


    // ------ Hide all errors ------------//

    $("#user_email_error").hide();

    $("#user_password_error").hide();

    $("#user_invalid_credits_error").hide();

    // ------ Disable all errors ----------------//

    var error_user_email = false;

    var error_user_password = false;

    var error_user_invalid_credits = false;

    function check_user_email(){

        var user_email = $("#user_email").val();
        var user_email_pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

        if(user_email == ""){
            $("#user_email_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#user_email").focus();
            $("#user_email_error").show();
            document.getElementById("user_email").style.borderColor = "red";
            error_user_email = true;
        }else if(user_email_pattern.test($("#user_email").val())){
            $("#user_email_error").hide();
            document.getElementById("user_email").style.borderColor = "green";
        }else{
            $("#user_email_error").html("Μη έγκυρη διεύθυνση email");
            $("#user_email_error").show();
            $("#user_email").focus();
            document.getElementById("user_email").style.borderColor = "red";
            error_user_email = true;
        }
    }

    $("#user_email").keyup(function () {
        $("#user_email_error").hide();
        document.getElementById("user_email").style.borderColor = "#ddd";
        $("#user_invalid_credits_error").hide();
    });

    function check_user_password(){

        var user_password = $("#user_password").val();

        if(user_password == ""){
            $("#user_password_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#user_password_error").show();
            $("#user_password").focus();
            document.getElementById("user_password").style.borderColor = "red";
            error_user_password = true;
        }else if(user_password.length < 8 ){
            $("#user_password_error").html("Εισάγεται τουλάχιστον 8 χαρακτήρες");
            $("#user_password_error").show();
            $("#user_password").focus();
            document.getElementById("user_password").style.borderColor = "red";
            error_user_password = true;
        }else{
            $("#user_password_error").hide();
            document.getElementById("user_password").style.borderColor = "green";
        }
    }

    $("#user_password").keyup(function () {
        $("#user_password_error").hide();
        document.getElementById("user_password").style.borderColor = "#ddd";
        $("#user_invalid_credits_error").hide();
    });


    $("#btn_user_login").click(function(){

        error_user_email = false;
        error_user_password = false;


        check_user_email();
        check_user_password();

        var user_email = $('#user_email').val().trim();
        var user_password = $('#user_password').val().trim();

        if ($('#user_remember_me').is(':checked')) {
            var user_remember_me = $('#user_remember_me').val();
        }

        if(error_user_email == 0 && error_user_password == 0 ){

            $.ajax({
                url:'../user/user_server.php',
                method: "POST",
                data:
                    {
                        user_login_from_ajax: 1,
                        user_email:user_email,user_password:user_password,user_remember_me:user_remember_me
                    },
                success:function(response){

                    if(response.indexOf('success') >= 0){
                        $('#user_email').val("");
                        $('#user_password').val("");
                        document.getElementById("user_email").style.borderColor = "#ddd";
                        document.getElementById("user_password").style.borderColor = "#ddd";
                        location.reload();
                    }

                    if(response.indexOf('error') >= 0){
                        $("#user_invalid_credits_error").html("Λανθασμένα στοιχεία σύνδεσης");
                        $("#user_invalid_credits_error").show();
                        error_user_invalid_credits = true;
                        error_user_email = true;
                        $('#user_password').val("");
                        document.getElementById("user_email").style.borderColor = "#ddd";
                        document.getElementById("user_password").style.borderColor = "#ddd";
                    }

                    if(response.indexOf('error_login') >= 0){
                        $("#user_invalid_credits_error").html("Λανθασμένα στοιχεία σύνδεσης");
                        $("#user_invalid_credits_error").show();
                        error_user_invalid_credits = true;
                        error_user_email = true;
                        $('#user_password').val("");
                        document.getElementById("user_email").style.borderColor = "#ddd";
                        document.getElementById("user_password").style.borderColor = "#ddd";
                    }

                    if(response.indexOf('not_verified') >= 0){

                        $("#modal_login").modal('hide');
                        $('#user_email').val("");
                        $('#user_password').val("");
                        document.getElementById("user_email").style.borderColor = "#ddd";
                        document.getElementById("user_password").style.borderColor = "#ddd";

                        Swal.fire('Κάτι πήγε στραβά!', "Απ' ότι φαίνεται δεν έχετε επαληθεύσει τον λογαριασμό σας. \r"
                            + "Επαληθεύστε τον λογαριασμό σας για να πραγματοποιήσετε σύνδεση!", "error")
                            .then(function() {
                                window.location = "../user/verification/forget_verified_code.php";
                            });
                    }

                }
            });
            document.getElementById("user_email").style.borderColor = "#ddd";
            document.getElementById("user_password").style.borderColor = "#ddd";
            event.preventDefault();
            return true;

        }else{

            return false;

        }

    });


});