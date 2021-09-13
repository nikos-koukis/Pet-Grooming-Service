// // ------------------------- Show - Hide Password on user Reset Password -------------------------------//
function show_hide_password() {

    var pass = document.getElementById("user_password");
    if (pass.type === "password") {
        pass.type = "text";
        $("#eye").removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        pass.type = "password";
        $("#eye").removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }

}

function show_hide_confirm_password() {

    var con_pass = document.getElementById("user_confirm_password");
    if (con_pass.type === "password") {
        con_pass.type = "text";
        $("#eye_slash").removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        con_pass.type = "password";
        $("#eye_slash").removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }

}


$(document).ready(function(){

    $("#user_password_error").hide();

    $("#user_confirm_password_error").hide();

    var error_user_password = false;

    var error_user_confirm_password = false;

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
    
    function check_user_confirm_password(){

        var user_password = $("#user_password").val();
        var user_confirm_password = $("#user_confirm_password").val();

        if(user_confirm_password == ""){
            $("#user_confirm_password_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#user_confirm_password_error").show();
            $("#user_confirm_password").focus();
            document.getElementById("user_confirm_password").style.borderColor = "red";
            error_user_confirm_password = true;
        }else if(user_confirm_password.length < 8 ){
            $("#user_confirm_password_error").html("Εισάγεται τουλάχιστον 8 χαρακτήρες");
            $("#user_confirm_password_error").show();
            $("#user_confirm_password").focus();
            document.getElementById("user_confirm_password").style.borderColor = "red";
            error_user_confirm_password = true;
        }else if (user_password != user_confirm_password){
            $("#user_confirm_password_error").html("Οι κωδικοί δε ταιριάζουν");
            $("#user_confirm_password_error").show();
            $("#user_confirm_password").focus();
            document.getElementById("user_confirm_password").style.borderColor = "red";
            error_user_confirm_password = true;
        }else{
            $("#user_confirm_password_error").hide();
            document.getElementById("user_confirm_password").style.borderColor = "green";
        }

    }

    $("#user_confirm_password").keyup(function () {
        $("#user_confirm_password_error").hide();
        document.getElementById("user_confirm_password").style.borderColor = "#ddd";
    });

    $("#btn_user_reset_pass").click(function(){

        error_user_password = false;
        error_user_confirm_password = false;

        check_user_password();
        check_user_confirm_password();

        var user_password = $('#user_password').val().trim();
        var user_email = $('#user_email').val().trim();

        if(error_user_password == 0 && error_user_confirm_password == 0){
            $.ajax({
                url:'./user_server.php',
                type:'POST',
                data:
                    {
                        user_change_pass_from_ajax: 1,
                        user_password:user_password,user_email:user_email
                    },
                success:function(response){

                    if(response.indexOf('success') >= 0){

                        $('#user_password').val("");
                        $('#user_confirm_password').val("");
                        document.getElementById("user_password").style.borderColor = "#ddd";
                        document.getElementById("user_confirm_password").style.borderColor = "#ddd";

                        Swal.fire({
                            title: "Συγχαρητήρια!",
                            text: "Ο κωδικός πρόσβασης άλλαξε με επιτυχία!",
                            icon: "success"
                        })
                            .then(function() {
                                window.location = "https://groomedoo.eu/";
                            });

                    }

                }
            });
            event.preventDefault();
            return true;
        }else{
            return false;
        }

    });



});