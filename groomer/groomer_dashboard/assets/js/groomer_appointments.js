$(document).ready(function () {

    /* Function που μας επιτρέπει να τραβήξουμε δεδομένα από το URL*/
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

    //Ελέγχουμε αν κάποια ώρα είναι ήδη κλεισμένη ώστε να απενεργοποιήσουμε το κουμπί

    var groomer_id = $('#session_groomer_id').val();
    var date = getUrlParameter('date');

    $.ajax({
        url:'../../groomer/groomer_server.php',
        type: 'post',
        dataType: 'JSON',
        data:{
            disable_appointment:1,
            date:date,groomer_id:groomer_id
        },
        success: function(response){
            var len = response.length;
            for(var i=0; i<len; i++){
                var time = response[i].appointment_time;
                $('.appointment_button[value="'+ time +'"]').prop("disabled", true);
            }
        }
    });

    var date = getUrlParameter('date');

    var d = new Date($('#choose_date_for_appointment').val(date));


    // ------ Hide error ------//
    $("#appointment_choose_date_error").hide();

    // -- Disable all errors --//
    var error_appointment_choose_date = false;

    var d = new Date();
    var currentDate = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ("0" + (d.getDate() )).slice(-2);

    function check_appointment_choose_date(){

        var appointment_choose_date = $("#choose_date_for_appointment").val();

        if(appointment_choose_date == ""){
            $("#appointment_choose_date_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#appointment_choose_date_error").show();
            document.getElementById("choose_date_for_appointment").style.borderColor = "red";
            error_appointment_choose_date = true;
        }else if(currentDate > appointment_choose_date){
            $("#appointment_choose_date_error").html("Μη έγκυρη ημερομηνία");
            $("#appointment_choose_date_error").show();
            document.getElementById("choose_date_for_appointment").style.borderColor = "red";
            error_appointment_choose_date = true;
        }else{
            $("#appointment_choose_date_error").hide();
            document.getElementById("choose_date_for_appointment").style.borderColor = "green";
        }
    }

    $("#choose_date_for_appointment").change(function () {
        $("#appointment_choose_date_error").hide();
        document.getElementById("choose_date_for_appointment").style.borderColor = "#ddd";
    });


    $('#choose_date_for_appointment_btn').click(function () {

        error_appointment_choose_date = false;
        check_appointment_choose_date();

        if(error_appointment_choose_date == 0) {

            var date = $('#choose_date_for_appointment').val();
            window.location = 'groomer_appointments.php?date=' + date;
        }

    });

    $( ".appointment_button" ).each(function() {
        $(this).on("click", function(){
            var value = $(this).attr('data-target');

            $('.appointment_modal').prop('id',value.substr(1));
            $(".modal-body .edit_appointment_time").text($(this).val());

            //Validate Form
            $("#modal_error_email").hide();
            $("#modal_error_name").hide();
            $("#modal_error_surname").hide();
            $("#modal_error_phone").hide();

            var error_email = false;
            var error_name = false;
            var error_surname = false;
            var error_phone = false;


            $('.appointment_modal').on('hidden.bs.modal', function (e) {
                error_email = false;
                error_name = false;
                error_surname = false;
                error_phone = false;
                document.getElementById("client_email").style.borderColor = "#ddd";
                document.getElementById("client_name").style.borderColor = "#ddd";
                document.getElementById("client_surname").style.borderColor = "#ddd";
                document.getElementById("client_phone").style.borderColor = "#ddd";
            })

            function check_modal_email(){

                var modal_email = $("#client_email").val();
                var modal_email_pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

                if(modal_email == ""){
                    $("#modal_error_email").html("Το πεδίο είναι υποχρεωτικό");
                    $("#modal_error_email").show();
                    $("#client_email").focus();
                    document.getElementById("client_email").style.borderColor = "red";
                    error_email = true;
                }else if(modal_email_pattern.test($("#client_email").val())){
                    $("#modal_error_email").hide();
                    document.getElementById("client_email").style.borderColor = "green";
                }else{
                    $("#modal_error_email").html("Μη έγκυρη διεύθυνση email");
                    $("#modal_error_email").show();
                    $("#client_email").focus();
                    document.getElementById("client_email").style.borderColor = "red";
                    error_email = true;
                }
            }

            $("#client_email").keyup(function () {
                $("#modal_error_email").hide();
                document.getElementById("client_email").style.borderColor = "#ddd";
            });

            function check_modal_name(){
                var modal_name = $("#client_name").val();

                if(modal_name == ""){
                    $("#modal_error_name").html("Το πεδίο είναι υποχρεωτικό");
                    $("#modal_error_name").show();
                    $("#client_name").focus();
                    document.getElementById("client_name").style.borderColor = "red";
                    error_name = true;
                }else{
                    $("#modal_error_name").hide();
                    document.getElementById("client_name").style.borderColor = "green";
                }
            }

            $("#client_name").keyup(function () {
                $("#modal_error_name").hide();
                document.getElementById("client_name").style.borderColor = "#ddd";
            });

            function check_modal_surname(){
                var modal_surname = $("#client_surname").val();

                if(modal_surname == ""){
                    $("#modal_error_surname").html("Το πεδίο είναι υποχρεωτικό");
                    $("#modal_error_surname").show();
                    $("#client_surname").focus();
                    document.getElementById("client_surname").style.borderColor = "red";
                    error_surname = true;
                }else{
                    $("#modal_error_surname").hide();
                    document.getElementById("client_surname").style.borderColor = "green";
                }
            }

            $("#client_surname").keyup(function () {
                $("#modal_error_surname").hide();
                document.getElementById("client_surname").style.borderColor = "#ddd";
            });

            function check_modal_phone(){

                var modal_phone = $("#client_phone").val();
                var modal_phone_pattern = new RegExp(/^[0-9]\d{9}$/);

                if(modal_phone == ""){
                    $("#modal_error_phone").html("Το πεδίο είναι υποχρεωτικό");
                    $("#modal_error_phone").show();
                    $("#client_phone").focus();
                    document.getElementById("client_phone").style.borderColor = "red";
                    error_phone = true;
                }else if(modal_phone_pattern.test($("#client_phone").val())){
                    $("#modal_error_phone").hide();
                    document.getElementById("client_phone").style.borderColor = "green";
                }else{
                    $("#modal_error_phone").html("Μη έγκυρος αριθμός κινητού");
                    $("#modal_error_phone").show();
                    $("#client_phone").focus();
                    document.getElementById("client_phone").style.borderColor = "red";
                    error_phone = true;
                }
            }

            $("#client_phone").keyup(function () {
                $("#modal_error_phone").hide();
                document.getElementById("client_phone").style.borderColor = "#ddd";
            });


            $('#btn_modal_save').click(function () {

                error_email = false;
                error_name = false;
                error_surname = false;
                error_phone = false;

                check_modal_email();
                check_modal_name();
                check_modal_surname();
                check_modal_phone();

                var groomer_id =  $('#session_groomer_id').val();

                var appointment_date = getUrlParameter('date');
                var appointment_time = $('.edit_appointment_time').text();

                var modal_email = $('#client_email').val().trim();
                var modal_name = $('#client_name').val().trim();
                var modal_surname = $('#client_surname').val().trim();
                var modal_phone = $('#client_phone').val().trim();

                if(error_email == 0 && error_name == 0 && error_surname == 0 && error_phone == 0 ) {

                    $.ajax({
                        url: '../../groomer/groomer_server.php',
                        type: 'POST',
                        data:
                            {
                                manual_entry_appointment: 1,
                                groomer_id: groomer_id,
                                appointment_date: appointment_date,
                                appointment_time: appointment_time,
                                modal_email: modal_email,
                                modal_name: modal_name,
                                modal_surname: modal_surname,
                                modal_phone: modal_phone
                            },
                        success: function (response) {

                            if (response.indexOf('mi_diathesimo_rantevou') >= 0) {

                                $('.appointment_modal').modal('hide');

                                Swal.fire('Κάτι πήγε στραβά!', "Το ραντεβού είναι μη διαθέσιμο. Επιλέξτε κάποια άλλη ώρα", "error")
                                    .then(function () {
                                        location.reload();
                                    });
                            }

                            if (response.indexOf('success_appoint_customer') >= 0) {
                                $('.appointment_modal').modal('hide');

                                Swal.fire({
                                    icon: 'success',
                                    html: 'Το ραντεβού καταχωρήθηκε με επιτυχία',
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: '../../groomer/groomer_server.php',
                                            type: 'POST',
                                            data:
                                                {
                                                    success_appoint_customer_send_email: 1,
                                                    modal_email: modal_email,
                                                    modal_surname: modal_surname,
                                                    appointment_date: appointment_date,
                                                    appointment_time: appointment_time
                                                },

                                            success: function () {
                                                var modal_email = $('#client_email').val('');
                                                var modal_name = $('#client_name').val('');
                                                var modal_surname = $('#client_surname').val('');
                                                var modal_phone = $('#client_phone').val('');
                                                document.getElementById("client_email").style.borderColor = "#ddd";
                                                document.getElementById("client_name").style.borderColor = "#ddd";
                                                document.getElementById("client_surname").style.borderColor = "#ddd";
                                                document.getElementById("client_phone").style.borderColor = "#ddd";
                                                location.reload();
                                            }
                                        });
                                    }

                                });

                            }

                            if (response.indexOf('success_appoint_new_customer') >= 0) {
                                $('.appointment_modal').modal('hide');

                                Swal.fire({
                                    icon: 'success',
                                    html: 'Το ραντεβού καταχωρήθηκε με επιτυχία',
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: '../../groomer/groomer_server.php',
                                            type: 'POST',
                                            data:
                                                {
                                                    success_appoint_new_customer_send_email: 1,
                                                    modal_email: modal_email,
                                                    modal_surname: modal_surname,
                                                    appointment_date: appointment_date,
                                                    appointment_time: appointment_time
                                                },

                                            success: function () {
                                                var modal_email = $('#client_email').val('');
                                                var modal_name = $('#client_name').val('');
                                                var modal_surname = $('#client_surname').val('');
                                                var modal_phone = $('#client_phone').val('');
                                                document.getElementById("client_email").style.borderColor = "#ddd";
                                                document.getElementById("client_name").style.borderColor = "#ddd";
                                                document.getElementById("client_surname").style.borderColor = "#ddd";
                                                document.getElementById("client_phone").style.borderColor = "#ddd";
                                                location.reload();
                                            }
                                        });
                                    }

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
    });

    /* Σε αυτό το σημείο τσεκάρουμε αν το διαθέσιμο ραντεβού έχει λήξει με βάση την τωρινή ώρα και ημερομηνία
    * Αν για παράδειγμα η ώρα είναι 12:00 τότε όλα τα buttons έως τις 12 θα είναι απενεργοποιηήμενα ώστε να μη μπορεί
    * ο χρήστης να κλείσει ραντεβού
    * */

    var CurrentHours = new Date().getHours();
    var CurrentMinutes = new Date().getMinutes();
    var CurrentTime = CurrentHours + ":" + CurrentMinutes;

    var da = new Date($('#choose_date_for_appointment').val());
    var year = da.getFullYear();
    var month = ("0" + (da.getMonth() + 1)).slice(-2) ;
    var day = ("0" + (da.getDate() )).slice(-2);

    var NewDate = new Date();
    var SelectedDate = new Date(year+"-"+month+"-"+day);

    if(SelectedDate.getFullYear() == NewDate.getFullYear() && SelectedDate.getMonth() == NewDate.getMonth() && SelectedDate.getDate() == NewDate.getDate()) {

        $(".appointment_button").each(function () {

            var time = $(this).val();

            if (CurrentTime >= time) {
                $('.appointment_button[value="' + time + '"]').prop("disabled", true);
            }

        });
    }
    /*------------------------------------------------------------------------------------------*/


});