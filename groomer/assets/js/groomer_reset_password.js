// // ------------------------- Show - Hide Password on Groomer Reset Password -------------------------------//
function show_hide_password() {

    var pass = document.getElementById("groomer_password");
    if (pass.type === "password") {
        pass.type = "text";
        $("#eye").removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        pass.type = "password";
        $("#eye").removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }

}

function show_hide_confirm_password() {

    var con_pass = document.getElementById("groomer_confirm_password");
    if (con_pass.type === "password") {
        con_pass.type = "text";
        $("#eye_slash").removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        con_pass.type = "password";
        $("#eye_slash").removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }

}

$(document).ready(function(){

    $("#groomer_password_error").hide();

    $("#groomer_confirm_password_error").hide();

    var error_groomer_password = false;

    var error_groomer_confirm_password = false;

    function check_groomer_password(){

        var groomer_password = $("#groomer_password").val();

        if(groomer_password == ""){
            $("#groomer_password_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#groomer_password_error").show();
            $("#groomer_password").focus();
            document.getElementById("groomer_password").style.borderColor = "red";
            error_groomer_password = true;
        }else if(groomer_password.length < 8 ){
            $("#groomer_password_error").html("Εισάγεται τουλάχιστον 8 χαρακτήρες");
            $("#groomer_password_error").show();
            $("#groomer_password").focus();
            document.getElementById("groomer_password").style.borderColor = "red";
            error_groomer_password = true;
        }else{
            $("#groomer_password_error").hide();
            document.getElementById("groomer_password").style.borderColor = "green";
        }
    }

    $("#groomer_password").keyup(function () {
        $("#groomer_password_error").hide();
        document.getElementById("groomer_password").style.borderColor = "#ddd";
        $("#groomer_invalid_credits_error").hide();
    });

    function check_groomer_confirm_password(){

        var groomer_password = $("#groomer_password").val();
        var groomer_confirm_password = $("#groomer_confirm_password").val();

        if(groomer_confirm_password == ""){
            $("#groomer_confirm_password_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#groomer_confirm_password_error").show();
            $("#groomer_confirm_password").focus();
            document.getElementById("groomer_confirm_password").style.borderColor = "red";
            error_groomer_confirm_password = true;
        }else if(groomer_confirm_password.length < 8 ){
            $("#groomer_confirm_password_error").html("Εισάγεται τουλάχιστον 8 χαρακτήρες");
            $("#groomer_confirm_password_error").show();
            $("#groomer_confirm_password").focus();
            document.getElementById("groomer_confirm_password").style.borderColor = "red";
            error_groomer_confirm_password = true;
        }else if (groomer_password != groomer_confirm_password){
            $("#groomer_confirm_password_error").html("Οι κωδικοί δε ταιριάζουν");
            $("#groomer_confirm_password_error").show();
            $("#groomer_confirm_password").focus();
            document.getElementById("groomer_confirm_password").style.borderColor = "red";
            error_groomer_confirm_password = true;
        }else{
            $("#groomer_confirm_password_error").hide();
            document.getElementById("groomer_confirm_password").style.borderColor = "green";
        }

    }

    $("#groomer_confirm_password").keyup(function () {
        $("#groomer_confirm_password_error").hide();
        document.getElementById("groomer_confirm_password").style.borderColor = "#ddd";
    });

    $("#btn_groomer_reset_pass").click(function(){

        error_groomer_password = false;
        error_groomer_confirm_password = false;

        check_groomer_password();
        check_groomer_confirm_password();

        var groomer_password = $('#groomer_password').val().trim();
        var groomer_email = $('#groomer_email').val().trim();

        if(error_groomer_password == 0 && error_groomer_confirm_password == 0){
            $.ajax({
                url:'../groomer/groomer_server.php',
                type:'POST',
                data:
                    {
                        groomer_change_pass_from_ajax: 1,
                        groomer_password:groomer_password,groomer_email:groomer_email
                    },
                success:function(response){

                    if(response.indexOf('success') >= 0){

                        $('#groomer_password').val("");
                        $('#groomer_confirm_password').val("");
                        document.getElementById("groomer_password").style.borderColor = "#ddd";
                        document.getElementById("groomer_confirm_password").style.borderColor = "#ddd";

                        Swal.fire({
                            title: "Συγχαρητήρια!",
                            text: "Ο κωδικός πρόσβασης άλλαξε με επιτυχία!",
                            icon: "success"
                        })
                            .then(function() {
                                window.location = "index.php";
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