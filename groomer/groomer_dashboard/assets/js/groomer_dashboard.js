$(document).ready(function () {

    /*Εμφάνιση Ημερομηνίας και ώρας για τα alert headings*/
    var d = new Date();
    var year = d.getFullYear();
    var month = ("0" + (d.getMonth() + 1)).slice(-2)
    var day = d.getDate();
    var hour = d.getHours();
    var minutes = ("0" + d.getMinutes()).slice(-2);
    var seconds = ("0" + d.getSeconds()).slice(-2);

    $('.alert-heading').text("Τελευταία ενημέρωση στις " + day + "/" + month + "/" + year + " " + hour + ":" + minutes + ":" + seconds);

    /*Όταν ο groomer πατήσει ακυρωση σε μια αιτηση τότε αυτή ΔΕ ΘΑ ΔΙΑΓΡΑΦΤΕΙ απλά θα αλλάξει η
    * κατασταση στο πίνακα canceled=1
    * */

    $( ".accept" ).each(function() {
        $(this).on("click", function () {
            var appointment_id = $(this).val();
            var appointment_date = $('.appointment_date').attr('value');
            var appointment_time = $('.appointment_time').attr('value');
            var email = $('.email').attr('value');
            var surname = $('.surname').attr('value');
            var phone = $('.phone').attr('value');
            Swal.fire({
                icon: 'success',
                html: 'Αποδεχτήκατε την αίτηση για ραντεβού στις <br>' + appointment_date + ' και ώρα ' + appointment_time,
            }).then(function () {
                $.ajax({
                    url:'../../groomer/groomer_server.php',
                    type:'POST',
                    data:
                        {
                            accept_appointment: 1,
                            appointment_id:appointment_id,appointment_date:appointment_date,
                            appointment_time:appointment_time,email:email,surname:surname,phone:phone
                        },
                    success: function() {
                        location.reload();
                    }
                });
            });
        });
    });

    $( ".decline" ).each(function() {

        $(this).on("click", function () {

            var appointment_id = $(this).val();
            var appointment_date = $('.appointment_date').attr('value');
            var appointment_time = $('.appointment_time').attr('value');
            var email = $('.email').attr('value');
            var surname = $('.surname').attr('value');
            var phone = $('.phone').attr('value');

            Swal.fire({
                icon: 'question',
                text: 'Είστε σίγουρος πως θέλετε να ακυρώσετε το συγκεκριμένο ραντεβού;',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Απόρριψη Αίτησης',
                cancelButtonText: 'Ακύρωση',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:'../../groomer/groomer_server.php',
                        type:'POST',
                        data:
                            {
                                decline_appointment: 1,
                                appointment_id:appointment_id,appointment_date:appointment_date,
                                appointment_time:appointment_time,email:email,surname:surname,phone:phone
                            },
                        success:function(response){
                            if(response.indexOf('appointment_declined') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Το ραντεβού ακυρώθηκε με επιτυχία',
                                }).then(function () {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            })
        });
    });

   /* Counter Animate For Registered User*/
    $({ Counter: 0 }).animate({
        Counter: $('#card_title_user').text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function() {
            $('#card_title_user').text(Math.ceil(this.Counter));
        }
    });

    /* Counter Animate For In Process Appointment*/

    $({ Counter: 0 }).animate({
        Counter: $('#card_title_in_process_appoint').text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function() {
            $('#card_title_in_process_appoint').text(Math.ceil(this.Counter));
        }
    });

    /* Counter Animate For Completed Appointment*/

    $({ Counter: 0 }).animate({
        Counter: $('#card_title_completed_appoint').text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function() {
            $('#card_title_completed_appoint').text(Math.ceil(this.Counter));
        }
    });

    /* Counter Animate For Canceled Appointment*/

    $({ Counter: 0 }).animate({
        Counter: $('#card_title_canceled_appoint').text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function() {
            $('#card_title_canceled_appoint').text(Math.ceil(this.Counter));
        }
    });

});