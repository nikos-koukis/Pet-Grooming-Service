$(document).ready(function () {

    //Javascript για το modal που πετάγεται στον χρήστη για υπενθύμιση του ραντεβού του
    //Εμφανίζω το modal ανά 5 λεπτά
    function doStuff() {
        $("#user_appointment_modal").modal('show');
    }
    setInterval(doStuff, 300000);

    /*Όταν ο χρήστης πατήσει το λινκ 'Σύνδεση' τότε του ανοίγει το modal για login*/
    $("#login_link").click(function(){
        $("#modal_login").modal('show');
    });

    /*Όταν ο χρήστης πατήσει το λινκ 'Εγγραφή' τότε του ανοίγει το modal για register*/
    $("#register_link").click(function(){
        $("#modal_register").modal('show');
    });

    $(".link_not_member").click(function(){
        $("#modal_login").modal('hide');
        $("#modal_register").modal('show');
    });

    $("#already_member").click(function(){
        $("#modal_register").modal('hide');
        $("#modal_login").modal('show');
    });

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
                window.location = 'user/user_logout.php';
            }
        });
    });


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
    var year = $('#year').text();
    var month = $('#month').text();
    var day = $('#day').text();

    var date = year + "-" + month + "-" + day;
    var groomer_id = getUrlParameter('groomer_id');


    $.ajax({
        url:'server.php',
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

    var email = $('#session_email').val();

    $( ".appointment_button" ).each(function() {
        $(this).on("click", function(){

            var value = $(this).attr('data-target');

            if(!email){
                Swal.fire({
                    icon: 'question',
                    title: 'Έχετε συνδεθεί;',
                    text: "Για να κλείσετε ραντεβού θα πρέπει να έχετε συνδεθεί",
                }).then(function () {
                    $("#modal_login").modal('show');
                });
            }else{
                $('.appointment_modal').prop('id',value.substr(1));
                $(".modal-body .edit_appointment_time").text($(this).val());

                var year = getUrlParameter('year');
                var month = getUrlParameter('month');
                var day = getUrlParameter('date');

                var date = year+"-"+month+"-"+day;

                $(".modal-body .edit_appointment_date").text(date);

                $('#btn_book_appointment').click(function () {

                    var appointment_date = date;
                    var appointment_time = $('.edit_appointment_time').text();
                    var groomer_id = getUrlParameter('groomer_id');

                    var user_id = $('#user_id').text();
                    var modal_email = $('#client_email').val();
                    var modal_name = $('#client_name').val();
                    var modal_surname = $('#client_surname').val();
                    var modal_phone = $('#client_phone').val();

                    $.ajax({
                        url:'server.php',
                        type:'POST',
                        data:
                            {
                                entry_appointment: 1,
                                groomer_id:groomer_id,user_id:user_id,
                                appointment_date:appointment_date,appointment_time:appointment_time,
                                modal_email:modal_email,modal_name:modal_name,
                                modal_surname:modal_surname,modal_phone:modal_phone
                            },
                        success:function(response){

                            if(response.indexOf('new_customer_added') >= 0){
                                $('.appointment_modal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ραντεβού καταχωρήθηκε με επιτυχία. \n" +
                                        "Θα ενημερωθείτε με email όταν γίνει έγκριση από τον διαχειριστή",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                            }

                            if(response.indexOf('to_radevou_uparxei') >= 0){

                                $('.appointment_modal').modal('hide');

                                Swal.fire('Κάτι πήγε στραβά!', "Το ραντεβού είναι μη διαθέσιμο. Επιλέξτε κάποια άλλη ώρα", "error")
                                    .then(function() {
                                        location.reload();
                                    });
                            }

                        }
                    });

                });

            }
        });
    });


    /* Σε αυτό το σημείο τσεκάρουμε αν το διαθέσιμο ραντεβού έχει λήξει με βάση την τωρινή ώρα και ημερομηνία
    * Αν για παράδειγμα η ώρα είναι 12:00 τότε όλα τα buttons έως τις 12 θα είναι απενεργοποιηήμενα ώστε να μη μπορεί
    * ο χρήστης να κλείσει ραντεβού
    * */
    var CurrentHours = new Date().getHours();
    var CurrentMinutes = new Date().getMinutes();
    var CurrentTime = CurrentHours + ":" + CurrentMinutes;

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