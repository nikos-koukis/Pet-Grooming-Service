// // ---------------------- Show - Hide Password on Groomer Register ----------------------------------//

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

    // ------ Hide all errors ------------//

    $("#groomer_email_error").hide();

    $("#groomer_company_error").hide();

    $("#groomer_city_error").hide();

    $("#groomer_address_error").hide();

    $("#groomer_postcode_error").hide();

    $("#groomer_phone_error").hide();

    $("#groomer_afm_error").hide();

    $("#groomer_password_error").hide();

    $("#groomer_confirm_password_error").hide();

    // ------ Disable all errors ----------------//

    var error_groomer_email = false;

    var error_groomer_company = false;

    var error_groomer_phone = false;

    var error_groomer_afm = false;

    var error_groomer_address = false;

    var error_groomer_city = false;

    var error_groomer_postcode = false;

    var error_groomer_password = false;

    var error_groomer_confirm_password = false;

    var error_password_strength = false;


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

    function check_groomer_company(){
        var groomer_company = $("#groomer_company").val();

        if(groomer_company == ""){
            $("#groomer_company_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#groomer_company").focus();
            $("#groomer_company_error").show();
            document.getElementById("groomer_company").style.borderColor = "red";
            error_groomer_company = true;
        }else{
            $("#groomer_company_error").hide();
            document.getElementById("groomer_company").style.borderColor = "green";
        }
    }

    $("#groomer_company").keyup(function () {
        $("#groomer_company_error").hide();
        document.getElementById("groomer_company").style.borderColor = "#ddd";
    });

    function check_groomer_phone(){

        var groomer_phone = $("#groomer_phone").val();
        var groomer_phone_pattern = new RegExp(/^[0-9]\d{9}$/);

        if(groomer_phone == ""){
            $("#groomer_phone_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#groomer_phone_error").show();
            $("#groomer_phone").focus();
            document.getElementById("groomer_phone").style.borderColor = "red";
            error_groomer_phone = true;
        }else if(groomer_phone_pattern.test($("#groomer_phone").val())){
            $("#groomer_phone_error").hide();
            document.getElementById("groomer_phone").style.borderColor = "green";
        }else{
            $("#groomer_phone_error").html("Μη έγκυρος αριθμός κινητού");
            $("#groomer_phone_error").show();
            $("#groomer_phone").focus();
            document.getElementById("groomer_phone").style.borderColor = "red";
            error_groomer_phone = true;
        }

    }

    $("#groomer_phone").keyup(function () {
        $("#groomer_phone_error").hide();
        document.getElementById("groomer_phone").style.borderColor = "#ddd";
    });

    function check_groomer_afm(){

        var groomer_afm = $("#groomer_afm").val();
        var groomer_afm_pattern = new RegExp(/^[0-9]\d{10}$/);

        if(groomer_afm == ""){
            $("#groomer_afm_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#groomer_afm_error").show();
            $("#groomer_afm").focus();
            document.getElementById("groomer_afm").style.borderColor = "red";
            error_groomer_afm = true;
        }else if(groomer_afm_pattern.test($("#groomer_afm").val())){
            $("#groomer_afm_error").hide();
            document.getElementById("groomer_afm").style.borderColor = "green";
        }else{
            $("#groomer_afm_error").html("Μη έγκυρο ΑΦΜ");
            $("#groomer_afm_error").show();
            $("#groomer_afm").focus();
            document.getElementById("groomer_afm").style.borderColor = "red";
            error_groomer_afm = true;
        }

    }

    $("#groomer_afm").keyup(function () {
        $("#groomer_afm_error").hide();
        document.getElementById("groomer_afm").style.borderColor = "#ddd";
    });

    function check_groomer_address(){
        var groomer_address = $("#groomer_address").val();

        if(groomer_address == ""){
            $("#groomer_address_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#groomer_address").focus();
            $("#groomer_address_error").show();
            document.getElementById("groomer_address").style.borderColor = "red";
            error_groomer_address = true;
        }else{
            $("#groomer_address_error").hide();
            document.getElementById("groomer_address").style.borderColor = "green";
        }
    }

    $("#groomer_address").keyup(function () {
        $("#groomer_address_error").hide();
        document.getElementById("groomer_address").style.borderColor = "#ddd";
    });

    function check_groomer_city(){
        var groomer_city = $("#groomer_city").val();

        if(groomer_city == 0){
            $("#groomer_city_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#groomer_city").focus();
            $("#groomer_city_error").show();
            document.getElementById("groomer_city").style.borderColor = "red";
            error_groomer_city = true;
        }else{
            $("#groomer_city_error").hide();
            document.getElementById("groomer_city").style.borderColor = "green";
        }
    }

    $("#groomer_city").change(function () {
        $("#groomer_city_error").hide();
        document.getElementById("groomer_city").style.borderColor = "#ddd";
    });

    function check_groomer_postcode(){

        var groomer_postcode = $("#groomer_postcode").val();
        var groomer_postcode_pattern = new RegExp(/^[0-9]\d{4}$/);

        if(groomer_postcode == ""){
            $("#groomer_postcode_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#groomer_postcode_error").show();
            $("#groomer_postcode").focus();
            document.getElementById("groomer_postcode").style.borderColor = "red";
            error_groomer_postcode = true;
        }else if(groomer_postcode_pattern.test($("#groomer_postcode").val())){
            $("#groomer_postcode_error").hide();
            document.getElementById("groomer_postcode").style.borderColor = "green";
        }else{
            $("#groomer_postcode_error").html("Μη έγκυρος ταχυδρομικός κώδικας");
            $("#groomer_postcode_error").show();
            $("#groomer_postcode").focus();
            document.getElementById("groomer_postcode").style.borderColor = "red";
            error_groomer_postcode = true;
        }

    }

    $("#groomer_postcode").keyup(function () {
        $("#groomer_postcode_error").hide();
        document.getElementById("groomer_postcode").style.borderColor = "#ddd";
    });

    function check_groomer_password(){

        var groomer_password = $("#groomer_password").val();

        if(groomer_password == ""){
            $("#groomer_password_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#groomer_password_error").show();
            $("#groomer_password").focus();
            document.getElementById("groomer_password").style.borderColor = "red";
            error_groomer_password = true;
        }else{
            $("#groomer_password_error").hide();
            document.getElementById("groomer_password").style.borderColor = "green";
        }
    }

    function checkStrength() {

        var strength = 0;
        var groomer_password = $("#groomer_password").val();
        var groomer_password_pattern_1 = new RegExp(/([a-z].*[A-Z])|([A-Z].*[a-z])/);
        var groomer_password_pattern_2 = new RegExp(/([a-zA-Z])/);
        var groomer_password_pattern_3 = new RegExp(/([0-9])/);
        var groomer_password_pattern_4 = new RegExp(/([!,%,&,@,#,$,^,*,?,_,~])/);

        if(groomer_password_pattern_1.test($("#groomer_password").val())){
            strength += 1;
            $('.low-upper-case').addClass('text-success');
            $('.low-upper-case i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("groomer_password").style.borderColor = "red";
        }else {
            $('.low-upper-case').removeClass('text-success');
            $('.low-upper-case i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("groomer_password").style.borderColor = "red";
        }

        if(groomer_password_pattern_2.test($("#groomer_password").val())){
            strength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("groomer_password").style.borderColor = "red";
        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("groomer_password").style.borderColor = "red";
        }

        if(groomer_password_pattern_3.test($("#groomer_password").val())){
            strength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("groomer_password").style.borderColor = "red";
        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("groomer_password").style.borderColor = "red";
        }

        if(groomer_password_pattern_4.test($("#groomer_password").val())){
            strength += 1;
            $('.one-special-char').addClass('text-success');
            $('.one-special-char i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("groomer_password").style.borderColor = "red";

        } else {
            $('.one-special-char').removeClass('text-success');
            $('.one-special-char i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("groomer_password").style.borderColor = "red";
        }

        if (groomer_password.length > 7) {
            strength += 1;
            $('.eight-character').addClass('text-success');
            $('.eight-character i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("groomer_password").style.borderColor = "red";

        } else {
            $('.eight-character').removeClass('text-success');
            $('.eight-character i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("groomer_password").style.borderColor = "red";
        }

        if (strength < 2) {
            $('#result').removeClass()
            $('#password-strength').addClass('progress-bar bg-danger');
            $('#result').addClass('text-danger').text('Πολύ αδύναμος');
            $('#password-strength').css('width', '20%');
        } else if (strength == 4) {
            $('#result').addClass('good');
            $('#password-strength').removeClass('progress-bar bg-danger');
            $('#password-strength').addClass('progress-bar bg-warning');
            $('#result').addClass('text-warning').text('Αδύναμος')
            $('#password-strength').css('width', '50%');
            return 'Week'
        } else if (strength == 5) {
            $('#result').removeClass()
            $('#result').addClass('strong');
            $('#password-strength').removeClass('progress-bar bg-warning');
            $('#password-strength').addClass('progress-bar bg-success');
            $('#result').addClass('text-success').text('Δυνατός');
            $('#password-strength').css('width', '100%');
            document.getElementById("groomer_password").style.borderColor = "green";
            error_password_strength  = false;
            return 'Strong'
        }

    }

    $("#groomer_password").keyup(function () {

        $("#groomer_password_error").hide();
        document.getElementById("groomer_password").style.borderColor = "#ddd";
        $("#groomer_invalid_credits_error").hide();

        checkStrength();

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

    $("#btn_register_groomer").click(function(){

        error_groomer_email = false;
        error_groomer_company = false;
        error_groomer_phone = false;
        error_groomer_afm = false;
        error_groomer_address = false;
        error_groomer_city = false;
        error_groomer_postcode = false;
        error_groomer_password = false;
        error_groomer_confirm_password = false;
        error_password_strength  = false;

        check_groomer_email();
        check_groomer_company();
        check_groomer_phone();
        check_groomer_afm();
        check_groomer_address();
        check_groomer_city();
        check_groomer_postcode();
        check_groomer_password();
        check_groomer_confirm_password();
        checkStrength();

        var groomer_email = $('#groomer_email').val().trim();
        var groomer_company = $('#groomer_company').val().trim();
        var groomer_phone = $('#groomer_phone').val().trim();
        var groomer_afm = $('#groomer_afm').val().trim();
        var groomer_address = $('#groomer_address').val().trim();
        var groomer_city = $("#groomer_city option:selected").text();
        var groomer_postcode = $('#groomer_postcode').val().trim();
        var groomer_password = $('#groomer_password').val().trim();

        if(error_groomer_email == 0 && error_groomer_company == 0 && error_groomer_phone == 0
            && error_groomer_afm == 0 && error_groomer_address == 0 && error_groomer_city == 0
            && error_groomer_postcode == 0 && error_groomer_password == 0 && error_groomer_confirm_password == 0 && error_password_strength == 0){

            $.ajax({
                url:'../groomer/groomer_server.php',
                type:'POST',
                data:
                    {
                        groomer_register_from_ajax: 1,
                        groomer_email:groomer_email,groomer_company:groomer_company,groomer_phone:groomer_phone,
                        groomer_afm:groomer_afm,groomer_address:groomer_address,
                        groomer_city:groomer_city,groomer_postcode:groomer_postcode,groomer_password:groomer_password
                    },
                success:function(response){

                    if(response.indexOf('error_groomer_email_exist') >= 0){
                        $("#groomer_email_error").html("Το email χρησιμοποιείται ήδη");
                        $("#groomer_email").focus();
                        $("#groomer_email_error").show();
                        document.getElementById("groomer_email").style.borderColor = "red";
                        error_groomer_email = true;
                    }else{

                        $('#groomer_email').val("");
                        $('#groomer_company').val("");
                        $('#groomer_phone').val("");
                        $('#groomer_afm').val("");
                        $('#groomer_address').val("");
                        $('#groomer_city').prop('selectedIndex',0);
                        $('#groomer_postcode').val("");
                        $('#groomer_password').val("");
                        $('#groomer_confirm_password').val("");

                        document.getElementById("groomer_email").style.borderColor = "#ddd";
                        document.getElementById("groomer_company").style.borderColor = "#ddd";
                        document.getElementById("groomer_phone").style.borderColor = "#ddd";
                        document.getElementById("groomer_afm").style.borderColor = "#ddd";
                        document.getElementById("groomer_address").style.borderColor = "#ddd";
                        document.getElementById("groomer_city").style.borderColor = "#ddd";
                        document.getElementById("groomer_postcode").style.borderColor = "#ddd";
                        document.getElementById("groomer_password").style.borderColor = "#ddd";
                        document.getElementById("groomer_confirm_password").style.borderColor = "#ddd";
                        $('#password-strength').removeClass('progress-bar bg-success');
                        $('#password-strength').css('width', '0%');
                        $('.low-upper-case i').addClass('fa-times').removeClass('fa-check');
                        $('.one-number i').addClass('fa-times').removeClass('fa-check');
                        $('.one-special-char i').addClass('fa-times').removeClass('fa-check');
                        $('.eight-character i').addClass('fa-times').removeClass('fa-check');
                        $('#result').addClass('text-warning').text('');

                        Swal.fire({
                            icon: 'success',
                            title: 'Συγχαρητήρια',
                            text: "Η εγγραφή σας ολοκληρώθηκε με επιτυχία. \n\n Παρακαλώ επαληθεύστε" +
                                " τον λογαριασμό σας πατώντας τον σύνδεσμο που σας στείλαμε στο email σας!",
                            footer: '<a href="index.php">Συνδέσου</a>'

                        }).then(function() {
                            $.ajax({
                                url:'../groomer/groomer_server.php',
                                type:'POST',
                                data:
                                    {
                                        groomer_register_send_email_from_ajax: 1,
                                        groomer_email:groomer_email
                                    },
                                success:function(response){

                                }
                            });
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