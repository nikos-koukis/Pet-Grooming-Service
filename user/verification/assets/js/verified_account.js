$(document).ready(function(){

    $("#verified_code_error").hide();

    var error_verified_code = false;


    function check_verified_code(){

        var verified_code = $("#verified_code").val();
        var verified_code_pattern = new RegExp(/^[0-9]\d{5}$/);


        if(verified_code == ""){
            $("#verified_code_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#verified_code_error").show();
            $("#verified_code").focus();
            document.getElementById("verified_code").style.borderColor = "red";
            error_verified_code = true;
        }else if(verified_code_pattern.test($("#verified_code").val())){
            $("#verified_code_error").hide();
            document.getElementById("verified_code").style.borderColor = "green";
        }else{
            $("#verified_code_error").html("Μη έγκυρος κωδικός");
            $("#verified_code_error").show();
            $("#verified_code").focus();
            document.getElementById("verified_code").style.borderColor = "red";
            error_verified_code = true;
        }

    }


    $("#verified_code").keyup(function () {
        $("#verified_code_error").hide();
        document.getElementById("verified_code").style.borderColor = "#ddd";
        $("#verified_code_error").hide();
    });


    $("#btn_vierfied_account").click(function(){

        error_verified_code = false;

        check_verified_code();

        var verified_email = $('#verified_email').val().trim();
        var verified_code = $('#verified_code').val().trim();

        if(error_verified_code == 0){

            console.log(verified_email);
            console.log(verified_code);

            $.ajax({
                url:'../user_server.php',
                method: "POST",
                data:
                    {
                        verification: 1,
                        verified_email:verified_email,verified_code:verified_code
                    },
                success:function(response){

                    if(response.indexOf('dont match') >= 0){
                        $("#verified_code_error").html("Λανθασμένος κωδικός. Προσπαθήστε ξανά");
                        $("#verified_code").focus();
                        $("#verified_code_error").show();
                        document.getElementById("verified_code").style.borderColor = "red";
                        error_verified_code = true;
                    }

                    if(response.indexOf('success') >= 0){

                        $("#verified_code").val("");
                        document.getElementById("verified_code").style.borderColor = "#ddd";

                        Swal.fire({
                            icon: 'success',
                            title: "Συγχαρητήρια!",
                            text: "Ο λογοριασμός σας επαληθεύτηκε με επιτυχία",

                        }).then(function() {
                            window.location = "https://groomedoo.eu/";
                        });

                    }

                },
                dataType:'text'
            });

            return true;

        }else{
            return false;
        }

    });



});