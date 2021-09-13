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


    $("#city_error").hide();
    $("#date_error").hide();

    var error_city = false;
    var error_date = false;

    function check_city(){

        var city = $("#city").val();

        if(city == 0){
            $("#city_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#city").focus();
            $("#city_error").show();
            document.getElementById("city").style.borderColor = "red";
            error_city = true;
        }else{
            $("#city_error").hide();
            document.getElementById("city").style.borderColor = "green";
        }
    }

    $("#city").change(function () {
        $("#city_error").hide();
        document.getElementById("city").style.borderColor = "#ddd";
    });

    function check_date(){

        var date = $("#date").val();
        var d = new Date();
        var currentDate = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ("0" + (d.getDate() )).slice(-2);

        if(date == ""){
            $("#date_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#date_error").show();
            document.getElementById("date").style.borderColor = "red";
            error_date = true;
        }else if(currentDate > date){
            $("#date_error").html("Μη έγκυρη ημερομηνία");
            $("#date_error").show();
            document.getElementById("date").style.borderColor = "red";
            error_date = true;
        }else{
            $("#date_error").hide();
            document.getElementById("date").style.borderColor = "green";
        }
    }

    $("#date").change(function () {

        $("#date_error").hide();
        document.getElementById("date").style.borderColor = "#ddd";

    });

    $('#btn_search').click(function () {

        error_city = false;
        error_date = false;

        check_city();
        check_date();

        if(error_city == 0 && error_date == 0){

            var d = new Date($('#date').val());
            var current_date = d.toDateString().substring(0,3);
            var year = d.getFullYear();
            var month = ("0" + (d.getMonth() + 1)).slice(-2);
            var date = ("0" + (d.getDate() )).slice(-2);
            var city = $('#city option:selected').text();

            window.location = 'search_result.php?current_date=' + current_date + '&city=' + city + '&year=' + year
                              + '&month=' + month + '&date=' + date;

        }

    });


});