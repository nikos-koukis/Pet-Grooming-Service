$(document).ready(function(){

    $("#groomer_email_error").hide();

    var error_groomer_email = false;

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


    $("#btn_groomer_forget_pass").click(function(){

        error_groomer_email = false;

        check_groomer_email();

        var groomer_email = $('#groomer_email').val().trim();

        if(error_groomer_email == 0 ){

            $.ajax({
                url:'../groomer/groomer_server.php',
                method: "POST",
                data:
                    {
                        groomer_forget_pass_from_ajax: 1,
                        groomer_email:groomer_email
                    },
                success:function(response){

                    if(response.indexOf('error') >= 0){
                        $("#groomer_email_error").html("Δεν υπάρχει καταχώρηση με αυτό το email");
                        $("#groomer_email_error").show();
                        document.getElementById("groomer_email").style.borderColor = "red";
                        error_groomer_email = true;
                    }else{

                        $('#groomer_email').val("");
                        document.getElementById("groomer_email").style.borderColor = "#ddd";

                        Swal.fire({
                            title: "Συγχαρητήρια!",
                            text: "'Ενας σύνδεσμος επαναφοράς κωδικού πρόσβασης στάλθηκε στο email σας!",
                            icon: "success"
                        })
                            .then(function() {
                                $.ajax({
                                    url:'../groomer/groomer_server.php',
                                    type:'POST',
                                    data:
                                        {
                                            groomer_forget_pass_send_email_from_ajax: 1,
                                            groomer_email:groomer_email
                                        },
                                    success:function(response){

                                    }
                                });
                            });
                    }
                },
                dataType:'text'
            });

            event.preventDefault();
            return true;
        }else{
            return false;
        }

    });


})