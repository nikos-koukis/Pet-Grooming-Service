$(document).ready(function(){

    $("#user_email_error").hide();

    var error_user_email = false;

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

    $("#btn_resend_verified_email").click(function(){

        error_user_email = false;

        check_user_email();

        var user_email = $('#user_email').val().trim();

        if(error_user_email == 0){

            $.ajax({
                url:'../user_server.php',
                type:'POST',
                data:
                    {
                        forget_verified_code_from_ajax: 1,
                        user_email:user_email
                    },
                success:function(response){

                    if(response.indexOf('error') >= 0){
                        $("#user_email_error").html("Δεν υπάρχει καταχώρηση με αυτό το email");
                        $("#user_email_error").show();
                        document.getElementById("user_email").style.borderColor = "red";
                        error_user_email = true;
                    }else{

                        $('#user_email').val("");
                        document.getElementById("user_email").style.borderColor = "#ddd";

                        Swal.fire({
                            icon: 'success',
                            title: "Συγχαρητήρια!",
                            text: "'Ενας σύνδεσμος επαναφοράς κωδικού επαλήθευσης λογαριασμού στάλθηκε στο email σας!"
                        })
                            .then(function() {
                                $.ajax({
                                    url:'../user_server.php',
                                    type:'POST',
                                    data:
                                        {
                                            forget_verified_code_send_email_from_ajax:1,
                                            user_email:user_email
                                        },
                                    success:function(response){

                                    }
                                });
                            });
                    }
                }
            });
            return true;

        }else{
            return false;
        }


    });






});