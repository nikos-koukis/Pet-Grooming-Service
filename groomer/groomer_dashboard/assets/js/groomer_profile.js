function show_hide_current_password() {

    var con_pass = document.getElementById("current_groomer_password");
    if (con_pass.type === "password") {
        con_pass.type = "text";
        $("#eye").removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        con_pass.type = "password";
        $("#eye").removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }

}


function show_hide_new_password() {

    var con_pass = document.getElementById("new_groomer_password");
    if (con_pass.type === "password") {
        con_pass.type = "text";
        $("#eye_slash").removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        con_pass.type = "password";
        $("#eye_slash").removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }

}

function show_hide_con_password() {

    var con_pass = document.getElementById("con_groomer_password");
    if (con_pass.type === "password") {
        con_pass.type = "text";
        $("#eye_slash_con").removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        con_pass.type = "password";
        $("#eye_slash_con").removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }

}


$('document').ready(function (){


    // window.onscroll = function() {myFunction()};
    //
    // var header = document.getElementById("main-header");
    // var sticky = header.offsetTop;
    //
    // function myFunction() {
    //     if (window.pageYOffset > sticky) {
    //         header.classList.add("sticky");
    //     } else {
    //         header.classList.remove("sticky");
    //     }
    // }

    //---------------- Load Groomer Profile Data ---------------------------------//
    var email = $('#email').val();

    $.ajax({
        url:'../../groomer/groomer_server.php',
        type: 'post',
        dataType: 'JSON',
        data:{
            groomer_profile_from_ajax:1,
            email:email
        },
        success: function(response){
            var len = response.length;
            for(var i=0; i<len; i++){
                var company = response[i].company;
                var city = response[i].city;
                var address = response[i].address;
                var postcode = response[i].postcode;
                var phone = response[i].phone;
                var afm = response[i].afm;
            }

            $('#company').val(company);

            $('[id=city] option').filter(function() {
                return ($(this).text() == city);
            }).prop('selected', true);

            $('#address').val(address);

            $('#postcode').val(postcode);

            $('#phone').val(phone);

            $('#afm').val(afm);

        }
    });

    //------------------------------------------------------------------------------//
    //---------------------- Edit Groomer Profile Company -------------------------//

    // ------ Hide error ------//
    $("#profile_company_error").hide();

    // -- Disable all errors --//
    var error_profile_company = false;

    function check_profile_company(){

        var company = $("#company").val();

        if(company == ""){
            $("#profile_company_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#company").focus();
            $("#profile_company_error").show();
            document.getElementById("company").style.borderColor = "red";
            error_profile_company = true;
        }else{
            $("#profile_company_error").hide();
            document.getElementById("company").style.borderColor = "green";
        }
    }

    $("#company").keyup(function () {
        $("#profile_company_error").hide();
        document.getElementById("company").style.borderColor = "#ddd";
    });

    $('#profile_edit_company_btn').click(function () {
        error_profile_company = false;
        check_profile_company();

        var email = $('#email').val().trim();
        var company = $('#company').val().trim();

        if(error_profile_company == 0){
            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    profile_edit_company_from_ajax:1,
                    company:company,email:email
                },
                success: function(response){
                    if(response.indexOf('success') >= 0){
                        Swal.fire({
                            icon: 'success',
                            text: "Το όνομα της εταιρείας ενημερώθηκε με επιτυχία",
                            confirmButtonColor: "#b5c5ff",
                        });
                        document.getElementById("company").style.borderColor = "#ddd";
                    }
                }
            });
            return true;
        }else{
            return false;
        }

    });

    //------------------------------------------------------------------------------//
    //---------------------- Edit Groomer Profile City -------------------------//

    // ------ Hide error ------//
    $("#profile_city_error").hide();
    // -- Disable all errors --//
    var error_profile_city = false;

    function check_profile_city(){

        var city = $("#city").val();

        if(city == 0){
            $("#profile_city_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#city").focus();
            $("#profile_city_error").show();
            document.getElementById("city").style.borderColor = "red";
            error_profile_city = true;
        }else{
            $("#profile_city_error").hide();
            document.getElementById("city").style.borderColor = "green";
        }
    }

    $("#city").change(function () {
        $("#profile_city_error").hide();
        document.getElementById("city").style.borderColor = "#ddd";
    });


    $('#profile_edit_city_btn').click(function () {

        error_profile_city = false;
        check_profile_city();

        if(error_profile_city == 0){

            var email = $('#email').val().trim();
            var city = $("#city option:selected").text();

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    profile_edit_city_from_ajax:1,
                    city:city,email:email
                },
                success: function(response){
                    if(response.indexOf('success') >= 0){
                        Swal.fire({
                            icon: 'success',
                            text: "Η πόλη ενημερώθηκε με επιτυχία",
                            confirmButtonColor: "#b5c5ff",
                        });
                        document.getElementById("city").style.borderColor = "#ddd";
                    }
                }
            });
            return true;
        }else{
            return false;
        }

    });

    //------------------------------------------------------------------------------//
    //---------------------- Edit Groomer Profile Address -------------------------//

    // ------ Hide error ------//
    $("#profile_address_error").hide();

    // -- Disable all errors --//
    var error_profile_address = false;

    function check_profile_address(){

        var address = $("#address").val();

        if(address == ""){
            $("#profile_address_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#address").focus();
            $("#profile_address_error").show();
            document.getElementById("address").style.borderColor = "red";
            error_profile_address = true;
        }else{
            $("#profile_address_error").hide();
            document.getElementById("address").style.borderColor = "green";
        }
    }

    $("#address").keyup(function () {
        $("#profile_address_error").hide();
        document.getElementById("address").style.borderColor = "#ddd";
    });

    $('#profile_edit_address_btn').click(function () {

        error_profile_address = false;
        check_profile_address();

        var email = $('#email').val().trim();
        var address = $('#address').val().trim();

        if(error_profile_address == 0){

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    profile_edit_address_from_ajax:1,
                    address:address,email:email
                },
                success: function(response){
                    if(response.indexOf('success') >= 0){
                        Swal.fire({
                            icon: 'success',
                            text: "Η διεύθυνση ενημερώθηκε με επιτυχία",
                            confirmButtonColor: "#b5c5ff",
                        });
                        document.getElementById("address").style.borderColor = "#ddd";
                    }
                }
            });
            return true;
        }else{
            return false;
        }

    });

    //------------------------------------------------------------------------------//
    //---------------------- Edit Groomer Profile Postcode -------------------------//

    // ------ Hide error ------//
    $("#profile_postcode_error").hide();

    // -- Disable all errors --//
    var error_profile_postcode = false;

    function check_profile_postcode(){

        var postcode = $("#postcode").val();
        var postcode_pattern = new RegExp(/^[0-9]\d{4}$/);

        if(postcode == ""){
            $("#profile_postcode_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#profile_postcode_error").show();
            $("#postcode").focus();
            document.getElementById("postcode").style.borderColor = "red";
            error_profile_postcode = true;
        }else if(postcode_pattern.test($("#postcode").val())){
            $("#profile_postcode_error").hide();
            document.getElementById("postcode").style.borderColor = "green";
        }else{
            $("#profile_postcode_error").html("Μη έγκυρος ταχυδρομικός κώδικας");
            $("#profile_postcode_error").show();
            $("#postcode").focus();
            document.getElementById("postcode").style.borderColor = "red";
            error_profile_postcode = true;
        }

    }

    $("#postcode").keyup(function () {
        $("#profile_postcode_error").hide();
        document.getElementById("postcode").style.borderColor = "#ddd";
    });

    $('#profile_edit_postcode_btn').click(function () {

        error_profile_postcode = false;
        check_profile_postcode();

        var email = $('#email').val().trim();
        var postcode = $('#postcode').val().trim();

        if(error_profile_postcode == 0){

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    profile_edit_postcode_from_ajax:1,
                    postcode:postcode,email:email
                },
                success: function(response){
                    if(response.indexOf('success') >= 0){
                        Swal.fire({
                            icon: 'success',
                            text: "Ο ταχυδρομικός κώδικας ενημερώθηκε με επιτυχία",
                            confirmButtonColor: "#b5c5ff",
                        });
                        document.getElementById("postcode").style.borderColor = "#ddd";
                    }
                }
            });
            return true;
        }else{
            return false;
        }

    });

    //------------------------------------------------------------------------------//
    //---------------------- Edit Groomer Profile Phone -------------------------//

    // ------ Hide error ------//
    $("#profile_phone_error").hide();

    // -- Disable all errors --//
    var error_profile_phone = false;

    function check_profile_phone(){

        var phone = $("#phone").val();
        var phone_pattern = new RegExp(/^[0-9]\d{9}$/);

        if(phone == ""){
            $("#profile_phone_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#profile_phone_error").show();
            $("#phone").focus();
            document.getElementById("phone").style.borderColor = "red";
            error_profile_phone = true;
        }else if(phone_pattern.test($("#phone").val())){
            $("#profile_phone_error").hide();
            document.getElementById("phone").style.borderColor = "green";
        }else{
            $("#profile_phone_error").html("Μη έγκυρος αριθμός κινητού");
            $("#profile_phone_error").show();
            $("#phone").focus();
            document.getElementById("phone").style.borderColor = "red";
            error_profile_phone = true;
        }

    }

    $("#phone").keyup(function () {
        $("#profile_phone_error").hide();
        document.getElementById("phone").style.borderColor = "#ddd";
    });

    $('#profile_edit_phone_btn').click(function () {

        error_profile_phone = false;
        check_profile_phone();

        var email = $('#email').val().trim();
        var phone = $('#phone').val().trim();

        if(error_profile_phone == 0){

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    profile_edit_phone_from_ajax:1,
                    phone:phone,email:email
                },
                success: function(response){
                    if(response.indexOf('success') >= 0){
                        Swal.fire({
                            icon: 'success',
                            text: "Το κινητό ενημερώθηκε με επιτυχία",
                            confirmButtonColor: "#b5c5ff",
                        });
                        document.getElementById("phone").style.borderColor = "#ddd";
                    }
                }
            });
            return true;
        }else{
            return false;
        }

    });


    //------------------------------------------------------------------------------//
    //---------------------- Edit Groomer Profile AFM -------------------------//

    // ------ Hide error ------//
    $("#profile_afm_error").hide();

    // -- Disable all errors --//
    var error_profile_afm = false;

    function check_profile_afm(){

        var afm = $("#afm").val();
        var afm_pattern = new RegExp(/^[0-9]\d{10}$/);

        if(afm == ""){
            $("#profile_afm_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#profile_afm_error").show();
            $("#afm").focus();
            document.getElementById("afm").style.borderColor = "red";
            error_profile_afm = true;
        }else if(afm_pattern.test($("#afm").val())){
            $("#profile_afm_error").hide();
            document.getElementById("afm").style.borderColor = "green";
        }else{
            $("#profile_afm_error").html("Μη έγκυρο ΑΦΜ");
            $("#profile_afm_error").show();
            $("#afm").focus();
            document.getElementById("afm").style.borderColor = "red";
            error_profile_afm = true;
        }

    }

    $("#afm").keyup(function () {
        $("#profile_afm_error").hide();
        document.getElementById("afm").style.borderColor = "#ddd";
    });

    $('#profile_edit_afm_btn').click(function () {

        error_profile_afm = false;
        check_profile_afm();

        var email = $('#email').val().trim();
        var afm = $('#afm').val().trim();

        if(error_profile_afm == 0){

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    profile_edit_afm_from_ajax:1,
                    afm:afm,email:email
                },
                success: function(response){
                    if(response.indexOf('success') >= 0){
                        Swal.fire({
                            icon: 'success',
                            text: "Το ΑΦΜ ενημερώθηκε με επιτυχία",
                            confirmButtonColor: "#b5c5ff",
                        });
                        document.getElementById("afm").style.borderColor = "#ddd";
                    }
                }
            });
            return true;
        }else{
            return false;
        }

    });

    //------------------------------------------------------------------------------//
    //---------------------- Edit Groomer Profile Password -------------------------//

    // ------ Hide error ------//
    $("#profile_current_password_error").hide();

    // -- Disable all errors --//
    var error_profile_current_password = false;

    function check_current_password(){

        var current_groomer_password = $("#current_groomer_password").val();

        if(current_groomer_password == ""){
            $("#profile_current_password_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#profile_current_password_error").show();
            $("#current_groomer_password").focus();
            document.getElementById("current_groomer_password").style.borderColor = "red";
            error_profile_current_password = true;
        }

    }

    $("#current_groomer_password").keyup(function () {
        $("#profile_current_password_error").hide();
        document.getElementById("current_groomer_password").style.borderColor = "#ddd";
    });

    //------------------------------------------------------------------------------//
    //---------------------- Edit Groomer Profile New Password -------------------------//

    // ------ Hide error ------//
    $("#profile_new_password_error").hide();

    // -- Disable all errors --//
    var error_profile_new_password = false;

    function check_new_password(){

        var new_groomer_password = $("#new_groomer_password").val();

        if(new_groomer_password == ""){
            $("#profile_new_password_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#profile_new_password_error").show();
            $("#new_groomer_password").focus();
            document.getElementById("new_groomer_password").style.borderColor = "red";
            error_profile_new_password = true;
        }

    }

    //------------------------------------------------------------------------------//
    //---------------------- Edit Groomer Password Strength -------------------------//

    var error_password_strength = false;

    function checkStrength() {

        var strength = 0;
        var groomer_password = $("#new_groomer_password").val();
        var groomer_password_pattern_1 = new RegExp(/([a-z].*[A-Z])|([A-Z].*[a-z])/);
        var groomer_password_pattern_2 = new RegExp(/([a-zA-Z])/);
        var groomer_password_pattern_3 = new RegExp(/([0-9])/);
        var groomer_password_pattern_4 = new RegExp(/([!,%,&,@,#,$,^,*,?,_,~])/);

        if(groomer_password_pattern_1.test($("#new_groomer_password").val())){
            strength += 1;
            $('.low-upper-case').addClass('text-success');
            $('.low-upper-case i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_groomer_password").style.borderColor = "red";
        }else {
            $('.low-upper-case').removeClass('text-success');
            $('.low-upper-case i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_groomer_password").style.borderColor = "red";
        }

        if(groomer_password_pattern_2.test($("#new_groomer_password").val())){
            strength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_groomer_password").style.borderColor = "red";
        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_groomer_password").style.borderColor = "red";
        }

        if(groomer_password_pattern_3.test($("#new_groomer_password").val())){
            strength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_groomer_password").style.borderColor = "red";
        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_groomer_password").style.borderColor = "red";
        }

        if(groomer_password_pattern_4.test($("#new_groomer_password").val())){
            strength += 1;
            $('.one-special-char').addClass('text-success');
            $('.one-special-char i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_groomer_password").style.borderColor = "red";

        } else {
            $('.one-special-char').removeClass('text-success');
            $('.one-special-char i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_groomer_password").style.borderColor = "red";
        }

        if (groomer_password.length > 7) {
            strength += 1;
            $('.eight-character').addClass('text-success');
            $('.eight-character i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_groomer_password").style.borderColor = "red";

        } else {
            $('.eight-character').removeClass('text-success');
            $('.eight-character i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("new_groomer_password").style.borderColor = "red";
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
            document.getElementById("new_groomer_password").style.borderColor = "green";
            error_password_strength  = false;
            return 'Strong'
        }

    }

    $("#new_groomer_password").keyup(function () {
        $("#profile_new_password_error").hide();
        document.getElementById("new_groomer_password").style.borderColor = "#ddd";

        checkStrength();
    });


    //------------------------------------------------------------------------------//
    //---------------------- Edit Groomer Profile Confirm Password -------------------------//

    // ------ Hide error ------//
    $("#profile_con_password_error").hide();

    // -- Disable all errors --//
    var error_profile_con_password = false;

    function check_confirm_password(){

        var new_groomer_password = $("#new_groomer_password").val();
        var con_groomer_password = $("#con_groomer_password").val();

        if(con_groomer_password == "") {
            $("#profile_con_password_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#profile_con_password_error").show();
            $("#profile_con_password_error").focus();
            document.getElementById("con_groomer_password").style.borderColor = "red";
            error_profile_con_password = true;
        }else if (new_groomer_password != con_groomer_password){
            $("#profile_con_password_error").html("Οι κωδικοί δε ταιριάζουν");
            $("#profile_con_password_error").show();
            $("#profile_con_password_error").focus();
            document.getElementById("con_groomer_password").style.borderColor = "red";
            error_profile_con_password = true;
        }else{
            $("#profile_con_password_error").hide();
            document.getElementById("con_groomer_password").style.borderColor = "green";
            document.getElementById("new_groomer_password").style.borderColor = "green";
        }


    }

    $("#con_groomer_password").keyup(function () {
        $("#profile_con_password_error").hide();
        document.getElementById("con_groomer_password").style.borderColor = "#ddd";

    });



    $('#profile_change_password_btn').click(function () {

        error_profile_current_password = false;
        error_profile_new_password = false;
        error_profile_con_password = false;
        error_password_strength  = false;
        check_current_password();
        check_new_password();
        check_confirm_password();
        checkStrength();

        var email = $('#email').val().trim();
        var current_password = $('#current_groomer_password').val().trim();
        var new_password = $('#new_groomer_password').val().trim();

        if(error_profile_current_password == 0 && error_profile_new_password ==0 && error_profile_con_password == 0 && error_password_strength == 0){

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    profile_edit_current_password_from_ajax:1,
                    current_password:current_password,new_password:new_password,
                    email:email
                },
                success: function(response){
                    if(response.indexOf('error_current_password') >= 0){
                        $("#profile_current_password_error").html("Λανθασμένος Κωδικός Πρόσβασης");
                        $("#current_groomer_password").focus();
                        $("#profile_current_password_error").show();
                        document.getElementById("current_groomer_password").style.borderColor = "red";
                        error_profile_current_password = true;
                    }
                    if(response.indexOf('success_changed_password') >= 0){

                        $('#current_groomer_password').val("");
                        $('#new_groomer_password').val("");
                        $('#con_groomer_password').val("");

                        document.getElementById("current_groomer_password").style.borderColor = "#ddd";
                        document.getElementById("new_groomer_password").style.borderColor = "#ddd";
                        document.getElementById("con_groomer_password").style.borderColor = "#ddd";
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
                            text: "Ο κωδικός σας πρόσβασης άλλαξε με επιτυχία"
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