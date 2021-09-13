// // ---------------------- Show - Hide Password on Groomer Login ----------------------------------//

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

$(document).ready(function(){

    // ------ Hide all errors ------------//

    $("#groomer_email_error").hide();

    $("#groomer_password_error").hide();

    $("#groomer_invalid_credits_error").hide();


    // ------ Disable all errors ----------------//

    var error_groomer_email = false;

    var error_groomer_password = false;

    var error_groomer_invalid_credits = false;


    function check_groomer_email(){

        var groomer_email = $("#groomer_email").val();
        var groomer_email_pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

        if(groomer_email == ""){
            $("#groomer_email_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#groomer_email").focus();
            $("#groomer_email_error").show();
            document.getElementById("groomer_email").style.borderColor = "red";
            error_groomer_email = true;
        }else if(groomer_email_pattern.test($("#groomer_email").val())){
            $("#groomer_email_error").hide();
            document.getElementById("groomer_email").style.borderColor = "green";
        }else{
            $("#groomer_email_error").html("Μη έγκυρη διεύθυνση email");
            $("#groomer_email_error").show();
            $("#groomer_email").focus();
            document.getElementById("groomer_email").style.borderColor = "red";
            error_groomer_email = true;
        }
    }

    $("#groomer_email").keyup(function () {
        $("#groomer_email_error").hide();
        document.getElementById("groomer_email").style.borderColor = "#ddd";
        $("#groomer_invalid_credits_error").hide();
    });


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



    /*################################# INPUT VALIDATION FOR GROOMER LOGIN #########################*/

    $("#btn_groomer_login").click(function(){

        error_groomer_email = false;
        error_groomer_password = false;


        check_groomer_email();
        check_groomer_password();


        var groomer_email = $('#groomer_email').val().trim();
        var groomer_password = $('#groomer_password').val().trim();

        if ($('#groomer_remember_me').is(':checked')) {
            var groomer_remember_me = $('#groomer_remember_me').val();
        }

        if(error_groomer_email == 0 && error_groomer_password == 0 ){

            $.ajax({
                url:'../groomer/groomer_server.php',
                method: "POST",
                data:
                    {
                        groomer_login_from_ajax: 1,
                        groomer_email:groomer_email,groomer_password:groomer_password,groomer_remember_me:groomer_remember_me
                    },
                success:function(response){

                    if(response.indexOf('success') >= 0){
                        $('#groomer_email').val("");
                        $('#groomer_password').val("");
                        document.getElementById("groomer_email").style.borderColor = "#ddd";
                        document.getElementById("groomer_password").style.borderColor = "#ddd";
                        window.location = 'groomer_dashboard/groomer_dashboard.php';
                    }

                    if(response.indexOf('error') >= 0){
                        $("#groomer_invalid_credits_error").html("Λανθασμένα στοιχεία σύνδεσης");
                        $("#groomer_invalid_credits_error").show();
                        error_groomer_invalid_credits = true;
                        error_groomer_email = true;
                        $('#groomer_password').val("");
                        document.getElementById("groomer_email").style.borderColor = "#ddd";
                        document.getElementById("groomer_password").style.borderColor = "#ddd";
                    }

                    if(response.indexOf('error_login') >= 0){
                        $("#groomer_invalid_credits_error").html("Λανθασμένα στοιχεία σύνδεσης");
                        $("#groomer_invalid_credits_error").show();
                        error_groomer_invalid_credits = true;
                        error_groomer_email = true;
                        $('#groomer_password').val("");
                        document.getElementById("groomer_email").style.borderColor = "#ddd";
                        document.getElementById("groomer_password").style.borderColor = "#ddd";
                    }

                    if(response.indexOf('not_verified') >= 0){

                        $('#groomer_email').val("");
                        $('#groomer_password').val("");
                        document.getElementById("groomer_email").style.borderColor = "#ddd";
                        document.getElementById("groomer_password").style.borderColor = "#ddd";

                        Swal.fire('Κάτι πήγε στραβά!', "Απ' ότι φαίνεται δεν έχετε επαληθεύσει τον λογαριασμό σας. \r"
                            + "Επαληθεύστε τον λογαριασμό σας για να πραγματοποιήσετε σύνδεση!", "error")
                            .then(function() {
                                window.location = "../common/forget_verified_code.php";
                            });
                    }


                },
                dataType:'text'
            });
            document.getElementById("groomer_email").style.borderColor = "#ddd";
            document.getElementById("groomer_password").style.borderColor = "#ddd";
            event.preventDefault();
            return true;

        }else{

            return false;

        }

    });

});