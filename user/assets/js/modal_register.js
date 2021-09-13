// // ---------------------- Show - Hide Password on User Register ----------------------------------//

function show_hide_password() {

    var pass = document.getElementById("user_register_password");
    if (pass.type === "password") {
        pass.type = "text";
        $("#eye").removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        pass.type = "password";
        $("#eye").removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }
}

function show_hide_confirm_password() {

    var con_pass = document.getElementById("user_register_confirm_password");
    if (con_pass.type === "password") {
        con_pass.type = "text";
        $("#eye_slash").removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        con_pass.type = "password";
        $("#eye_slash").removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }
}

$(document).ready(function(){

    /*Μολις το modal κλείσει τότε εξαφανίζεται και το το div -> class -> password_strength_container
    * το οποίο απεικονίζει την ισχύ κωδικού πρόσβαση
    * */
    $('#modal_register').on('hidden.bs.modal', function (e) {
        $('.password_strength_container').css("display","none");
    })

    //Όταν φορτώσει η σελίδα, τότε να κρυφτεί το div -> class -> password_strength_container
    //Το οποίο απεικονίζει την ισχύ κωδικού πρόσβαση

    $('.password_strength_container').css("display","none");

    // Όταν ο χρήστης πατήσει μέσα στο πεδίο "Κωδικός Πρόσβασης"
    // Τότε θα εμφανιστεί η ισχύ κωδικού πρόσβαση

    $('#user_register_password').click(function () {
        $('.password_strength_container').css("display","unset");
    });

    // Όταν ο χρήστης πατήσει μέσα στο πεδίο "Κωδικός Πρόσβασης" με τη χρήση TAB
    // Τότε θα εμφανιστεί η ισχύ κωδικού πρόσβαση

    $('#user_register_city').keydown(function(e) {
        var code = e.keyCode || e.which;

        if (code === 9) {
            $('.password_strength_container').css("display","unset");
        }
    });

    // Κρύβουμε τα errors

    $("#user_register_email_error").hide();
    $("#user_register_name_error").hide();
    $("#user_register_surname_error").hide();
    $("#user_register_phone_error").hide();
    $("#user_register_city_error").hide();
    $("#user_register_password_error").hide();
    $("#user_register_confirm_password_error").hide();

    // ------ Disable all errors ----------------//

    var error_user_register_email = false;
    var error_user_register_name = false;
    var error_user_register_surname = false;
    var error_user_register_phone = false;
    var error_user_register_city = false;
    var error_user_register_password = false;
    var error_user_register_confirm_password = false;
    var error_password_strength = false;

    function check_user_register_email(){

        var user_register_email = $("#user_register_email").val();
        var user_email_register_pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

        if(user_register_email == ""){
            $("#user_register_email_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#user_register_email_error").focus();
            $("#user_register_email_error").show();
            document.getElementById("user_register_email").style.borderColor = "red";
            error_user_register_email = true;
        }else if(user_email_register_pattern.test($("#user_register_email").val())){
            $("#user_register_email_error").hide();
            document.getElementById("user_register_email").style.borderColor = "green";
        }else{
            $("#user_register_email_error").html("Μη έγκυρη διεύθυνση email");
            $("#user_register_email_error").show();
            $("#user_register_email").focus();
            document.getElementById("user_register_email").style.borderColor = "red";
            error_user_register_email = true;
        }
    }

    $("#user_register_email").keyup(function () {
        $("#user_register_email_error").hide();
        document.getElementById("user_register_email").style.borderColor = "#ddd";
    });

    function check_user_register_name(){
        var user_register_name = $("#user_register_name").val();

        if(user_register_name == ""){
            $("#user_register_name_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#user_register_name_error").show();
            $("#user_register_name").focus();
            document.getElementById("user_register_name").style.borderColor = "red";
            error_user_register_name = true;
        }else{
            $("#user_register_name_error").hide();
            document.getElementById("user_register_name").style.borderColor = "green";
        }
    }

    $("#user_register_name").keyup(function () {
        $("#user_register_name_error").hide();
        document.getElementById("user_register_name").style.borderColor = "#ddd";
    });

    function check_user_register_surname(){
        var user_register_surname = $("#user_register_surname").val();

        if(user_register_surname == ""){
            $("#user_register_surname_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#user_register_surname_error").show();
            $("#user_register_surname").focus();
            document.getElementById("user_register_surname").style.borderColor = "red";
            error_user_register_surname = true;
        }else{
            $("#user_register_surname_error").hide();
            document.getElementById("user_register_surname").style.borderColor = "green";
        }
    }

    $("#user_register_surname").keyup(function () {
        $("#user_register_surname_error").hide();
        document.getElementById("user_register_surname").style.borderColor = "#ddd";
    });

    function check_user_register_phone(){

        var user_register_phone = $("#user_register_phone").val();
        var user_phone_pattern = new RegExp(/^[0-9]\d{9}$/);

        if(user_register_phone == ""){
            $("#user_register_phone_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#user_register_phone_error").show();
            $("#user_register_phone").focus();
            document.getElementById("user_register_phone").style.borderColor = "red";
            error_user_register_phone = true;
        }else if(user_phone_pattern.test($("#user_register_phone").val())){
            $("#user_register_phone_error").hide();
            document.getElementById("user_register_phone").style.borderColor = "green";
        }else{
            $("#user_register_phone_error").html("Μη έγκυρος αριθμός κινητού");
            $("#user_register_phone_error").show();
            $("#user_register_phone").focus();
            document.getElementById("user_register_phone").style.borderColor = "red";
            error_user_register_phone = true;
        }
    }

    $("#user_register_phone").keyup(function () {
        $("#user_register_phone_error").hide();
        document.getElementById("user_register_phone").style.borderColor = "#ddd";
    });

    function check_user_register_city(){
        var user_register_city = $("#user_register_city").val();

        if(user_register_city == 0){
            $("#user_register_city_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#user_register_city").focus();
            $("#user_register_city_error").show();
            document.getElementById("user_register_city").style.borderColor = "red";
            error_user_register_city = true;
        }else{
            $("#user_register_city_error").hide();
            document.getElementById("user_register_city").style.borderColor = "green";
        }
    }

    $("#user_register_city").change(function () {
        $("#user_register_city_error").hide();
        document.getElementById("user_register_city").style.borderColor = "#ddd";
    });

    function check_user_register_password(){

        var user_register_password = $("#user_register_password").val();

        if(user_register_password == ""){
            $("#user_register_password_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#user_register_password_error").show();
            $("#user_register_password").focus();
            document.getElementById("user_register_password").style.borderColor = "red";
            error_user_register_password = true;
        }else{
            $("#user_register_password_error").hide();
            document.getElementById("user_register_password").style.borderColor = "green";
        }
    }

    function checkStrength() {

        var strength = 0;
        var user_password = $("#user_register_password").val();
        var user_password_pattern_1 = new RegExp(/([a-z].*[A-Z])|([A-Z].*[a-z])/);
        var user_password_pattern_2 = new RegExp(/([a-zA-Z])/);
        var user_password_pattern_3 = new RegExp(/([0-9])/);
        var user_password_pattern_4 = new RegExp(/([!,%,&,@,#,$,^,*,?,_,~])/);

        if(user_password_pattern_1.test($("#user_register_password").val())){
            strength += 1;
            $('.low-upper-case').addClass('text-success');
            $('.low-upper-case i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("user_register_password").style.borderColor = "red";
        }else {
            $('.low-upper-case').removeClass('text-success');
            $('.low-upper-case i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("user_register_password").style.borderColor = "red";
        }

        if(user_password_pattern_2.test($("#user_register_password").val())){
            strength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("user_register_password").style.borderColor = "red";
        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("user_register_password").style.borderColor = "red";
        }

        if(user_password_pattern_3.test($("#user_register_password").val())){
            strength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("user_register_password").style.borderColor = "red";
        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("user_register_password").style.borderColor = "red";
        }

        if(user_password_pattern_4.test($("#user_register_password").val())){
            strength += 1;
            $('.one-special-char').addClass('text-success');
            $('.one-special-char i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("user_register_password").style.borderColor = "red";

        } else {
            $('.one-special-char').removeClass('text-success');
            $('.one-special-char i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("user_register_password").style.borderColor = "red";
        }

        if (user_password.length > 7) {
            strength += 1;
            $('.eight-character').addClass('text-success');
            $('.eight-character i').removeClass('fa-times').addClass('fa-check');
            error_password_strength  = true;
            document.getElementById("user_register_password").style.borderColor = "red";

        } else {
            $('.eight-character').removeClass('text-success');
            $('.eight-character i').addClass('fa-times').removeClass('fa-check');
            error_password_strength  = true;
            document.getElementById("user_register_password").style.borderColor = "red";
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
            document.getElementById("user_register_password").style.borderColor = "green";
            error_password_strength  = false;
            return 'Strong'
        }
    }

    $("#user_register_password").keyup(function () {

        $("#user_register_password_error").hide();
        document.getElementById("user_register_password").style.borderColor = "#ddd";
        checkStrength();
    });

    function check_user_register_confirm_password(){

        var user_register_password = $("#user_register_password").val();
        var user_register_confirm_password = $("#user_register_confirm_password").val();

        if(user_register_confirm_password == ""){
            $("#user_register_confirm_password_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#user_register_confirm_password_error").show();
            $("#user_register_confirm_password").focus();
            document.getElementById("user_register_confirm_password").style.borderColor = "red";
            error_user_register_confirm_password = true;
        }else if (user_register_password != user_register_confirm_password){
            $("#user_register_confirm_password_error").html("Οι κωδικοί δε ταιριάζουν");
            $("#user_register_confirm_password_error").show();
            $("#user_register_confirm_password").focus();
            document.getElementById("user_register_confirm_password").style.borderColor = "red";
            error_user_register_confirm_password = true;
        }else{
            $("#user_register_confirm_password_error").hide();
            document.getElementById("user_register_confirm_password").style.borderColor = "green";
        }

    }

    $("#user_register_confirm_password").keyup(function () {
        $("#user_register_confirm_password_error").hide();
        document.getElementById("user_register_confirm_password").style.borderColor = "#ddd";
    });



    $('#btn_register_user').click(function () {

        error_user_register_email = false;
        error_user_register_name = false;
        error_user_register_surname = false;
        error_user_register_phone = false;
        error_user_register_city = false;
        error_user_register_password = false;
        error_user_register_confirm_password = false;
        error_password_strength  = false;

        check_user_register_email();
        check_user_register_name();
        check_user_register_surname();
        check_user_register_phone();
        check_user_register_city();
        check_user_register_password();
        check_user_register_confirm_password();
        checkStrength();

        var user_register_email = $('#user_register_email').val().trim();
        var user_register_name = $('#user_register_name').val().trim();
        var user_register_surname = $('#user_register_surname').val().trim();
        var user_register_phone = $('#user_register_phone').val().trim();
        var user_register_city = $("#user_register_city option:selected").text();
        var user_register_password = $('#user_register_password').val().trim();

        if(error_user_register_email == 0 && error_user_register_name == 0 && error_user_register_surname == 0 &&
            error_user_register_phone == 0 && error_user_register_city == 0 && error_user_register_password == 0
            && error_user_register_confirm_password == 0 && error_password_strength == 0){

            $.ajax({
                url:'../user/user_server.php',
                type:'POST',
                data:
                    {
                        user_register_from_ajax: 1,
                        user_register_email:user_register_email,user_register_name:user_register_name,
                        user_register_surname:user_register_surname, user_register_phone:user_register_phone,
                        user_register_city:user_register_city,user_register_password:user_register_password
                    },
                success:function(response){

                    if(response.indexOf('error_user_email_exist') >= 0){
                        $("#user_register_email_error").html("Το email χρησιμοποιείται ήδη");
                        $("#user_register_email").focus();
                        $("#user_register_email_error").show();
                        document.getElementById("user_register_email").style.borderColor = "red";
                        error_user_register_email = true;
                    }else{

                        $("#modal_register").modal('hide');

                        $('#user_register_email').val("");
                        $('#user_register_name').val("");
                        $('#user_register_surname').val("");
                        $('#user_register_phone').val("");
                        $('#user_register_city').prop('selectedIndex',0);
                        $('#user_register_password').val("");
                        $('#user_register_confirm_password').val("");

                        document.getElementById("user_register_email").style.borderColor = "#ddd";
                        document.getElementById("user_register_name").style.borderColor = "#ddd";
                        document.getElementById("user_register_surname").style.borderColor = "#ddd";
                        document.getElementById("user_register_phone").style.borderColor = "#ddd";
                        document.getElementById("user_register_city").style.borderColor = "#ddd";
                        document.getElementById("user_register_password").style.borderColor = "#ddd";
                        document.getElementById("user_register_confirm_password").style.borderColor = "#ddd";

                        $('#password-strength').removeClass('progress-bar bg-success');
                        $('#password-strength').css('width', '0%');
                        $('.low-upper-case i').addClass('fa-times').removeClass('fa-check');
                        $('.one-number i').addClass('fa-times').removeClass('fa-check');
                        $('.one-special-char i').addClass('fa-times').removeClass('fa-check');
                        $('.eight-character i').addClass('fa-times').removeClass('fa-check');
                        $('#result').addClass('text-warning').text('');

                        $('.password_strength_container').css("display","none");

                        Swal.fire({
                            icon: 'success',
                            title: 'Συγχαρητήρια',
                            text: "Η εγγραφή σας ολοκληρώθηκε με επιτυχία. \n\n Παρακαλώ επαληθεύστε" +
                                " τον λογαριασμό σας πατώντας τον σύνδεσμο που σας στείλαμε στο email σας!"
                        })
                            .then(function() {
                                $.ajax({
                                    url:'../user/user_server.php',
                                    type:'POST',
                                    data:
                                        {
                                            user_register_send_email_from_ajax: 1,
                                            user_register_email:user_register_email
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