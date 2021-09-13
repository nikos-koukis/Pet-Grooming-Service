function show_hide_current_password() {

    var con_pass = document.getElementById("current_user_password");
    if (con_pass.type === "password") {
        con_pass.type = "text";
        $("#eye").removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        con_pass.type = "password";
        $("#eye").removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }
}

function show_hide_new_password() {

    var con_pass = document.getElementById("new_user_password");
    if (con_pass.type === "password") {
        con_pass.type = "text";
        $("#eye_slash").removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        con_pass.type = "password";
        $("#eye_slash").removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }
}

function show_hide_con_password() {

    var con_pass = document.getElementById("con_user_password");
    if (con_pass.type === "password") {
        con_pass.type = "text";
        $("#eye_slash_con").removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        con_pass.type = "password";
        $("#eye_slash_con").removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }
}

$('document').ready(function () {

    $('#link_user_logout').click(function () {
        Swal.fire({
            icon: 'question',
            showCancelButton: true,
            text: "Είστε σίγουρος πως θέλετε να αποσυνδεθείτε;",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Αποσύνδεση",
            cancelButtonText: "Ακύρωση"
        }).then((result) => {
            if (result.value===true) {
                window.location = '../../user/user_logout.php';
            }
        });
    });


    //---------------- Load User Profile Data ---------------------------------//

    var user_email = $('#user_email').val();

    $.ajax({
        url:'user_server.php',
        type: 'post',
        dataType: 'JSON',
        data:{
            user_profile_from_ajax:1,
            user_email:user_email
        },
        success: function(response){
            var len = response.length;
            for(var i=0; i<len; i++){
                var user_name = response[i].name;
                var user_surname = response[i].surname;
                var user_phone = response[i].phone;
                var user_city = response[i].city;

           }

            $('#user_name').val(user_name);

            $('#user_surname').val(user_surname);

            $('#user_phone').val(user_phone);

            $('[id=user_city] option').filter(function() {
                return ($(this).text() == user_city);
            }).prop('selected', true);

        }
    });



    // ------ Hide errors ------//

    $("#profile_email_error").hide();
    $("#profile_user_name_error").hide();
    $("#profile_user_surname_error").hide();
    $("#profile_user_phone_error").hide();
    $("#profile_user_city_error").hide();

    // -- Disable all errors --//
    var error_profile_user_name = false;
    var error_profile_user_surname = false;
    var error_profile_user_phone = false;
    var error_profile_user_city = false;

    //------------------------------------------------------------------------------//
    //---------------------- Edit User Profile Name -------------------------//
    function check_profile_user_name(){

        var user_name = $("#user_name").val();

        if(user_name == ""){
            $("#profile_user_name_error").show();
            $("#profile_user_name_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#user_name").focus();
            document.getElementById("user_name").style.borderColor = "red";
            error_profile_user_name = true;
        }else{
            $("#profile_user_name_error").hide();
            document.getElementById("user_name").style.borderColor = "green";
        }
    }

    $("#user_name").keyup(function () {
        $("#profile_user_name_error").hide();
        document.getElementById("user_name").style.borderColor = "#ddd";
    });

    $('#profile_edit_user_name_btn').click(function () {

        error_profile_user_name = false;
        check_profile_user_name();

        var user_email = $('#user_email').val().trim();
        var user_name = $('#user_name').val().trim();

        if(error_profile_user_name == 0){
            $.ajax({
                url:'user_server.php',
                type: 'post',
                data:{
                    profile_edit_user_name_from_ajax:1,
                    user_name:user_name,user_email:user_email
                },
                success: function(response){
                    if(response.indexOf('success') >= 0){
                        Swal.fire({
                            icon: 'success',
                            text: "Το όνομά σας ενημερώθηκε με επιτυχία",
                            confirmButtonColor: "#b5c5ff",
                        });
                        document.getElementById("user_name").style.borderColor = "#ddd";
                    }
                }
            });
            return true;
        }else{
            return false;
        }

    });

    function check_profile_user_surname(){

        var user_surname = $("#user_surname").val();

        if(user_surname == ""){
            $("#profile_user_surname_error").show();
            $("#profile_user_surname_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#user_surname").focus();
            document.getElementById("user_surname").style.borderColor = "red";
            error_profile_user_surname = true;
        }else{
            $("#profile_user_surname_error").hide();
            document.getElementById("user_surname").style.borderColor = "green";
        }
    }

    $("#user_surname").keyup(function () {
        $("#profile_user_surname_error").hide();
        document.getElementById("user_surname").style.borderColor = "#ddd";
    });

    $('#profile_edit_user_surname_btn').click(function () {

        error_profile_user_surname = false;
        check_profile_user_surname();

        var user_email = $('#user_email').val().trim();
        var user_surname = $('#user_surname').val().trim();

        if(error_profile_user_surname == 0){
            $.ajax({
                url:'user_server.php',
                type: 'post',
                data:{
                    profile_edit_user_surname_from_ajax:1,
                    user_surname:user_surname,user_email:user_email
                },
                success: function(response){
                    if(response.indexOf('success') >= 0){
                        Swal.fire({
                            icon: 'success',
                            text: "Το επώνυμό σας ενημερώθηκε με επιτυχία",
                            confirmButtonColor: "#b5c5ff",
                        });
                        document.getElementById("user_surname").style.borderColor = "#ddd";
                    }
                }
            });
            return true;
        }else{
            return false;
        }

    });

    function check_profile_user_phone(){

        var user_phone = $("#user_phone").val();
        var phone_pattern = new RegExp(/^[0-9]\d{9}$/);

        if(user_phone == ""){
            $("#profile_user_phone_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#profile_user_phone_error").show();
            $("#user_phone").focus();
            document.getElementById("user_phone").style.borderColor = "red";
            error_profile_user_phone = true;
        }else if(phone_pattern.test($("#user_phone").val())){
            $("#profile_user_phone_error").hide();
            document.getElementById("user_phone").style.borderColor = "green";
        }else{
            $("#profile_user_phone_error").html("Μη έγκυρος αριθμός κινητού");
            $("#profile_user_phone_error").show();
            $("#user_phone").focus();
            document.getElementById("user_phone").style.borderColor = "red";
            error_profile_user_phone = true;
        }

    }

    $("#user_phone").keyup(function () {
        $("#profile_user_phone_error").hide();
        document.getElementById("user_phone").style.borderColor = "#ddd";
    });

    $('#profile_edit_user_phone_btn').click(function () {

        error_profile_user_phone = false;
        check_profile_user_phone();

        var user_email = $('#user_email').val().trim();
        var user_phone = $('#user_phone').val().trim();

        if(error_profile_user_phone == 0){

            $.ajax({
                url:'user_server.php',
                type: 'post',
                data:{
                    profile_edit_user_phone_from_ajax:1,
                    user_phone:user_phone,user_email:user_email
                },
                success: function(response){
                    if(response.indexOf('success') >= 0){
                        Swal.fire({
                            icon: 'success',
                            text: "Το κινητό σας ενημερώθηκε με επιτυχία",
                            confirmButtonColor: "#b5c5ff",
                        });
                        document.getElementById("user_phone").style.borderColor = "#ddd";
                    }
                }
            });
            return true;
        }else{
            return false;
        }

    });

    function check_profile_user_city(){

        var user_city = $("#user_city").val();

        if(user_city == 0){
            $("#profile_user_city_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#profile_user_city_error").show();
            $("#user_city").focus();
            document.getElementById("user_city").style.borderColor = "red";
            error_profile_user_city = true;
        }else{
            $("#profile_user_city_error").hide();
            document.getElementById("user_city").style.borderColor = "green";
        }
    }

    $("#user_city").change(function () {
        $("#profile_user_city_error").hide();
        document.getElementById("user_city").style.borderColor = "#ddd";
    });

    $('#profile_edit_user_city_btn').click(function () {

        error_profile_user_city = false;
        check_profile_user_city();

        if(error_profile_user_city == 0){

            var user_email = $('#user_email').val().trim();
            var user_city = $("#user_city option:selected").text();

            $.ajax({
                url:'user_server.php',
                type: 'post',
                data:{
                    profile_edit_user_city_from_ajax:1,
                    user_city:user_city,user_email:user_email
                },
                success: function(response){
                    if(response.indexOf('success') >= 0){
                        Swal.fire({
                            icon: 'success',
                            text: "Η πόλη σας ενημερώθηκε με επιτυχία",
                            confirmButtonColor: "#b5c5ff",
                        });
                        document.getElementById("user_city").style.borderColor = "#ddd";
                    }
                }
            });
            return true;
        }else{
            return false;
        }

    });


    //------------------------------------------------------------------------------//
    //---------------------- Edit user Profile Password -------------------------//

    // ------ Hide error ------//
    $("#profile_current_user_password_error").hide();

    // -- Disable all errors --//
    var error_profile_current_user_password = false;

    function check_current_password(){

        var current_user_password = $("#current_user_password").val();

        if(current_user_password == ""){
            $("#profile_current_user_password_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#profile_current_user_password_error").show();
            $("#current_user_password").focus();
            document.getElementById("current_user_password").style.borderColor = "red";
            error_profile_current_user_password = true;
        }

    }

    $("#current_user_password").keyup(function () {
        $("#profile_current_user_password_error").hide();
        document.getElementById("current_user_password").style.borderColor = "#ddd";
    });

    //------------------------------------------------------------------------------//
    //---------------------- Edit user Profile New Password -------------------------//

    // ------ Hide error ------//
    $("#profile_new_user_password_error").hide();

    // -- Disable all errors --//
    var error_profile_new_user_password = false;

    function check_new_password(){

        var new_user_password = $("#new_user_password").val();

        if(new_user_password == ""){
            $("#profile_new_user_password_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#profile_new_user_password_error").show();
            $("#new_user_password").focus();
            document.getElementById("new_user_password").style.borderColor = "red";
            error_profile_new_user_password = true;
        }

    }

    //------------------------------------------------------------------------------//
    //---------------------- Edit user Password Strength -------------------------//

    var error_password_strength = false;

    function checkStrength() {

        var strength = 0;
        var user_password = $("#new_user_password").val();
        var user_password_pattern_1 = new RegExp(/([a-z].*[A-Z])|([A-Z].*[a-z])/);
        var user_password_pattern_2 = new RegExp(/([a-zA-Z])/);
        var user_password_pattern_3 = new RegExp(/([0-9])/);
        var user_password_pattern_4 = new RegExp(/([!,%,&,@,#,$,^,*,?,_,~])/);

        if(user_password_pattern_1.test($("#new_user_password").val())){
            strength += 1;
            $('.low-upper-case').addClass('text-success');
            $('.low-upper-case i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_user_password").style.borderColor = "red";
        }else {
            $('.low-upper-case').removeClass('text-success');
            $('.low-upper-case i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_user_password").style.borderColor = "red";
        }

        if(user_password_pattern_2.test($("#new_user_password").val())){
            strength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_user_password").style.borderColor = "red";
        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_user_password").style.borderColor = "red";
        }

        if(user_password_pattern_3.test($("#new_user_password").val())){
            strength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_user_password").style.borderColor = "red";
        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_user_password").style.borderColor = "red";
        }

        if(user_password_pattern_4.test($("#new_user_password").val())){
            strength += 1;
            $('.one-special-char').addClass('text-success');
            $('.one-special-char i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_user_password").style.borderColor = "red";

        } else {
            $('.one-special-char').removeClass('text-success');
            $('.one-special-char i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_user_password").style.borderColor = "red";
        }

        if (user_password.length > 7) {
            strength += 1;
            $('.eight-character').addClass('text-success');
            $('.eight-character i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_user_password").style.borderColor = "red";

        } else {
            $('.eight-character').removeClass('text-success');
            $('.eight-character i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_user_password").style.borderColor = "red";
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
            document.getElementById("new_user_password").style.borderColor = "green";
            error_password_strength  = false;
            return 'Strong'
        }

    }

    $("#new_user_password").keyup(function () {
        $("#profile_new_user_password_error").hide();
        document.getElementById("new_user_password").style.borderColor = "#ddd";
        checkStrength();
    });

    //------------------------------------------------------------------------------//
    //---------------------- Edit user Profile Confirm Password -------------------------//

    // ------ Hide error ------//
    $("#profile_con_password_error").hide();

    // -- Disable all errors --//
    var error_profile_con_password = false;

    function check_confirm_password(){

        var new_user_password = $("#new_user_password").val();
        var con_user_password = $("#con_user_password").val();

        if(con_user_password == "") {
            $("#profile_con_password_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#profile_con_password_error").show();
            $("#profile_con_password_error").focus();
            document.getElementById("con_user_password").style.borderColor = "red";
            error_profile_con_password = true;
        }else if (new_user_password != con_user_password){
            $("#profile_con_password_error").html("Οι κωδικοί δε ταιριάζουν");
            $("#profile_con_password_error").show();
            $("#profile_con_password_error").focus();
            document.getElementById("con_user_password").style.borderColor = "red";
            error_profile_con_password = true;
        }else{
            $("#profile_con_password_error").hide();
            document.getElementById("con_user_password").style.borderColor = "green";
            document.getElementById("new_user_password").style.borderColor = "green";
        }


    }

    $("#con_user_password").keyup(function () {
        $("#profile_con_password_error").hide();
        document.getElementById("con_user_password").style.borderColor = "#ddd";

    });

    $('#profile_change_password_btn').click(function () {

        error_profile_current_user_password = false;
        error_profile_new_user_password = false;
        error_profile_con_password = false;
        error_password_strength  = false;
        check_current_password();
        check_new_password();
        check_confirm_password();
        checkStrength();

        var email = $('#user_email').val().trim();
        var current_password = $('#current_user_password').val().trim();
        var new_password = $('#new_user_password').val().trim();

        if(error_profile_current_user_password == 0 && error_profile_new_user_password ==0 && error_profile_con_password == 0 && error_password_strength == 0){

            $.ajax({
                url:'user_server.php',
                type: 'post',
                data:{
                    user_profile_edit_current_password_from_ajax:1,
                    current_password:current_password,new_password:new_password,
                    email:email
                },
                success: function(response){
                    if(response.indexOf('error_current_password') >= 0){
                        $("#profile_current_user_password_error").html("Λανθασμένος Κωδικός Πρόσβασης");
                        $("#profile_current_user_password_error").show();
                        $("#current_user_password").focus();
                        document.getElementById("current_user_password").style.borderColor = "red";
                        error_profile_current_user_password = true;
                    }
                    if(response.indexOf('success_changed_password') >= 0){

                        $('#current_user_password').val("");
                        $('#new_user_password').val("");
                        $('#con_user_password').val("");

                        document.getElementById("current_user_password").style.borderColor = "#ddd";
                        document.getElementById("new_user_password").style.borderColor = "#ddd";
                        document.getElementById("con_user_password").style.borderColor = "#ddd";
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
                            text: "Ο κωδικός πρόσβασης άλλαξε με επιτυχία. Θα αποσυνδεθείτε για λόγους ασφαλείας"
                        }).then(function() {
                            window.location.href = './user_logout.php';
                        });
                    }
                }
            });
            return true;
        }else {
            return false;
        }

    });






});