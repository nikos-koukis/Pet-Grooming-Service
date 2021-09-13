$(document).ready(function () {

    //Close Notification Container WIth Icon
    $(".bxs-message-square-x").click(function(ev){
        $(".notifications_day").css("display", "none");
    });

    //Autoload working hours For Monday

    var day_id = $("#date option:selected").attr('id') ;
    var email = $('#session_email').val();
    //
    $.ajax({
        url:'../../groomer/groomer_server.php',
        type: 'post',
        dataType: 'JSON',
        data:{
            autoload_working_hours_monday_from_ajax:1,
            email:email,day_id:day_id
        },
        success: function(response){

            var len = response.length;
            for(var i=0; i<len; i++){
                var from_hour = response[i].from_hour;
                var until_hour = response[i].until_hour;
                var from_hour_extra = response[i].from_hour_extra;
                var until_hour_extra = response[i].until_hour_extra;
            }

            //--------------------- For Monday ------------------//

            $('[id=from_monday_day] option').filter(function() {
                return ($(this).text() == from_hour);
            }).prop('selected', true);

            $('[id=until_monday_day] option').filter(function() {
                return ($(this).text() == until_hour);
            }).prop('selected', true);

            $('[id=from_monday_day_extra] option').filter(function() {
                return ($(this).text() == from_hour_extra);
            }).prop('selected', true);

            $('[id=until_monday_day_extra] option').filter(function() {
                return ($(this).text() == until_hour_extra);
            }).prop('selected', true);

            if(from_hour != 0 && until_hour !=0){
                $("#from_monday_day").prop("disabled", false);
                $("#until_monday_day").prop("disabled", false);
                $("#btn_extra_vardia_monday").css("display", "unset");
                $("#monday_day_open").prop("checked", true);

                if(from_hour_extra !=0 && until_hour_extra !=0){
                    $("#collapseExtraVardiaMonday").addClass('show');
                    $("#from_monday_day_extra").prop("disabled", false);
                    $("#until_monday_day_extra").prop("disabled", false);
                    $("#btn_icon_monday").toggleClass('fa-minus');
                    $("#monday_day_extra_open").prop("checked", true);
                }
            }
            if(from_hour_extra == 0 && until_hour_extra == 0){
                $("#from_monday_day_extra").val(0);
                $("#until_monday_day_extra").val(0);
                $("#from_monday_day_extra").prop("disabled", true);
                $("#until_monday_day_extra").prop("disabled", true);
                $("#monday_day_extra_closed").prop("checked", true);
            }

            if(from_hour == 0 && until_hour == 0){
                $("#from_monday_day").prop("disabled", true);
                $("#until_monday_day").prop("disabled", true);
                $("#from_monday_day").val(0);
                $("#until_monday_day").val(0);
                $("#monday_day_closed").prop("checked", true);
            }


        }
    });

    //Change Container Days Via DropDown Select Day Menu
    //First Of All Hide All Day Containers
    //And Show Only Container-Monday
    //If Select Option Of Days Change, then change and container

    $('.container_days').hide();
    $('#container_days_monday').show();

    //Autoload working hours in select dropdown
    $('#date').change(function () {

        $('.container_days').hide();
        $('#'+$(this).val()).show();

        var day_id = $("#date option:selected").attr('id') ;
        var email = $('#session_email').val();

        $.ajax({
            url:'../../groomer/groomer_server.php',
            type: 'post',
            dataType: 'JSON',
            data:{
                autoload_working_hours_monday_from_ajax:1,
                email:email,day_id:day_id
            },
            success: function(response){

                var len = response.length;
                for(var i=0; i<len; i++){
                    var from_hour = response[i].from_hour;
                    var until_hour = response[i].until_hour;
                    var from_hour_extra = response[i].from_hour_extra;
                    var until_hour_extra = response[i].until_hour_extra;
                }

                //--------------------- For Monday ------------------//

                $('[id=from_monday_day] option').filter(function() {
                    return ($(this).text() == from_hour);
                }).prop('selected', true);

                $('[id=until_monday_day] option').filter(function() {
                    return ($(this).text() == until_hour);
                }).prop('selected', true);

                $('[id=from_monday_day_extra] option').filter(function() {
                    return ($(this).text() == from_hour_extra);
                }).prop('selected', true);

                $('[id=until_monday_day_extra] option').filter(function() {
                    return ($(this).text() == until_hour_extra);
                }).prop('selected', true);

                if(from_hour != 0 && until_hour !=0){
                    $("#from_monday_day").prop("disabled", false);
                    $("#until_monday_day").prop("disabled", false);
                    $("#btn_extra_vardia_monday").css("display", "unset");
                    $("#monday_day_open").prop("checked", true);

                    if(from_hour_extra !=0 && until_hour_extra !=0){
                        $("#collapseExtraVardiaMonday").addClass('show');
                        $("#from_monday_day_extra").prop("disabled", false);
                        $("#until_monday_day_extra").prop("disabled", false);
                        $("#btn_icon_monday").toggleClass('fa-minus');
                        $("#monday_day_extra_open").prop("checked", true);
                    }
                }
                if(from_hour_extra == 0 && until_hour_extra == 0){
                    $("#collapseExtraVardiaMonday").removeClass('show');
                    $("#from_monday_day_extra").val(0);
                    $("#until_monday_day_extra").val(0);
                    $("#from_monday_day_extra").prop("disabled", true);
                    $("#until_monday_day_extra").prop("disabled", true);
                    $("#btn_icon_monday").toggleClass('fa-minus');
                    $("#monday_day_extra_closed").prop("checked", true);
                }

                if(from_hour == 0 && until_hour == 0){
                    $("#from_monday_day").prop("disabled", true);
                    $("#until_monday_day").prop("disabled", true);
                    $("#from_monday_day").val(0);
                    $("#until_monday_day").val(0);
                    $("#monday_day_closed").prop("checked", true);
                }

                //--------------------- For Tuesday ------------------//

                $('[id=from_tuesday_day] option').filter(function() {
                    return ($(this).text() == from_hour);
                }).prop('selected', true);

                $('[id=until_tuesday_day] option').filter(function() {
                    return ($(this).text() == until_hour);
                }).prop('selected', true);

                $('[id=from_tuesday_day_extra] option').filter(function() {
                    return ($(this).text() == from_hour_extra);
                }).prop('selected', true);

                $('[id=until_tuesday_day_extra] option').filter(function() {
                    return ($(this).text() == until_hour_extra);
                }).prop('selected', true);

                if(from_hour != 0 && until_hour !=0){
                    $("#from_tuesday_day").prop("disabled", false);
                    $("#until_tuesday_day").prop("disabled", false);
                    $("#btn_extra_vardia_tuesday").css("display", "unset");
                    $("#tuesday_day_open").prop("checked", true);

                    if(from_hour_extra !=0 && until_hour_extra !=0){
                        $("#collapseExtraVardiaTuesday").addClass('show');
                        $("#from_tuesday_day_extra").prop("disabled", false);
                        $("#until_tuesday_day_extra").prop("disabled", false);
                        $("#btn_icon_tuesday").toggleClass('fa-minus');
                        $("#tuesday_day_extra_open").prop("checked", true);
                    }
                }

                if(from_hour_extra == 0 && until_hour_extra == 0){
                    $("#collapseExtraVardiaTuesday").removeClass('show');
                    $("#from_tuesday_day_extra").val(0);
                    $("#until_tuesday_day_extra").val(0);
                    $("#from_tuesday_day_extra").prop("disabled", true);
                    $("#until_tuesday_day_extra").prop("disabled", true);
                    $("#btn_icon_tuesday").toggleClass('fa-minus');
                    $("#tuesday_day_extra_closed").prop("checked", true);
                }

                if(from_hour == 0 && until_hour == 0){
                    $("#from_tuesday_day").prop("disabled", true);
                    $("#until_tuesday_day").prop("disabled", true);
                    $("#from_tuesday_day").val(0);
                    $("#until_tuesday_day").val(0);
                    $("#tuesday_day_closed").prop("checked", true);
                }

                //--------------------- For Wednesday ------------------//

                $('[id=from_wednesday_day] option').filter(function() {
                    return ($(this).text() == from_hour);
                }).prop('selected', true);

                $('[id=until_wednesday_day] option').filter(function() {
                    return ($(this).text() == until_hour);
                }).prop('selected', true);

                $('[id=from_wednesday_day_extra] option').filter(function() {
                    return ($(this).text() == from_hour_extra);
                }).prop('selected', true);

                $('[id=until_wednesday_day_extra] option').filter(function() {
                    return ($(this).text() == until_hour_extra);
                }).prop('selected', true);

                if(from_hour != 0 && until_hour !=0){
                    $("#from_wednesday_day").prop("disabled", false);
                    $("#until_wednesday_day").prop("disabled", false);
                    $("#btn_extra_vardia_wednesday").css("display", "unset");
                    $("#wednesday_day_open").prop("checked", true);

                    if(from_hour_extra !=0 && until_hour_extra !=0){
                        $("#collapseExtraVardiaWednesday").addClass('show');
                        $("#from_wednesday_day_extra").prop("disabled", false);
                        $("#until_wednesday_day_extra").prop("disabled", false);
                        $("#btn_icon_wednesday").toggleClass('fa-minus');
                        $("#wednesday_day_extra_open").prop("checked", true);
                    }
                }
                if(from_hour_extra == 0 && until_hour_extra == 0){
                    $("#collapseExtraVardiaWednesday").removeClass('show');
                    $("#from_wednesday_day_extra").val(0);
                    $("#until_wednesday_day_extra").val(0);
                    $("#from_wednesday_day_extra").prop("disabled", true);
                    $("#until_wednesday_day_extra").prop("disabled", true);
                    $("#btn_icon_wednesday").toggleClass('fa-minus');
                    $("#wednesday_day_extra_closed").prop("checked", true);
                }

                if(from_hour == 0 && until_hour == 0){
                    $("#from_wednesday_day").prop("disabled", true);
                    $("#until_wednesday_day").prop("disabled", true);
                    $("#from_wednesday_day").val(0);
                    $("#until_wednesday_day").val(0);
                    $("#wednesday_day_closed").prop("checked", true);
                }

                //--------------------- For Thursday ------------------//

                $('[id=from_thursday_day] option').filter(function() {
                    return ($(this).text() == from_hour);
                }).prop('selected', true);

                $('[id=until_thursday_day] option').filter(function() {
                    return ($(this).text() == until_hour);
                }).prop('selected', true);

                $('[id=from_thursday_day_extra] option').filter(function() {
                    return ($(this).text() == from_hour_extra);
                }).prop('selected', true);

                $('[id=until_thursday_day_extra] option').filter(function() {
                    return ($(this).text() == until_hour_extra);
                }).prop('selected', true);

                if(from_hour != 0 && until_hour !=0){
                    $("#from_thursday_day").prop("disabled", false);
                    $("#until_thursday_day").prop("disabled", false);
                    $("#btn_extra_vardia_thursday").css("display", "unset");
                    $("#thursday_day_open").prop("checked", true);

                    if(from_hour_extra !=0 && until_hour_extra !=0){
                        $("#collapseExtraVardiaThursday").addClass('show');
                        $("#from_thursday_day_extra").prop("disabled", false);
                        $("#until_thursday_day_extra").prop("disabled", false);
                        $("#btn_icon_thursday").toggleClass('fa-minus');
                        $("#thursday_day_extra_open").prop("checked", true);
                    }
                }

                if(from_hour_extra == 0 && until_hour_extra == 0){
                    $("#collapseExtraVardiaThursday").removeClass('show');
                    $("#from_thursday_day_extra").val(0);
                    $("#until_thursday_day_extra").val(0);
                    $("#from_thursday_day_extra").prop("disabled", true);
                    $("#until_thursday_day_extra").prop("disabled", true);
                    $("#btn_icon_thursday").toggleClass('fa-minus');
                    $("#thursday_day_extra_closed").prop("checked", true);
                }

                if(from_hour == 0 && until_hour == 0){
                    $("#from_thursday_day").prop("disabled", true);
                    $("#until_thursday_day").prop("disabled", true);
                    $("#from_thursday_day").val(0);
                    $("#until_thursday_day").val(0);
                    $("#thursday_day_closed").prop("checked", true);
                }
                //--------------------- For Friday ------------------//

                $('[id=from_friday_day] option').filter(function() {
                    return ($(this).text() == from_hour);
                }).prop('selected', true);

                $('[id=until_friday_day] option').filter(function() {
                    return ($(this).text() == until_hour);
                }).prop('selected', true);

                $('[id=from_friday_day_extra] option').filter(function() {
                    return ($(this).text() == from_hour_extra);
                }).prop('selected', true);

                $('[id=until_friday_day_extra] option').filter(function() {
                    return ($(this).text() == until_hour_extra);
                }).prop('selected', true);

                if(from_hour != 0 && until_hour !=0){
                    $("#from_friday_day").prop("disabled", false);
                    $("#until_friday_day").prop("disabled", false);
                    $("#btn_extra_vardia_friday").css("display", "unset");
                    $("#friday_day_open").prop("checked", true);

                    if(from_hour_extra !=0 && until_hour_extra !=0){
                        $("#collapseExtraVardiaFriday").addClass('show');
                        $("#from_friday_day_extra").prop("disabled", false);
                        $("#until_friday_day_extra").prop("disabled", false);
                        $("#btn_icon_friday").toggleClass('fa-minus');
                        $("#friday_day_extra_open").prop("checked", true);
                    }
                }

                if(from_hour_extra == 0 && until_hour_extra == 0){
                    $("#collapseExtraVardiaFriday").removeClass('show');
                    $("#from_friday_day_extra").val(0);
                    $("#until_friday_day_extra").val(0);
                    $("#from_friday_day_extra").prop("disabled", true);
                    $("#until_friday_day_extra").prop("disabled", true);
                    $("#btn_icon_friday").toggleClass('fa-minus');
                    $("#friday_day_extra_closed").prop("checked", true);
                }

                if(from_hour == 0 && until_hour == 0){
                    $("#from_friday_day").prop("disabled", true);
                    $("#until_friday_day").prop("disabled", true);
                    $("#from_friday_day").val(0);
                    $("#until_friday_day").val(0);
                    $("#friday_day_closed").prop("checked", true);
                }

                //--------------------- For Saturday ------------------//

                $('[id=from_saturday_day] option').filter(function() {
                    return ($(this).text() == from_hour);
                }).prop('selected', true);

                $('[id=until_saturday_day] option').filter(function() {
                    return ($(this).text() == until_hour);
                }).prop('selected', true);

                $('[id=from_saturday_day_extra] option').filter(function() {
                    return ($(this).text() == from_hour_extra);
                }).prop('selected', true);

                $('[id=until_saturday_day_extra] option').filter(function() {
                    return ($(this).text() == until_hour_extra);
                }).prop('selected', true);

                if(from_hour != 0 && until_hour !=0){
                    $("#from_saturday_day").prop("disabled", false);
                    $("#until_saturday_day").prop("disabled", false);
                    $("#btn_extra_vardia_saturday").css("display", "unset");
                    $("#saturday_day_open").prop("checked", true);

                    if(from_hour_extra !=0 && until_hour_extra !=0){
                        $("#collapseExtraVardiaSaturday").addClass('show');
                        $("#from_saturday_day_extra").prop("disabled", false);
                        $("#until_saturday_day_extra").prop("disabled", false);
                        $("#btn_icon_saturday").toggleClass('fa-minus');
                        $("#saturday_day_extra_open").prop("checked", true);
                    }
                }

                if(from_hour_extra == 0 && until_hour_extra == 0){
                    $("#collapseExtraVardiaSaturday").removeClass('show');
                    $("#from_saturday_day_extra").val(0);
                    $("#until_saturday_day_extra").val(0);
                    $("#from_saturday_day_extra").prop("disabled", true);
                    $("#until_saturday_day_extra").prop("disabled", true);
                    $("#btn_icon_saturday").toggleClass('fa-minus');
                    $("#saturday_day_extra_closed").prop("checked", true);
                }

                if(from_hour == 0 && until_hour == 0){
                    $("#from_saturday_day").prop("disabled", true);
                    $("#until_saturday_day").prop("disabled", true);
                    $("#from_saturday_day").val(0);
                    $("#until_saturday_day").val(0);
                    $("#saturday_day_closed").prop("checked", true);
                }

                //--------------------- For Sunday ------------------//

                $('[id=from_sunday_day] option').filter(function() {
                    return ($(this).text() == from_hour);
                }).prop('selected', true);

                $('[id=until_sunday_day] option').filter(function() {
                    return ($(this).text() == until_hour);
                }).prop('selected', true);

                $('[id=from_sunday_day_extra] option').filter(function() {
                    return ($(this).text() == from_hour_extra);
                }).prop('selected', true);

                $('[id=until_sunday_day_extra] option').filter(function() {
                    return ($(this).text() == until_hour_extra);
                }).prop('selected', true);

                if(from_hour != 0 && until_hour !=0){
                    $("#from_sunday_day").prop("disabled", false);
                    $("#until_sunday_day").prop("disabled", false);
                    $("#btn_extra_vardia_sunday").css("display", "unset");
                    $("#sunday_day_open").prop("checked", true);

                    if(from_hour_extra !=0 && until_hour_extra !=0){
                        $("#collapseExtraVardiaSunday").addClass('show');
                        $("#from_sunday_day_extra").prop("disabled", false);
                        $("#until_sunday_day_extra").prop("disabled", false);
                        $("#btn_icon_sunday").toggleClass('fa-minus');
                        $("#sunday_day_extra_open").prop("checked", true);
                    }
                }

                if(from_hour_extra == 0 && until_hour_extra == 0){
                    $("#collapseExtraVardiaSunday").removeClass('show');
                    $("#from_sunday_day_extra").val(0);
                    $("#until_sunday_day_extra").val(0);
                    $("#from_sunday_day_extra").prop("disabled", true);
                    $("#until_sundayy_day_extra").prop("disabled", true);
                    $("#btn_icon_sunday").toggleClass('fa-minus');
                    $("#sunday_day_extra_closed").prop("checked", true);
                }

                if(from_hour == 0 && until_hour == 0){
                    $("#from_sunday_day").prop("disabled", true);
                    $("#until_sunday_day").prop("disabled", true);
                    $("#from_sunday_day").val(0);
                    $("#until_sunday_day").val(0);
                    $("#sunday_day_closed").prop("checked", true);

                }

            }
        });

    });


    //Default Selected Option -> Closed
    //Disable Selected Option
    $("#from_monday_day").prop("disabled", true);
    $("#until_monday_day").prop("disabled", true);
    $("#from_monday_day_extra").prop("disabled", true);
    $("#until_monday_day_extra").prop("disabled", true);
    $("#btn_extra_vardia_monday").css("display", "none");

    //Disable-Enable Selected Option via Radio Button

    $('input:radio[id="monday_day_open"]').change(function () {
        $("#from_monday_day").prop("disabled", false);
        $("#until_monday_day").prop("disabled", false);
        $("#btn_extra_vardia_monday").css("display", "unset");
    });

    $('input:radio[id="monday_day_closed"]').change(function () {
        $("#from_monday_day").prop("disabled", true);
        $("#until_monday_day").prop("disabled", true);
        $("#btn_extra_vardia_monday").css("display", "none");
        //Hide Error When Select: Open -> Closed
        $("#from_monday_day_error").hide();
        $("#until_monday_day_error").hide();
        document.getElementById("from_monday_day").style.borderColor = "#ddd";
        document.getElementById("until_monday_day").style.borderColor = "#ddd";
        $("#from_monday_day_extra").prop("disabled", true);
        $("#until_monday_day_extra").prop("disabled", true);
        $("#collapseExtraVardiaMonday").removeClass('collapse show').addClass('collapse');
        $("#monday_day_extra_closed").prop("checked", true);
        $("#from_monday_day").val(0);
        $("#until_monday_day").val(0);
        $("#from_monday_day_extra").val(0);
        $("#until_monday_day_extra").val(0);
        $("#btn_icon_monday").removeClass('fa-minus');

    });

    $('input:radio[id="monday_day_extra_open"]').change(function () {
        $("#from_monday_day_extra").prop("disabled", false);
        $("#until_monday_day_extra").prop("disabled", false);
    });

    $('input:radio[id="monday_day_extra_closed"]').change(function () {
        $("#from_monday_day_extra").prop("disabled", true);
        $("#until_monday_day_extra").prop("disabled", true);
        $("#from_monday_day_extra_error").hide();
        $("#until_monday_day_extra_error").hide();
        document.getElementById("from_monday_day_extra").style.borderColor = "#ddd";
        document.getElementById("until_monday_day_extra").style.borderColor = "#ddd";
        $("#from_monday_day_extra").val(0);
        $("#until_monday_day_extra").val(0);
        $("#collapseExtraVardiaMonday").removeClass('collapse show').addClass('collapse');
        $("#btn_icon_monday").toggleClass('fa-minus');
    });

    //Change Icon When Button Collapsed Pressed

    $('#btn_extra_vardia_monday').click(function () {
        $("#btn_icon_monday").toggleClass('fa-minus');
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#from_monday_day_error").hide();

    // -- Disable all errors --//
    var error_from_monday_day = false;

    function check_monday_day_from(){

        var from_monday_day = $("#from_monday_day").val();

        if(from_monday_day == 0){
            $("#from_monday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_monday_day_error").show();
            $("#from_monday_day").focus();
            document.getElementById("from_monday_day").style.borderColor = "red";
            error_from_monday_day = true;
        }else{
            $("#from_monday_day_error").hide();
            document.getElementById("from_monday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - Monday
    $("#from_monday_day").change(function () {
        $("#from_monday_day_error").hide();
        document.getElementById("from_monday_day").style.borderColor = "#ddd";
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#until_monday_day_error").hide();

    // -- Disable all errors --//
    var error_until_monday_day = false;

    function check_monday_day_until(){

        var from_monday_day = $("#from_monday_day").val();
        var until_monday_day = $("#until_monday_day").val();

        if(until_monday_day == 0){
            $("#until_monday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_monday_day_error").show();
            $("#until_monday_day").focus();
            document.getElementById("until_monday_day").style.borderColor = "red";
            error_until_monday_day = true;
        }else if(from_monday_day>until_monday_day || from_monday_day==until_monday_day){
            $("#until_monday_day_error").html("Μη έγκυρη τιμή");
            $("#until_monday_day_error").show();
            $("#until_monday_day").focus();
            document.getElementById("until_monday_day").style.borderColor = "red";
            error_until_monday_day = true;
        }else{
            $("#until_monday_day_error").hide();
            document.getElementById("until_monday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - Monday
    $("#until_monday_day").change(function () {
        $("#until_monday_day_error").hide();
        document.getElementById("until_monday_day").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#from_monday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_from_monday_day_extra = false;

    function check_monday_day_extra_from(){

        var until_monday_day = $("#until_monday_day").val();
        var from_monday_day_extra = $("#from_monday_day_extra").val();

        if(from_monday_day_extra == 0){
            $("#from_monday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_monday_day_extra_error").show();
            $("#from_monday_day_extra").focus();
            document.getElementById("from_monday_day_extra").style.borderColor = "red";
            error_from_monday_day_extra = true;
        }else if(until_monday_day>from_monday_day_extra || from_monday_day_extra==until_monday_day){
            $("#from_monday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#from_monday_day_extra_error").show();
            $("#from_monday_day_extra").focus();
            document.getElementById("from_monday_day_extra").style.borderColor = "red";
            error_from_monday_day_extra = true;
        }else{
            $("#from_monday_day_extra_error").hide();
            document.getElementById("from_monday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - Monday
    $("#from_monday_day_extra").change(function () {
        $("#from_monday_day_extra_error").hide();
        document.getElementById("from_monday_day_extra").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#until_monday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_until_monday_day_extra = false;

    function check_monday_day_extra_until(){

        var from_monday_day_extra = $("#from_monday_day_extra").val();
        var until_monday_day_extra = $("#until_monday_day_extra").val();

        if(until_monday_day_extra == 0){
            $("#until_monday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_monday_day_extra_error").show();
            $("#until_monday_day_extra").focus();
            document.getElementById("until_monday_day_extra").style.borderColor = "red";
            error_until_monday_day_extra = true;
        }else if(from_monday_day_extra>until_monday_day_extra || from_monday_day_extra==until_monday_day_extra){
            $("#until_monday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#until_monday_day_extra_error").show();
            $("#until_monday_day_extra").focus();
            document.getElementById("until_monday_day_extra").style.borderColor = "red";
            error_until_monday_day_extra = true;
        }else{
            $("#until_monday_day_extra_error").hide();
            document.getElementById("until_monday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - Monday
    $("#until_monday_day_extra").change(function () {
        $("#until_monday_day_extra_error").hide();
        document.getElementById("until_monday_day_extra").style.borderColor = "#ddd";
    });


    $('#btn_save_monday_day').click(function () {

        error_from_monday_day = false;
        error_until_monday_day = false;
        error_from_monday_day_extra = false;
        error_until_monday_day_extra = false;

        var groomer_email = $('#session_email').val();

        var day_id = $("#date option:selected").attr('id');

        var from_monday_day = $("#from_monday_day option:selected").val();
        var until_monday_day = $("#until_monday_day option:selected").val();

        var from_monday_day_extra = $("#from_monday_day_extra option:selected").val();
        var until_monday_day_extra = $("#until_monday_day_extra option:selected").val();

        var isOpenChecked = $('#monday_day_open').is(':checked');
        var isOpenCheckedExtra = $('#monday_day_extra_open').is(':checked');

        var isClosedChecked = $('#monday_day_closed').is(':checked');

        var isOpenedCollapse = $('#collapseExtraVardiaMonday').attr("aria-expanded", true);

        if(isOpenChecked){
            check_monday_day_from();
            check_monday_day_until();
        }
        if(isOpenCheckedExtra){
            check_monday_day_extra_from();
            check_monday_day_extra_until();
        }

        if(isClosedChecked){

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    closed_monday_hours:1,
                    groomer_email:groomer_email,day_id:day_id,
                    from_monday_day:from_monday_day,until_monday_day:until_monday_day,
                    from_monday_day_extra:from_monday_day_extra,until_monday_day_extra:until_monday_day_extra
                },
                success: function(response){
                    if(response.indexOf('update_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο της Δευτέρας ενημερώθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_monday_day").style.borderColor = "#ddd";
                        document.getElementById("until_monday_day").style.borderColor = "#ddd";
                        document.getElementById("from_monday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_monday_day_extra").style.borderColor = "#ddd";
                    }

                    if(response.indexOf('insert_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο της Δευτέρας καταχωρήθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_monday_day").style.borderColor = "#ddd";
                        document.getElementById("until_monday_day").style.borderColor = "#ddd";
                        document.getElementById("from_monday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_monday_day_extra").style.borderColor = "#ddd";
                    }
                }
            });

        }

        if(isOpenChecked){

            if(isOpenedCollapse){
                if (error_from_monday_day == 0 && error_until_monday_day == 0 && error_from_monday_day_extra == 0 && error_until_monday_day_extra == 0) {
                    $.ajax({
                        url:'../../groomer/groomer_server.php',
                        type: 'post',
                        data:{
                            opened_monday_hours:1,
                            groomer_email:groomer_email,day_id:day_id,
                            from_monday_day:from_monday_day,until_monday_day:until_monday_day,
                            from_monday_day_extra:from_monday_day_extra,until_monday_day_extra:until_monday_day_extra
                        },
                        success: function(response){
                            if(response.indexOf('update_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο της Δευτέρας ενημερώθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });

                                document.getElementById("from_monday_day").style.borderColor = "#ddd";
                                document.getElementById("until_monday_day").style.borderColor = "#ddd";
                                document.getElementById("from_monday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_monday_day_extra").style.borderColor = "#ddd";
                            }

                            if(response.indexOf('insert_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο της Δευτέρας καταχωρήθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                                document.getElementById("from_monday_day").style.borderColor = "#ddd";
                                document.getElementById("until_monday_day").style.borderColor = "#ddd";
                                document.getElementById("from_monday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_monday_day_extra").style.borderColor = "#ddd";
                            }
                        }
                    });
                    return true;
                }else{
                    return false;
                }
            }

            if (error_from_monday_day == 0 && error_until_monday_day == 0) {
                $.ajax({
                    url:'../../groomer/groomer_server.php',
                    type: 'post',
                    data:{
                        opened_monday_hours:1,
                        groomer_email:groomer_email,day_id:day_id,
                        from_monday_day:from_monday_day,until_monday_day:until_monday_day,
                        from_monday_day_extra:from_monday_day_extra,until_monday_day_extra:until_monday_day_extra
                    },
                    success: function(response){
                        if(response.indexOf('update_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο της Δευτέρας ενημερώθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_monday_day").style.borderColor = "#ddd";
                            document.getElementById("until_monday_day").style.borderColor = "#ddd";
                            document.getElementById("from_monday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_monday_day_extra").style.borderColor = "#ddd";
                        }

                        if(response.indexOf('insert_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο της Δευτέρας καταχωρήθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_monday_day").style.borderColor = "#ddd";
                            document.getElementById("until_monday_day").style.borderColor = "#ddd";
                            document.getElementById("from_monday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_monday_day_extra").style.borderColor = "#ddd";
                        }
                    }
                });
                return true;
            }else{
                return false;
            }

        }
    });

    //---------------------------------END JAVASCRIPT FOR MONDAY ------------------------------------------//

    //---------------------------------START JAVASCRIPT FOR TUESDAY ------------------------------------------//

    //Default Selected Option -> Closed
    //Disable Selected Option
    $("#from_tuesday_day").prop("disabled", true);
    $("#until_tuesday_day").prop("disabled", true);
    $("#from_tuesday_day_extra").prop("disabled", true);
    $("#until_tuesday_day_extra").prop("disabled", true);
    $("#btn_extra_vardia_tuesday").css("display", "none");

    //Disable-Enable Selected Option via Radio Button

    $('input:radio[id="tuesday_day_open"]').change(function () {
        $("#from_tuesday_day").prop("disabled", false);
        $("#until_tuesday_day").prop("disabled", false);
        $("#btn_extra_vardia_tuesday").css("display", "unset");
    });

    $('input:radio[id="tuesday_day_closed"]').change(function () {
        $("#from_tuesday_day").prop("disabled", true);
        $("#until_tuesday_day").prop("disabled", true);
        $("#btn_extra_vardia_tuesday").css("display", "none");
        //Hide Error When Select: Open -> Closed
        $("#from_tuesday_day_error").hide();
        $("#until_tuesday_day_error").hide();
        document.getElementById("from_tuesday_day").style.borderColor = "#ddd";
        document.getElementById("until_tuesday_day").style.borderColor = "#ddd";
        $("#from_tuesday_day_extra").prop("disabled", true);
        $("#until_tuesday_day_extra").prop("disabled", true);
        $("#collapseExtraVardiaTuesday").removeClass('collapse show').addClass('collapse');
        $("#tuesday_day_extra_closed").prop("checked", true);
        $("#from_tuesday_day").val(0);
        $("#until_tuesday_day").val(0);
        $("#from_tuesday_day_extra").val(0);
        $("#until_tuesday_day_extra").val(0);
        $("#btn_icon_tuesday").removeClass('fa-minus');

    });

    $('input:radio[id="tuesday_day_extra_open"]').change(function () {
        $("#from_tuesday_day_extra").prop("disabled", false);
        $("#until_tuesday_day_extra").prop("disabled", false);
    });

    $('input:radio[id="tuesday_day_extra_closed"]').change(function () {
        $("#from_tuesday_day_extra").prop("disabled", true);
        $("#until_tuesday_day_extra").prop("disabled", true);
        $("#from_tuesday_day_extra_error").hide();
        $("#until_tuesday_day_extra_error").hide();
        document.getElementById("from_tuesday_day_extra").style.borderColor = "#ddd";
        document.getElementById("until_tuesday_day_extra").style.borderColor = "#ddd";
        $("#from_tuesday_day_extra").val(0);
        $("#until_tuesday_day_extra").val(0);
        $("#collapseExtraVardiaTuesday").removeClass('collapse show').addClass('collapse');
        $("#btn_icon_tuesday").toggleClass('fa-minus');
    });

    //Change Icon When Button Collapsed Pressed

    $('#btn_extra_vardia_tuesday').click(function () {
        $("#btn_icon_tuesday").toggleClass('fa-minus');
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#from_tuesday_day_error").hide();

    // -- Disable all errors --//
    var error_from_tuesday_day = false;

    function check_tuesday_day_from(){

        var from_tuesday_day = $("#from_tuesday_day").val();

        if(from_tuesday_day == 0){
            $("#from_tuesday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_tuesday_day_error").show();
            $("#from_tuesday_day").focus();
            document.getElementById("from_tuesday_day").style.borderColor = "red";
            error_from_tuesday_day = true;
        }else{
            $("#from_tuesday_day_error").hide();
            document.getElementById("from_tuesday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - tuesday
    $("#from_tuesday_day").change(function () {
        $("#from_tuesday_day_error").hide();
        document.getElementById("from_tuesday_day").style.borderColor = "#ddd";
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#until_tuesday_day_error").hide();

    // -- Disable all errors --//
    var error_until_tuesday_day = false;

    function check_tuesday_day_until(){

        var from_tuesday_day = $("#from_tuesday_day").val();
        var until_tuesday_day = $("#until_tuesday_day").val();

        if(until_tuesday_day == 0){
            $("#until_tuesday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_tuesday_day_error").show();
            $("#until_tuesday_day").focus();
            document.getElementById("until_tuesday_day").style.borderColor = "red";
            error_until_tuesday_day = true;
        }else if(from_tuesday_day>until_tuesday_day || from_tuesday_day==until_tuesday_day){
            $("#until_tuesday_day_error").html("Μη έγκυρη τιμή");
            $("#until_tuesday_day_error").show();
            $("#until_tuesday_day").focus();
            document.getElementById("until_tuesday_day").style.borderColor = "red";
            error_until_tuesday_day = true;
        }else{
            $("#until_tuesday_day_error").hide();
            document.getElementById("until_tuesday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - tuesday
    $("#until_tuesday_day").change(function () {
        $("#until_tuesday_day_error").hide();
        document.getElementById("until_tuesday_day").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#from_tuesday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_from_tuesday_day_extra = false;

    function check_tuesday_day_extra_from(){

        var from_tuesday_day_extra = $("#from_tuesday_day_extra").val();
        var until_tuesday_day = $("#until_tuesday_day").val();

        if(from_tuesday_day_extra == 0){
            $("#from_tuesday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_tuesday_day_extra_error").show();
            $("#from_tuesday_day_extra").focus();
            document.getElementById("from_tuesday_day_extra").style.borderColor = "red";
            error_from_tuesday_day_extra = true;
        }else if(until_tuesday_day>from_tuesday_day_extra || from_tuesday_day_extra==until_tuesday_day){
            $("#from_tuesday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#from_tuesday_day_extra_error").show();
            $("#from_tuesday_day_extra").focus();
            document.getElementById("from_tuesday_day_extra").style.borderColor = "red";
            error_from_tuesday_day_extra = true;
        }else{
            $("#from_tuesday_day_extra_error").hide();
            document.getElementById("from_tuesday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - tuesday
    $("#from_tuesday_day_extra").change(function () {
        $("#from_tuesday_day_extra_error").hide();
        document.getElementById("from_tuesday_day_extra").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#until_tuesday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_until_tuesday_day_extra = false;

    function check_tuesday_day_extra_until(){

        var from_tuesday_day_extra = $("#from_tuesday_day_extra").val();
        var until_tuesday_day_extra = $("#until_tuesday_day_extra").val();

        if(until_tuesday_day_extra == 0){
            $("#until_tuesday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_tuesday_day_extra_error").show();
            $("#until_tuesday_day_extra").focus();
            document.getElementById("until_tuesday_day_extra").style.borderColor = "red";
            error_until_tuesday_day_extra = true;
        }else if(from_tuesday_day_extra>until_tuesday_day_extra || from_tuesday_day_extra==until_tuesday_day_extra){
            $("#until_tuesday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#until_tuesday_day_extra_error").show();
            $("#until_tuesday_day_extra").focus();
            document.getElementById("until_tuesday_day_extra").style.borderColor = "red";
            error_until_tuesday_day_extra = true;
        }else{
            $("#until_tuesday_day_extra_error").hide();
            document.getElementById("until_tuesday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - tuesday
    $("#until_tuesday_day_extra").change(function () {
        $("#until_tuesday_day_extra_error").hide();
        document.getElementById("until_tuesday_day_extra").style.borderColor = "#ddd";
    });

    $('#btn_save_tuesday_day').click(function () {

        error_from_tuesday_day = false;
        error_until_tuesday_day = false;
        error_from_tuesday_day_extra = false;
        error_until_tuesday_day_extra = false;

        var groomer_email = $('#session_email').val();

        var day_id = $("#date option:selected").attr('id');

        var from_tuesday_day = $("#from_tuesday_day option:selected").val();
        var until_tuesday_day = $("#until_tuesday_day option:selected").val();

        var from_tuesday_day_extra = $("#from_tuesday_day_extra option:selected").val();
        var until_tuesday_day_extra = $("#until_tuesday_day_extra option:selected").val();

        var isOpenChecked = $('#tuesday_day_open').is(':checked');
        var isOpenCheckedExtra = $('#tuesday_day_extra_open').is(':checked');

        var isClosedChecked = $('#tuesday_day_closed').is(':checked');

        var isOpenedCollapse = $('#collapseExtraVardiaTuesday').attr("aria-expanded", true);

        if(isOpenChecked){
            check_tuesday_day_from();
            check_tuesday_day_until();
        }
        if(isOpenCheckedExtra){
            check_tuesday_day_extra_from();
            check_tuesday_day_extra_until();
        }

        if(isClosedChecked){

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    closed_tuesday_hours:1,
                    groomer_email:groomer_email,day_id:day_id,
                    from_tuesday_day:from_tuesday_day,until_tuesday_day:until_tuesday_day,
                    from_tuesday_day_extra:from_tuesday_day_extra,until_tuesday_day_extra:until_tuesday_day_extra
                },
                success: function(response){
                    if(response.indexOf('update_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο της Τρίτης ενημερώθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_tuesday_day").style.borderColor = "#ddd";
                        document.getElementById("until_tuesday_day").style.borderColor = "#ddd";
                        document.getElementById("from_tuesday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_tuesday_day_extra").style.borderColor = "#ddd";
                    }

                    if(response.indexOf('insert_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο της Τρίτης καταχωρήθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_tuesday_day").style.borderColor = "#ddd";
                        document.getElementById("until_tuesday_day").style.borderColor = "#ddd";
                        document.getElementById("from_tuesday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_tuesday_day_extra").style.borderColor = "#ddd";
                    }
                }
            });

        }


        if(isOpenChecked){

            if(isOpenedCollapse){
                if (error_from_tuesday_day == 0 && error_until_tuesday_day == 0 && error_from_tuesday_day_extra == 0 && error_until_tuesday_day_extra == 0) {
                    $.ajax({
                        url:'../../groomer/groomer_server.php',
                        type: 'post',
                        data:{
                            opened_tuesday_hours:1,
                            groomer_email:groomer_email,day_id:day_id,
                            from_tuesday_day:from_tuesday_day,until_tuesday_day:until_tuesday_day,
                            from_tuesday_day_extra:from_tuesday_day_extra,until_tuesday_day_extra:until_tuesday_day_extra
                        },
                        success: function(response){
                            if(response.indexOf('update_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο της Τρίτης ενημερώθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                                document.getElementById("from_tuesday_day").style.borderColor = "#ddd";
                                document.getElementById("until_tuesday_day").style.borderColor = "#ddd";
                                document.getElementById("from_tuesday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_tuesday_day_extra").style.borderColor = "#ddd";
                            }

                            if(response.indexOf('insert_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο της Τρίτης καταχωρήθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                                document.getElementById("from_tuesday_day").style.borderColor = "#ddd";
                                document.getElementById("until_tuesday_day").style.borderColor = "#ddd";
                                document.getElementById("from_tuesday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_tuesday_day_extra").style.borderColor = "#ddd";
                            }
                        }
                    });
                    return true;
                }else{
                    return false;
                }
            }

            if (error_from_tuesday_day == 0 && error_until_tuesday_day == 0) {
                $.ajax({
                    url:'../../groomer/groomer_server.php',
                    type: 'post',
                    data:{
                        opened_tuesday_hours:1,
                        groomer_email:groomer_email,day_id:day_id,
                        from_tuesday_day:from_tuesday_day,until_tuesday_day:until_tuesday_day,
                        from_tuesday_day_extra:from_tuesday_day_extra,until_tuesday_day_extra:until_tuesday_day_extra
                    },
                    success: function(response){
                        if(response.indexOf('update_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο της Τρίτης ενημερώθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_tuesday_day").style.borderColor = "#ddd";
                            document.getElementById("until_tuesday_day").style.borderColor = "#ddd";
                            document.getElementById("from_tuesday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_tuesday_day_extra").style.borderColor = "#ddd";
                        }

                        if(response.indexOf('insert_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο της Τρίτης καταχωρήθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_tuesday_day").style.borderColor = "#ddd";
                            document.getElementById("until_tuesday_day").style.borderColor = "#ddd";
                            document.getElementById("from_tuesday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_tuesday_day_extra").style.borderColor = "#ddd";
                        }
                    }
                });
                return true;
            }else{
                return false;
            }

        }

    });

    //---------------------------------END JAVASCRIPT FOR TUESDAY ------------------------------------------//
    //---------------------------------START JAVASCRIPT FOR WEDNESDAY --------------------------------------//

    //Default Selected Option -> Closed
    //Disable Selected Option
    $("#from_wednesday_day").prop("disabled", true);
    $("#until_wednesday_day").prop("disabled", true);
    $("#from_wednesday_day_extra").prop("disabled", true);
    $("#until_wednesday_day_extra").prop("disabled", true);
    $("#btn_extra_vardia_wednesday").css("display", "none");

    //Disable-Enable Selected Option via Radio Button

    $('input:radio[id="wednesday_day_open"]').change(function () {
        $("#from_wednesday_day").prop("disabled", false);
        $("#until_wednesday_day").prop("disabled", false);
        $("#btn_extra_vardia_wednesday").css("display", "unset");
    });

    $('input:radio[id="wednesday_day_closed"]').change(function () {
        $("#from_wednesday_day").prop("disabled", true);
        $("#until_wednesday_day").prop("disabled", true);
        $("#btn_extra_vardia_wednesday").css("display", "none");
        //Hide Error When Select: Open -> Closed
        $("#from_wednesday_day_error").hide();
        $("#until_wednesday_day_error").hide();
        document.getElementById("from_wednesday_day").style.borderColor = "#ddd";
        document.getElementById("until_wednesday_day").style.borderColor = "#ddd";
        $("#from_wednesday_day_extra").prop("disabled", true);
        $("#until_wednesday_day_extra").prop("disabled", true);
        $("#collapseExtraVardiaWednesday").removeClass('collapse show').addClass('collapse');
        $("#wednesday_day_extra_closed").prop("checked", true);
        $("#from_wednesday_day").val(0);
        $("#until_wednesday_day").val(0);
        $("#from_wednesday_day_extra").val(0);
        $("#until_wednesday_day_extra").val(0);
        $("#btn_icon_wednesday").removeClass('fa-minus');

    });

    $('input:radio[id="wednesday_day_extra_open"]').change(function () {
        $("#from_wednesday_day_extra").prop("disabled", false);
        $("#until_wednesday_day_extra").prop("disabled", false);
    });

    $('input:radio[id="wednesday_day_extra_closed"]').change(function () {
        $("#from_wednesday_day_extra").prop("disabled", true);
        $("#until_wednesday_day_extra").prop("disabled", true);
        $("#from_wednesday_day_extra_error").hide();
        $("#until_wednesday_day_extra_error").hide();
        document.getElementById("from_wednesday_day_extra").style.borderColor = "#ddd";
        document.getElementById("until_wednesday_day_extra").style.borderColor = "#ddd";
        $("#from_wednesday_day_extra").val(0);
        $("#until_wednesday_day_extra").val(0);
        $("#collapseExtraVardiaWednesday").removeClass('collapse show').addClass('collapse');
        $("#btn_icon_wednesday").toggleClass('fa-minus');
    });

    //Change Icon When Button Collapsed Pressed

    $('#btn_extra_vardia_wednesday').click(function () {
        $("#btn_icon_wednesday").toggleClass('fa-minus');
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#from_wednesday_day_error").hide();

    // -- Disable all errors --//
    var error_from_wednesday_day = false;

    function check_wednesday_day_from(){

        var from_wednesday_day = $("#from_wednesday_day").val();

        if(from_wednesday_day == 0){
            $("#from_wednesday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_wednesday_day_error").show();
            $("#from_wednesday_day").focus();
            document.getElementById("from_wednesday_day").style.borderColor = "red";
            error_from_wednesday_day = true;
        }else{
            $("#from_wednesday_day_error").hide();
            document.getElementById("from_wednesday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - wednesday
    $("#from_wednesday_day").change(function () {
        $("#from_wednesday_day_error").hide();
        document.getElementById("from_wednesday_day").style.borderColor = "#ddd";
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#until_wednesday_day_error").hide();

    // -- Disable all errors --//
    var error_until_wednesday_day = false;

    function check_wednesday_day_until(){

        var from_wednesday_day = $("#from_wednesday_day").val();
        var until_wednesday_day = $("#until_wednesday_day").val();

        if(until_wednesday_day == 0){
            $("#until_wednesday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_wednesday_day_error").show();
            $("#until_wednesday_day").focus();
            document.getElementById("until_wednesday_day").style.borderColor = "red";
            error_until_wednesday_day = true;
        }else if(from_wednesday_day>until_wednesday_day || from_wednesday_day==until_wednesday_day){
            $("#until_wednesday_day_error").html("Μη έγκυρη τιμή");
            $("#until_wednesday_day_error").show();
            $("#until_wednesday_day").focus();
            document.getElementById("until_wednesday_day").style.borderColor = "red";
            error_until_wednesday_day = true;
        }else{
            $("#until_wednesday_day_error").hide();
            document.getElementById("until_wednesday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - wednesday
    $("#until_wednesday_day").change(function () {
        $("#until_wednesday_day_error").hide();
        document.getElementById("until_wednesday_day").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#from_wednesday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_from_wednesday_day_extra = false;

    function check_wednesday_day_extra_from(){

        var from_wednesday_day_extra = $("#from_wednesday_day_extra").val();
        var until_wednesday_day = $("#until_wednesday_day").val();

        if(from_wednesday_day_extra == 0){
            $("#from_wednesday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_wednesday_day_extra_error").show();
            $("#from_wednesday_day_extra").focus();
            document.getElementById("from_wednesday_day_extra").style.borderColor = "red";
            error_from_wednesday_day_extra = true;
        }else if(until_wednesday_day>from_wednesday_day_extra || from_wednesday_day_extra==until_wednesday_day){
            $("#from_wednesday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#from_wednesday_day_extra_error").show();
            $("#from_wednesday_day_extra").focus();
            document.getElementById("from_wednesday_day_extra").style.borderColor = "red";
            error_from_wednesday_day_extra = true;
        }else{
            $("#from_wednesday_day_extra_error").hide();
            document.getElementById("from_wednesday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - wednesday
    $("#from_wednesday_day_extra").change(function () {
        $("#from_wednesday_day_extra_error").hide();
        document.getElementById("from_wednesday_day_extra").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#until_wednesday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_until_wednesday_day_extra = false;

    function check_wednesday_day_extra_until(){

        var from_wednesday_day_extra = $("#from_wednesday_day_extra").val();
        var until_wednesday_day_extra = $("#until_wednesday_day_extra").val();

        if(until_wednesday_day_extra == 0){
            $("#until_wednesday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_wednesday_day_extra_error").show();
            $("#until_wednesday_day_extra").focus();
            document.getElementById("until_wednesday_day_extra").style.borderColor = "red";
            error_until_wednesday_day_extra = true;
        }else if(from_wednesday_day_extra>until_wednesday_day_extra || from_wednesday_day_extra==until_wednesday_day_extra){
            $("#until_wednesday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#until_wednesday_day_extra_error").show();
            $("#until_wednesday_day_extra").focus();
            document.getElementById("until_wednesday_day_extra").style.borderColor = "red";
            error_until_wednesday_day_extra = true;
        }else{
            $("#until_wednesday_day_extra_error").hide();
            document.getElementById("until_wednesday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - wednesday
    $("#until_wednesday_day_extra").change(function () {
        $("#until_wednesday_day_extra_error").hide();
        document.getElementById("until_wednesday_day_extra").style.borderColor = "#ddd";
    });

    $('#btn_save_wednesday_day').click(function () {

        error_from_wednesday_day = false;
        error_until_wednesday_day = false;
        error_from_wednesday_day_extra = false;
        error_until_wednesday_day_extra = false;

        var groomer_email = $('#session_email').val();

        var day_id = $("#date option:selected").attr('id');

        var from_wednesday_day = $("#from_wednesday_day option:selected").val();
        var until_wednesday_day = $("#until_wednesday_day option:selected").val();

        var from_wednesday_day_extra = $("#from_wednesday_day_extra option:selected").val();
        var until_wednesday_day_extra = $("#until_wednesday_day_extra option:selected").val();

        var isOpenChecked = $('#wednesday_day_open').is(':checked');
        var isOpenCheckedExtra = $('#wednesday_day_extra_open').is(':checked');

        var isClosedChecked = $('#wednesday_day_closed').is(':checked');

        var isOpenedCollapse = $('#collapseExtraVardiawednesday').attr("aria-expanded", true);

        if(isOpenChecked){
            check_wednesday_day_from();
            check_wednesday_day_until();
        }
        if(isOpenCheckedExtra){
            check_wednesday_day_extra_from();
            check_wednesday_day_extra_until();
        }

        if(isClosedChecked){

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    closed_wednesday_hours:1,
                    groomer_email:groomer_email,day_id:day_id,
                    from_wednesday_day:from_wednesday_day,until_wednesday_day:until_wednesday_day,
                    from_wednesday_day_extra:from_wednesday_day_extra,until_wednesday_day_extra:until_wednesday_day_extra
                },
                success: function(response){
                    if(response.indexOf('update_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο της Τετάρτης ενημερώθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_wednesday_day").style.borderColor = "#ddd";
                        document.getElementById("until_wednesday_day").style.borderColor = "#ddd";
                        document.getElementById("from_wednesday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_wednesday_day_extra").style.borderColor = "#ddd";
                    }

                    if(response.indexOf('insert_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο της Τετάρτης καταχωρήθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_wednesday_day").style.borderColor = "#ddd";
                        document.getElementById("until_wednesday_day").style.borderColor = "#ddd";
                        document.getElementById("from_wednesday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_wednesday_day_extra").style.borderColor = "#ddd";
                    }
                }
            });

        }


        if(isOpenChecked){

            if(isOpenedCollapse){
                if (error_from_wednesday_day == 0 && error_until_wednesday_day == 0 && error_from_wednesday_day_extra == 0 && error_until_wednesday_day_extra == 0) {
                    $.ajax({
                        url:'../../groomer/groomer_server.php',
                        type: 'post',
                        data:{
                            opened_wednesday_hours:1,
                            groomer_email:groomer_email,day_id:day_id,
                            from_wednesday_day:from_wednesday_day,until_wednesday_day:until_wednesday_day,
                            from_wednesday_day_extra:from_wednesday_day_extra,until_wednesday_day_extra:until_wednesday_day_extra
                        },
                        success: function(response){
                            if(response.indexOf('update_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο της Τετάρτης ενημερώθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                                document.getElementById("from_wednesday_day").style.borderColor = "#ddd";
                                document.getElementById("until_wednesday_day").style.borderColor = "#ddd";
                                document.getElementById("from_wednesday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_wednesday_day_extra").style.borderColor = "#ddd";
                            }

                            if(response.indexOf('insert_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο της Τετάρτης καταχωρήθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                                document.getElementById("from_wednesday_day").style.borderColor = "#ddd";
                                document.getElementById("until_wednesday_day").style.borderColor = "#ddd";
                                document.getElementById("from_wednesday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_wednesday_day_extra").style.borderColor = "#ddd";
                            }
                        }
                    });
                    return true;
                }else{
                    return false;
                }
            }

            if (error_from_wednesday_day == 0 && error_until_wednesday_day == 0) {
                $.ajax({
                    url:'../../groomer/groomer_server.php',
                    type: 'post',
                    data:{
                        opened_wednesday_hours:1,
                        groomer_email:groomer_email,day_id:day_id,
                        from_wednesday_day:from_wednesday_day,until_wednesday_day:until_wednesday_day,
                        from_wednesday_day_extra:from_wednesday_day_extra,until_wednesday_day_extra:until_wednesday_day_extra
                    },
                    success: function(response){
                        if(response.indexOf('update_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο της Τετάρτης ενημερώθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_wednesday_day").style.borderColor = "#ddd";
                            document.getElementById("until_wednesday_day").style.borderColor = "#ddd";
                            document.getElementById("from_wednesday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_wednesday_day_extra").style.borderColor = "#ddd";
                        }

                        if(response.indexOf('insert_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο της Τετάρτης καταχωρήθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_wednesday_day").style.borderColor = "#ddd";
                            document.getElementById("until_wednesday_day").style.borderColor = "#ddd";
                            document.getElementById("from_wednesday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_wednesday_day_extra").style.borderColor = "#ddd";
                        }
                    }
                });
                return true;
            }else{
                return false;
            }

        }

    });

    //---------------------------------END JAVASCRIPT FOR WEDNESDAY ----------------------------------------//
    //---------------------------------START JAVASCRIPT FOR THURSDAY --------------------------------------//

    //Default Selected Option -> Closed
    //Disable Selected Option
    $("#from_thursday_day").prop("disabled", true);
    $("#until_thursday_day").prop("disabled", true);
    $("#from_thursday_day_extra").prop("disabled", true);
    $("#until_thursday_day_extra").prop("disabled", true);
    $("#btn_extra_vardia_thursday").css("display", "none");

    //Disable-Enable Selected Option via Radio Button

    $('input:radio[id="thursday_day_open"]').change(function () {
        $("#from_thursday_day").prop("disabled", false);
        $("#until_thursday_day").prop("disabled", false);
        $("#btn_extra_vardia_thursday").css("display", "unset");
    });

    $('input:radio[id="thursday_day_closed"]').change(function () {
        $("#from_thursday_day").prop("disabled", true);
        $("#until_thursday_day").prop("disabled", true);
        $("#btn_extra_vardia_thursday").css("display", "none");
        //Hide Error When Select: Open -> Closed
        $("#from_thursday_day_error").hide();
        $("#until_thursday_day_error").hide();
        document.getElementById("from_thursday_day").style.borderColor = "#ddd";
        document.getElementById("until_thursday_day").style.borderColor = "#ddd";
        $("#from_thursday_day_extra").prop("disabled", true);
        $("#until_thursday_day_extra").prop("disabled", true);
        $("#collapseExtraVardiaThursday").removeClass('collapse show').addClass('collapse');
        $("#thursday_day_extra_closed").prop("checked", true);
        $("#from_thursday_day").val(0);
        $("#until_thursday_day").val(0);
        $("#from_thursday_day_extra").val(0);
        $("#until_thursday_day_extra").val(0);
        $("#btn_icon_thursday").removeClass('fa-minus');

    });

    $('input:radio[id="thursday_day_extra_open"]').change(function () {
        $("#from_thursday_day_extra").prop("disabled", false);
        $("#until_thursday_day_extra").prop("disabled", false);
    });

    $('input:radio[id="thursday_day_extra_closed"]').change(function () {
        $("#from_thursday_day_extra").prop("disabled", true);
        $("#until_thursday_day_extra").prop("disabled", true);
        $("#from_thursday_day_extra_error").hide();
        $("#until_thursday_day_extra_error").hide();
        document.getElementById("from_thursday_day_extra").style.borderColor = "#ddd";
        document.getElementById("until_thursday_day_extra").style.borderColor = "#ddd";
        $("#from_thursday_day_extra").val(0);
        $("#until_thursday_day_extra").val(0);
        $("#collapseExtraVardiaThursday").removeClass('collapse show').addClass('collapse');
        $("#btn_icon_thursday").toggleClass('fa-minus');
    });

    //Change Icon When Button Collapsed Pressed

    $('#btn_extra_vardia_thursday').click(function () {
        $("#btn_icon_thursday").toggleClass('fa-minus');
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#from_thursday_day_error").hide();

    // -- Disable all errors --//
    var error_from_thursday_day = false;

    function check_thursday_day_from(){

        var from_thursday_day = $("#from_thursday_day").val();

        if(from_thursday_day == 0){
            $("#from_thursday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_thursday_day_error").show();
            $("#from_thursday_day").focus();
            document.getElementById("from_thursday_day").style.borderColor = "red";
            error_from_thursday_day = true;
        }else{
            $("#from_thursday_day_error").hide();
            document.getElementById("from_thursday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - thursday
    $("#from_thursday_day").change(function () {
        $("#from_thursday_day_error").hide();
        document.getElementById("from_thursday_day").style.borderColor = "#ddd";
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#until_thursday_day_error").hide();

    // -- Disable all errors --//
    var error_until_thursday_day = false;

    function check_thursday_day_until(){

        var from_thursday_day = $("#from_thursday_day").val();
        var until_thursday_day = $("#until_thursday_day").val();

        if(until_thursday_day == 0){
            $("#until_thursday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_thursday_day_error").show();
            $("#until_thursday_day").focus();
            document.getElementById("until_thursday_day").style.borderColor = "red";
            error_until_thursday_day = true;
        }else if(from_thursday_day>until_thursday_day || from_thursday_day==until_thursday_day){
            $("#until_thursday_day_error").html("Μη έγκυρη τιμή");
            $("#until_thursday_day_error").show();
            $("#until_thursday_day").focus();
            document.getElementById("until_thursday_day").style.borderColor = "red";
            error_until_thursday_day = true;
        }else{
            $("#until_thursday_day_error").hide();
            document.getElementById("until_thursday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - thursday
    $("#until_thursday_day").change(function () {
        $("#until_thursday_day_error").hide();
        document.getElementById("until_thursday_day").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#from_thursday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_from_thursday_day_extra = false;

    function check_thursday_day_extra_from(){

        var from_thursday_day_extra = $("#from_thursday_day_extra").val();
        var until_thursday_day = $("#until_thursday_day").val();

        if(from_thursday_day_extra == 0){
            $("#from_thursday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_thursday_day_extra_error").show();
            $("#from_thursday_day_extra").focus();
            document.getElementById("from_thursday_day_extra").style.borderColor = "red";
            error_from_thursday_day_extra = true;
        }else if(until_thursday_day>from_thursday_day_extra || from_thursday_day_extra==until_thursday_day){
            $("#from_thursday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#from_thursday_day_extra_error").show();
            $("#from_thursday_day_extra").focus();
            document.getElementById("from_thursday_day_extra").style.borderColor = "red";
            error_from_thursday_day_extra = true;
        }else{
            $("#from_thursday_day_extra_error").hide();
            document.getElementById("from_thursday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - thursday
    $("#from_thursday_day_extra").change(function () {
        $("#from_thursday_day_extra_error").hide();
        document.getElementById("from_thursday_day_extra").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#until_thursday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_until_thursday_day_extra = false;

    function check_thursday_day_extra_until(){

        var from_thursday_day_extra = $("#from_thursday_day_extra").val();
        var until_thursday_day_extra = $("#until_thursday_day_extra").val();

        if(until_thursday_day_extra == 0){
            $("#until_thursday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_thursday_day_extra_error").show();
            $("#until_thursday_day_extra").focus();
            document.getElementById("until_thursday_day_extra").style.borderColor = "red";
            error_until_thursday_day_extra = true;
        }else if(from_thursday_day_extra>until_thursday_day_extra || from_thursday_day_extra==until_thursday_day_extra){
            $("#until_thursday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#until_thursday_day_extra_error").show();
            $("#until_thursday_day_extra").focus();
            document.getElementById("until_thursday_day_extra").style.borderColor = "red";
            error_until_thursday_day_extra = true;
        }else{
            $("#until_thursday_day_extra_error").hide();
            document.getElementById("until_thursday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - thursday
    $("#until_thursday_day_extra").change(function () {
        $("#until_thursday_day_extra_error").hide();
        document.getElementById("until_thursday_day_extra").style.borderColor = "#ddd";
    });

    $('#btn_save_thursday_day').click(function () {

        error_from_thursday_day = false;
        error_until_thursday_day = false;
        error_from_thursday_day_extra = false;
        error_until_thursday_day_extra = false;

        var groomer_email = $('#session_email').val();

        var day_id = $("#date option:selected").attr('id');

        var from_thursday_day = $("#from_thursday_day option:selected").val();
        var until_thursday_day = $("#until_thursday_day option:selected").val();

        var from_thursday_day_extra = $("#from_thursday_day_extra option:selected").val();
        var until_thursday_day_extra = $("#until_thursday_day_extra option:selected").val();

        var isOpenChecked = $('#thursday_day_open').is(':checked');
        var isOpenCheckedExtra = $('#thursday_day_extra_open').is(':checked');

        var isClosedChecked = $('#thursday_day_closed').is(':checked');

        var isOpenedCollapse = $('#collapseExtraVardiathursday').attr("aria-expanded", true);

        if(isOpenChecked){
            check_thursday_day_from();
            check_thursday_day_until();
        }
        if(isOpenCheckedExtra){
            check_thursday_day_extra_from();
            check_thursday_day_extra_until();
        }

        if(isClosedChecked){

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    closed_thursday_hours:1,
                    groomer_email:groomer_email,day_id:day_id,
                    from_thursday_day:from_thursday_day,until_thursday_day:until_thursday_day,
                    from_thursday_day_extra:from_thursday_day_extra,until_thursday_day_extra:until_thursday_day_extra
                },
                success: function(response){
                    if(response.indexOf('update_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο της Πέμπτης ενημερώθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_thursday_day").style.borderColor = "#ddd";
                        document.getElementById("until_thursday_day").style.borderColor = "#ddd";
                        document.getElementById("from_thursday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_thursday_day_extra").style.borderColor = "#ddd";
                    }

                    if(response.indexOf('insert_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο της Πέμπτης καταχωρήθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_thursday_day").style.borderColor = "#ddd";
                        document.getElementById("until_thursday_day").style.borderColor = "#ddd";
                        document.getElementById("from_thursday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_thursday_day_extra").style.borderColor = "#ddd";
                    }
                }
            });

        }


        if(isOpenChecked){

            if(isOpenedCollapse){
                if (error_from_thursday_day == 0 && error_until_thursday_day == 0 && error_from_thursday_day_extra == 0 && error_until_thursday_day_extra == 0) {
                    $.ajax({
                        url:'../../groomer/groomer_server.php',
                        type: 'post',
                        data:{
                            opened_thursday_hours:1,
                            groomer_email:groomer_email,day_id:day_id,
                            from_thursday_day:from_thursday_day,until_thursday_day:until_thursday_day,
                            from_thursday_day_extra:from_thursday_day_extra,until_thursday_day_extra:until_thursday_day_extra
                        },
                        success: function(response){
                            if(response.indexOf('update_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο της Πέμπτης ενημερώθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                                document.getElementById("from_thursday_day").style.borderColor = "#ddd";
                                document.getElementById("until_thursday_day").style.borderColor = "#ddd";
                                document.getElementById("from_thursday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_thursday_day_extra").style.borderColor = "#ddd";
                            }

                            if(response.indexOf('insert_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο της Πέμπτης καταχωρήθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                                document.getElementById("from_thursday_day").style.borderColor = "#ddd";
                                document.getElementById("until_thursday_day").style.borderColor = "#ddd";
                                document.getElementById("from_thursday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_thursday_day_extra").style.borderColor = "#ddd";
                            }
                        }
                    });
                    return true;
                }else{
                    return false;
                }
            }

            if (error_from_thursday_day == 0 && error_until_thursday_day == 0) {
                $.ajax({
                    url:'../../groomer/groomer_server.php',
                    type: 'post',
                    data:{
                        opened_thursday_hours:1,
                        groomer_email:groomer_email,day_id:day_id,
                        from_thursday_day:from_thursday_day,until_thursday_day:until_thursday_day,
                        from_thursday_day_extra:from_thursday_day_extra,until_thursday_day_extra:until_thursday_day_extra
                    },
                    success: function(response){
                        if(response.indexOf('update_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο της Πέμπτης ενημερώθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_thursday_day").style.borderColor = "#ddd";
                            document.getElementById("until_thursday_day").style.borderColor = "#ddd";
                            document.getElementById("from_thursday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_thursday_day_extra").style.borderColor = "#ddd";
                        }

                        if(response.indexOf('insert_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο της Πέμπτης καταχωρήθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_thursday_day").style.borderColor = "#ddd";
                            document.getElementById("until_thursday_day").style.borderColor = "#ddd";
                            document.getElementById("from_thursday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_thursday_day_extra").style.borderColor = "#ddd";
                        }
                    }
                });
                return true;
            }else{
                return false;
            }

        }

    });

    //---------------------------------END JAVASCRIPT FOR THURSDAY ---------------------------------------//
    //---------------------------------START JAVASCRIPT FOR FRIDAY --------------------------------------//

    //Default Selected Option -> Closed
    //Disable Selected Option
    $("#from_friday_day").prop("disabled", true);
    $("#until_friday_day").prop("disabled", true);
    $("#from_friday_day_extra").prop("disabled", true);
    $("#until_friday_day_extra").prop("disabled", true);
    $("#btn_extra_vardia_friday").css("display", "none");

    //Disable-Enable Selected Option via Radio Button

    $('input:radio[id="friday_day_open"]').change(function () {
        $("#from_friday_day").prop("disabled", false);
        $("#until_friday_day").prop("disabled", false);
        $("#btn_extra_vardia_friday").css("display", "unset");
    });

    $('input:radio[id="friday_day_closed"]').change(function () {
        $("#from_friday_day").prop("disabled", true);
        $("#until_friday_day").prop("disabled", true);
        $("#btn_extra_vardia_friday").css("display", "none");
        //Hide Error When Select: Open -> Closed
        $("#from_friday_day_error").hide();
        $("#until_friday_day_error").hide();
        document.getElementById("from_friday_day").style.borderColor = "#ddd";
        document.getElementById("until_friday_day").style.borderColor = "#ddd";
        $("#from_friday_day_extra").prop("disabled", true);
        $("#until_friday_day_extra").prop("disabled", true);
        $("#collapseExtraVardiaFriday").removeClass('collapse show').addClass('collapse');
        $("#friday_day_extra_closed").prop("checked", true);
        $("#from_friday_day").val(0);
        $("#until_friday_day").val(0);
        $("#from_friday_day_extra").val(0);
        $("#until_friday_day_extra").val(0);
        $("#btn_icon_friday").removeClass('fa-minus');

    });

    $('input:radio[id="friday_day_extra_open"]').change(function () {
        $("#from_friday_day_extra").prop("disabled", false);
        $("#until_friday_day_extra").prop("disabled", false);
    });

    $('input:radio[id="friday_day_extra_closed"]').change(function () {
        $("#from_friday_day_extra").prop("disabled", true);
        $("#until_friday_day_extra").prop("disabled", true);
        $("#from_friday_day_extra_error").hide();
        $("#until_friday_day_extra_error").hide();
        document.getElementById("from_friday_day_extra").style.borderColor = "#ddd";
        document.getElementById("until_friday_day_extra").style.borderColor = "#ddd";
        $("#from_friday_day_extra").val(0);
        $("#until_friday_day_extra").val(0);
        $("#collapseExtraVardiaFriday").removeClass('collapse show').addClass('collapse');
        $("#btn_icon_friday").toggleClass('fa-minus');
    });

    //Change Icon When Button Collapsed Pressed

    $('#btn_extra_vardia_friday').click(function () {
        $("#btn_icon_friday").toggleClass('fa-minus');
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#from_friday_day_error").hide();

    // -- Disable all errors --//
    var error_from_friday_day = false;

    function check_friday_day_from(){

        var from_friday_day = $("#from_friday_day").val();

        if(from_friday_day == 0){
            $("#from_friday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_friday_day_error").show();
            $("#from_friday_day").focus();
            document.getElementById("from_friday_day").style.borderColor = "red";
            error_from_friday_day = true;
        }else{
            $("#from_friday_day_error").hide();
            document.getElementById("from_friday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - friday
    $("#from_friday_day").change(function () {
        $("#from_friday_day_error").hide();
        document.getElementById("from_friday_day").style.borderColor = "#ddd";
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#until_friday_day_error").hide();

    // -- Disable all errors --//
    var error_until_friday_day = false;

    function check_friday_day_until(){

        var from_friday_day = $("#from_friday_day").val();
        var until_friday_day = $("#until_friday_day").val();

        if(until_friday_day == 0){
            $("#until_friday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_friday_day_error").show();
            $("#until_friday_day").focus();
            document.getElementById("until_friday_day").style.borderColor = "red";
            error_until_friday_day = true;
        }else if(from_friday_day>until_friday_day || from_friday_day==until_friday_day){
            $("#until_friday_day_error").html("Μη έγκυρη τιμή");
            $("#until_friday_day_error").show();
            $("#until_friday_day").focus();
            document.getElementById("until_friday_day").style.borderColor = "red";
            error_until_friday_day = true;
        }else{
            $("#until_friday_day_error").hide();
            document.getElementById("until_friday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - friday
    $("#until_friday_day").change(function () {
        $("#until_friday_day_error").hide();
        document.getElementById("until_friday_day").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#from_friday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_from_friday_day_extra = false;

    function check_friday_day_extra_from(){

        var from_friday_day_extra = $("#from_friday_day_extra").val();
        var until_friday_day = $("#until_friday_day").val();


        if(from_friday_day_extra == 0){
            $("#from_friday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_friday_day_extra_error").show();
            $("#from_friday_day_extra").focus();
            document.getElementById("from_friday_day_extra").style.borderColor = "red";
            error_from_friday_day_extra = true;
        }else if(until_friday_day>from_friday_day_extra || from_friday_day_extra==until_friday_day){
            $("#from_friday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#from_friday_day_extra_error").show();
            $("#from_friday_day_extra").focus();
            document.getElementById("from_friday_day_extra").style.borderColor = "red";
            error_from_friday_day_extra = true;
        }else{
            $("#from_friday_day_extra_error").hide();
            document.getElementById("from_friday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - friday
    $("#from_friday_day_extra").change(function () {
        $("#from_friday_day_extra_error").hide();
        document.getElementById("from_friday_day_extra").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#until_friday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_until_friday_day_extra = false;

    function check_friday_day_extra_until(){

        var from_friday_day_extra = $("#from_friday_day_extra").val();
        var until_friday_day_extra = $("#until_friday_day_extra").val();

        if(until_friday_day_extra == 0){
            $("#until_friday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_friday_day_extra_error").show();
            $("#until_friday_day_extra").focus();
            document.getElementById("until_friday_day_extra").style.borderColor = "red";
            error_until_friday_day_extra = true;
        }else if(from_friday_day_extra>until_friday_day_extra || from_friday_day_extra==until_friday_day_extra){
            $("#until_friday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#until_friday_day_extra_error").show();
            $("#until_friday_day_extra").focus();
            document.getElementById("until_friday_day_extra").style.borderColor = "red";
            error_until_friday_day_extra = true;
        }else{
            $("#until_friday_day_extra_error").hide();
            document.getElementById("until_friday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - friday
    $("#until_friday_day_extra").change(function () {
        $("#until_friday_day_extra_error").hide();
        document.getElementById("until_friday_day_extra").style.borderColor = "#ddd";
    });

    $('#btn_save_friday_day').click(function () {

        error_from_friday_day = false;
        error_until_friday_day = false;
        error_from_friday_day_extra = false;
        error_until_friday_day_extra = false;

        var groomer_email = $('#session_email').val();

        var day_id = $("#date option:selected").attr('id');

        var from_friday_day = $("#from_friday_day option:selected").val();
        var until_friday_day = $("#until_friday_day option:selected").val();

        var from_friday_day_extra = $("#from_friday_day_extra option:selected").val();
        var until_friday_day_extra = $("#until_friday_day_extra option:selected").val();

        var isOpenChecked = $('#friday_day_open').is(':checked');
        var isOpenCheckedExtra = $('#friday_day_extra_open').is(':checked');

        var isClosedChecked = $('#friday_day_closed').is(':checked');

        var isOpenedCollapse = $('#collapseExtraVardiafriday').attr("aria-expanded", true);

        if(isOpenChecked){
            check_friday_day_from();
            check_friday_day_until();
        }
        if(isOpenCheckedExtra){
            check_friday_day_extra_from();
            check_friday_day_extra_until();
        }

        if(isClosedChecked){

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    closed_friday_hours:1,
                    groomer_email:groomer_email,day_id:day_id,
                    from_friday_day:from_friday_day,until_friday_day:until_friday_day,
                    from_friday_day_extra:from_friday_day_extra,until_friday_day_extra:until_friday_day_extra
                },
                success: function(response){
                    if(response.indexOf('update_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο της Παρασκευής ενημερώθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_friday_day").style.borderColor = "#ddd";
                        document.getElementById("until_friday_day").style.borderColor = "#ddd";
                        document.getElementById("from_friday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_friday_day_extra").style.borderColor = "#ddd";
                    }

                    if(response.indexOf('insert_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο της Παρασκευής καταχωρήθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_friday_day").style.borderColor = "#ddd";
                        document.getElementById("until_friday_day").style.borderColor = "#ddd";
                        document.getElementById("from_friday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_friday_day_extra").style.borderColor = "#ddd";
                    }
                }
            });

        }


        if(isOpenChecked){

            if(isOpenedCollapse){
                if (error_from_friday_day == 0 && error_until_friday_day == 0 && error_from_friday_day_extra == 0 && error_until_friday_day_extra == 0) {
                    $.ajax({
                        url:'../../groomer/groomer_server.php',
                        type: 'post',
                        data:{
                            opened_friday_hours:1,
                            groomer_email:groomer_email,day_id:day_id,
                            from_friday_day:from_friday_day,until_friday_day:until_friday_day,
                            from_friday_day_extra:from_friday_day_extra,until_friday_day_extra:until_friday_day_extra
                        },
                        success: function(response){
                            if(response.indexOf('update_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο της Παρασκευής ενημερώθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                                document.getElementById("from_friday_day").style.borderColor = "#ddd";
                                document.getElementById("until_friday_day").style.borderColor = "#ddd";
                                document.getElementById("from_friday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_friday_day_extra").style.borderColor = "#ddd";
                            }

                            if(response.indexOf('insert_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο της Παρασκευής καταχωρήθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                                document.getElementById("from_friday_day").style.borderColor = "#ddd";
                                document.getElementById("until_friday_day").style.borderColor = "#ddd";
                                document.getElementById("from_friday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_friday_day_extra").style.borderColor = "#ddd";
                            }
                        }
                    });
                    return true;
                }else{
                    return false;
                }
            }

            if (error_from_friday_day == 0 && error_until_friday_day == 0) {
                $.ajax({
                    url:'../../groomer/groomer_server.php',
                    type: 'post',
                    data:{
                        opened_friday_hours:1,
                        groomer_email:groomer_email,day_id:day_id,
                        from_friday_day:from_friday_day,until_friday_day:until_friday_day,
                        from_friday_day_extra:from_friday_day_extra,until_friday_day_extra:until_friday_day_extra
                    },
                    success: function(response){
                        if(response.indexOf('update_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο της Παρασκευής ενημερώθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_friday_day").style.borderColor = "#ddd";
                            document.getElementById("until_friday_day").style.borderColor = "#ddd";
                            document.getElementById("from_friday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_friday_day_extra").style.borderColor = "#ddd";
                        }

                        if(response.indexOf('insert_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο της Παρασκευής καταχωρήθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_friday_day").style.borderColor = "#ddd";
                            document.getElementById("until_friday_day").style.borderColor = "#ddd";
                            document.getElementById("from_friday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_friday_day_extra").style.borderColor = "#ddd";
                        }
                    }
                });
                return true;
            }else{
                return false;
            }

        }

    });

    //---------------------------------END JAVASCRIPT FOR FRIDAY ------------------------------------------//
    //---------------------------------START JAVASCRIPT FOR SATURDAY --------------------------------------//

    //Default Selected Option -> Closed
    //Disable Selected Option
    $("#from_saturday_day").prop("disabled", true);
    $("#until_saturday_day").prop("disabled", true);
    $("#from_saturday_day_extra").prop("disabled", true);
    $("#until_saturday_day_extra").prop("disabled", true);
    $("#btn_extra_vardia_saturday").css("display", "none");

    //Disable-Enable Selected Option via Radio Button

    $('input:radio[id="saturday_day_open"]').change(function () {
        $("#from_saturday_day").prop("disabled", false);
        $("#until_saturday_day").prop("disabled", false);
        $("#btn_extra_vardia_saturday").css("display", "unset");
    });

    $('input:radio[id="saturday_day_closed"]').change(function () {
        $("#from_saturday_day").prop("disabled", true);
        $("#until_saturday_day").prop("disabled", true);
        $("#btn_extra_vardia_saturday").css("display", "none");
        //Hide Error When Select: Open -> Closed
        $("#from_saturday_day_error").hide();
        $("#until_saturday_day_error").hide();
        document.getElementById("from_saturday_day").style.borderColor = "#ddd";
        document.getElementById("until_saturday_day").style.borderColor = "#ddd";
        $("#from_saturday_day_extra").prop("disabled", true);
        $("#until_saturday_day_extra").prop("disabled", true);
        $("#collapseExtraVardiaSaturday").removeClass('collapse show').addClass('collapse');
        $("#saturday_day_extra_closed").prop("checked", true);
        $("#from_saturday_day").val(0);
        $("#until_saturday_day").val(0);
        $("#from_saturday_day_extra").val(0);
        $("#until_saturday_day_extra").val(0);
        $("#btn_icon_saturday").removeClass('fa-minus');

    });

    $('input:radio[id="saturday_day_extra_open"]').change(function () {
        $("#from_saturday_day_extra").prop("disabled", false);
        $("#until_saturday_day_extra").prop("disabled", false);
    });

    $('input:radio[id="saturday_day_extra_closed"]').change(function () {
        $("#from_saturday_day_extra").prop("disabled", true);
        $("#until_saturday_day_extra").prop("disabled", true);
        $("#from_saturday_day_extra_error").hide();
        $("#until_saturday_day_extra_error").hide();
        document.getElementById("from_saturday_day_extra").style.borderColor = "#ddd";
        document.getElementById("until_saturday_day_extra").style.borderColor = "#ddd";
        $("#from_saturday_day_extra").val(0);
        $("#until_saturday_day_extra").val(0);
        $("#collapseExtraVardiaSaturday").removeClass('collapse show').addClass('collapse');
        $("#btn_icon_saturday").toggleClass('fa-minus');
    });

    //Change Icon When Button Collapsed Pressed

    $('#btn_extra_vardia_saturday').click(function () {
        $("#btn_icon_saturday").toggleClass('fa-minus');
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#from_saturday_day_error").hide();

    // -- Disable all errors --//
    var error_from_saturday_day = false;

    function check_saturday_day_from(){

        var from_saturday_day = $("#from_saturday_day").val();

        if(from_saturday_day == 0){
            $("#from_saturday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_saturday_day_error").show();
            $("#from_saturday_day").focus();
            document.getElementById("from_saturday_day").style.borderColor = "red";
            error_from_saturday_day = true;
        }else{
            $("#from_saturday_day_error").hide();
            document.getElementById("from_saturday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - saturday
    $("#from_saturday_day").change(function () {
        $("#from_saturday_day_error").hide();
        document.getElementById("from_saturday_day").style.borderColor = "#ddd";
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#until_saturday_day_error").hide();

    // -- Disable all errors --//
    var error_until_saturday_day = false;

    function check_saturday_day_until(){

        var from_saturday_day = $("#from_saturday_day").val();
        var until_saturday_day = $("#until_saturday_day").val();

        if(until_saturday_day == 0){
            $("#until_saturday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_saturday_day_error").show();
            $("#until_saturday_day").focus();
            document.getElementById("until_saturday_day").style.borderColor = "red";
            error_until_saturday_day = true;
        }else if(from_saturday_day>until_saturday_day || from_saturday_day==until_saturday_day){
            $("#until_saturday_day_error").html("Μη έγκυρη τιμή");
            $("#until_saturday_day_error").show();
            $("#until_saturday_day").focus();
            document.getElementById("until_saturday_day").style.borderColor = "red";
            error_until_saturday_day = true;
        }else{
            $("#until_saturday_day_error").hide();
            document.getElementById("until_saturday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - saturday
    $("#until_saturday_day").change(function () {
        $("#until_saturday_day_error").hide();
        document.getElementById("until_saturday_day").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#from_saturday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_from_saturday_day_extra = false;

    function check_saturday_day_extra_from(){

        var from_saturday_day_extra = $("#from_saturday_day_extra").val();
        var until_saturday_day = $("#until_saturday_day").val();


        if(from_saturday_day_extra == 0){
            $("#from_saturday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_saturday_day_extra_error").show();
            $("#from_saturday_day_extra").focus();
            document.getElementById("from_saturday_day_extra").style.borderColor = "red";
            error_from_saturday_day_extra = true;
        }else if(until_saturday_day>from_saturday_day_extra || from_saturday_day_extra==until_saturday_day){
            $("#from_saturday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#from_saturday_day_extra_error").show();
            $("#from_saturday_day_extra").focus();
            document.getElementById("from_saturday_day_extra").style.borderColor = "red";
            error_from_saturday_day_extra = true;
        }else{
            $("#from_saturday_day_extra_error").hide();
            document.getElementById("from_saturday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - saturday
    $("#from_saturday_day_extra").change(function () {
        $("#from_saturday_day_extra_error").hide();
        document.getElementById("from_saturday_day_extra").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#until_saturday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_until_saturday_day_extra = false;

    function check_saturday_day_extra_until(){

        var from_saturday_day_extra = $("#from_saturday_day_extra").val();
        var until_saturday_day_extra = $("#until_saturday_day_extra").val();

        if(until_saturday_day_extra == 0){
            $("#until_saturday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_saturday_day_extra_error").show();
            $("#until_saturday_day_extra").focus();
            document.getElementById("until_saturday_day_extra").style.borderColor = "red";
            error_until_saturday_day_extra = true;
        }else if(from_saturday_day_extra>until_saturday_day_extra || from_saturday_day_extra==until_saturday_day_extra){
            $("#until_saturday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#until_saturday_day_extra_error").show();
            $("#until_saturday_day_extra").focus();
            document.getElementById("until_saturday_day_extra").style.borderColor = "red";
            error_until_saturday_day_extra = true;
        }else{
            $("#until_saturday_day_extra_error").hide();
            document.getElementById("until_saturday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - saturday
    $("#until_saturday_day_extra").change(function () {
        $("#until_saturday_day_extra_error").hide();
        document.getElementById("until_saturday_day_extra").style.borderColor = "#ddd";
    });

    $('#btn_save_saturday_day').click(function () {

        error_from_saturday_day = false;
        error_until_saturday_day = false;
        error_from_saturday_day_extra = false;
        error_until_saturday_day_extra = false;

        var groomer_email = $('#session_email').val();

        var day_id = $("#date option:selected").attr('id');

        var from_saturday_day = $("#from_saturday_day option:selected").val();
        var until_saturday_day = $("#until_saturday_day option:selected").val();

        var from_saturday_day_extra = $("#from_saturday_day_extra option:selected").val();
        var until_saturday_day_extra = $("#until_saturday_day_extra option:selected").val();

        var isOpenChecked = $('#saturday_day_open').is(':checked');
        var isOpenCheckedExtra = $('#saturday_day_extra_open').is(':checked');

        var isClosedChecked = $('#saturday_day_closed').is(':checked');

        var isOpenedCollapse = $('#collapseExtraVardiasaturday').attr("aria-expanded", true);

        if(isOpenChecked){
            check_saturday_day_from();
            check_saturday_day_until();
        }
        if(isOpenCheckedExtra){
            check_saturday_day_extra_from();
            check_saturday_day_extra_until();
        }

        if(isClosedChecked){

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    closed_saturday_hours:1,
                    groomer_email:groomer_email,day_id:day_id,
                    from_saturday_day:from_saturday_day,until_saturday_day:until_saturday_day,
                    from_saturday_day_extra:from_saturday_day_extra,until_saturday_day_extra:until_saturday_day_extra
                },
                success: function(response){
                    if(response.indexOf('update_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο του Σαββάτου ενημερώθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_saturday_day").style.borderColor = "#ddd";
                        document.getElementById("until_saturday_day").style.borderColor = "#ddd";
                        document.getElementById("from_saturday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_saturday_day_extra").style.borderColor = "#ddd";
                    }

                    if(response.indexOf('insert_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο του Σαββάτου καταχωρήθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_saturday_day").style.borderColor = "#ddd";
                        document.getElementById("until_saturday_day").style.borderColor = "#ddd";
                        document.getElementById("from_saturday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_saturday_day_extra").style.borderColor = "#ddd";
                    }
                }
            });

        }


        if(isOpenChecked){

            if(isOpenedCollapse){
                if (error_from_saturday_day == 0 && error_until_saturday_day == 0 && error_from_saturday_day_extra == 0 && error_until_saturday_day_extra == 0) {
                    $.ajax({
                        url:'../../groomer/groomer_server.php',
                        type: 'post',
                        data:{
                            opened_saturday_hours:1,
                            groomer_email:groomer_email,day_id:day_id,
                            from_saturday_day:from_saturday_day,until_saturday_day:until_saturday_day,
                            from_saturday_day_extra:from_saturday_day_extra,until_saturday_day_extra:until_saturday_day_extra
                        },
                        success: function(response){
                            if(response.indexOf('update_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο του Σαββάτου ενημερώθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                                document.getElementById("from_saturday_day").style.borderColor = "#ddd";
                                document.getElementById("until_saturday_day").style.borderColor = "#ddd";
                                document.getElementById("from_saturday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_saturday_day_extra").style.borderColor = "#ddd";
                            }

                            if(response.indexOf('insert_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο του Σαββάτου καταχωρήθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                                document.getElementById("from_saturday_day").style.borderColor = "#ddd";
                                document.getElementById("until_saturday_day").style.borderColor = "#ddd";
                                document.getElementById("from_saturday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_saturday_day_extra").style.borderColor = "#ddd";
                            }
                        }
                    });
                    return true;
                }else{
                    return false;
                }
            }

            if (error_from_saturday_day == 0 && error_until_saturday_day == 0) {
                $.ajax({
                    url:'../../groomer/groomer_server.php',
                    type: 'post',
                    data:{
                        opened_saturday_hours:1,
                        groomer_email:groomer_email,day_id:day_id,
                        from_saturday_day:from_saturday_day,until_saturday_day:until_saturday_day,
                        from_saturday_day_extra:from_saturday_day_extra,until_saturday_day_extra:until_saturday_day_extra
                    },
                    success: function(response){
                        if(response.indexOf('update_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο του Σαββάτου ενημερώθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_saturday_day").style.borderColor = "#ddd";
                            document.getElementById("until_saturday_day").style.borderColor = "#ddd";
                            document.getElementById("from_saturday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_saturday_day_extra").style.borderColor = "#ddd";
                        }

                        if(response.indexOf('insert_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο του Σαββάτου καταχωρήθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_saturday_day").style.borderColor = "#ddd";
                            document.getElementById("until_saturday_day").style.borderColor = "#ddd";
                            document.getElementById("from_saturday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_saturday_day_extra").style.borderColor = "#ddd";
                        }
                    }
                });
                return true;
            }else{
                return false;
            }

        }

    });

    //---------------------------------END JAVASCRIPT FOR SATURDAY ------------------------------------------//
    //---------------------------------START JAVASCRIPT FOR SUNDAY --------------------------------------//

    //Default Selected Option -> Closed
    //Disable Selected Option
    $("#from_sunday_day").prop("disabled", true);
    $("#until_sunday_day").prop("disabled", true);
    $("#from_sunday_day_extra").prop("disabled", true);
    $("#until_sunday_day_extra").prop("disabled", true);
    $("#btn_extra_vardia_sunday").css("display", "none");

    //Disable-Enable Selected Option via Radio Button

    $('input:radio[id="sunday_day_open"]').change(function () {
        $("#from_sunday_day").prop("disabled", false);
        $("#until_sunday_day").prop("disabled", false);
        $("#btn_extra_vardia_sunday").css("display", "unset");
    });

    $('input:radio[id="sunday_day_closed"]').change(function () {
        $("#from_sunday_day").prop("disabled", true);
        $("#until_sunday_day").prop("disabled", true);
        $("#btn_extra_vardia_sunday").css("display", "none");
        //Hide Error When Select: Open -> Closed
        $("#from_sunday_day_error").hide();
        $("#until_sunday_day_error").hide();
        document.getElementById("from_sunday_day").style.borderColor = "#ddd";
        document.getElementById("until_sunday_day").style.borderColor = "#ddd";
        $("#from_sunday_day_extra").prop("disabled", true);
        $("#until_sunday_day_extra").prop("disabled", true);
        $("#collapseExtraVardiaSunday").removeClass('collapse show').addClass('collapse');
        $("#sunday_day_extra_closed").prop("checked", true);
        $("#from_sunday_day").val(0);
        $("#until_sunday_day").val(0);
        $("#from_sunday_day_extra").val(0);
        $("#until_sunday_day_extra").val(0);
        $("#btn_icon_sunday").removeClass('fa-minus');

    });

    $('input:radio[id="sunday_day_extra_open"]').change(function () {
        $("#from_sunday_day_extra").prop("disabled", false);
        $("#until_sunday_day_extra").prop("disabled", false);
    });

    $('input:radio[id="sunday_day_extra_closed"]').change(function () {
        $("#from_sunday_day_extra").prop("disabled", true);
        $("#until_sunday_day_extra").prop("disabled", true);
        $("#from_sunday_day_extra_error").hide();
        $("#until_sunday_day_extra_error").hide();
        document.getElementById("from_sunday_day_extra").style.borderColor = "#ddd";
        document.getElementById("until_sunday_day_extra").style.borderColor = "#ddd";
        $("#from_sunday_day_extra").val(0);
        $("#until_sunday_day_extra").val(0);
        $("#collapseExtraVardiaSunday").removeClass('collapse show').addClass('collapse');
        $("#btn_icon_sunday").toggleClass('fa-minus');
    });

    //Change Icon When Button Collapsed Pressed

    $('#btn_extra_vardia_sunday').click(function () {
        $("#btn_icon_sunday").toggleClass('fa-minus');
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#from_sunday_day_error").hide();

    // -- Disable all errors --//
    var error_from_sunday_day = false;

    function check_sunday_day_from(){

        var from_sunday_day = $("#from_sunday_day").val();

        if(from_sunday_day == 0){
            $("#from_sunday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_sunday_day_error").show();
            $("#from_sunday_day").focus();
            document.getElementById("from_sunday_day").style.borderColor = "red";
            error_from_sunday_day = true;
        }else{
            $("#from_sunday_day_error").hide();
            document.getElementById("from_sunday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - sunday
    $("#from_sunday_day").change(function () {
        $("#from_sunday_day_error").hide();
        document.getElementById("from_sunday_day").style.borderColor = "#ddd";
    });

    //DropDown Select Validation
    // ------ Hide error ------//
    $("#until_sunday_day_error").hide();

    // -- Disable all errors --//
    var error_until_sunday_day = false;

    function check_sunday_day_until(){

        var from_sunday_day = $("#from_sunday_day").val();
        var until_sunday_day = $("#until_sunday_day").val();

        if(until_sunday_day == 0){
            $("#until_sunday_day_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_sunday_day_error").show();
            $("#until_sunday_day").focus();
            document.getElementById("until_sunday_day").style.borderColor = "red";
            error_until_sunday_day = true;
        }else if(from_sunday_day>until_sunday_day || from_sunday_day==until_sunday_day){
            $("#until_sunday_day_error").html("Μη έγκυρη τιμή");
            $("#until_sunday_day_error").show();
            $("#until_sunday_day").focus();
            document.getElementById("until_sunday_day").style.borderColor = "red";
            error_until_sunday_day = true;
        }else{
            $("#until_sunday_day_error").hide();
            document.getElementById("until_sunday_day").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - sunday
    $("#until_sunday_day").change(function () {
        $("#until_sunday_day_error").hide();
        document.getElementById("until_sunday_day").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#from_sunday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_from_sunday_day_extra = false;

    function check_sunday_day_extra_from(){

        var from_sunday_day_extra = $("#from_sunday_day_extra").val();
        var until_sunday_day = $("#until_sunday_day").val();

        if(from_sunday_day_extra == 0){
            $("#from_sunday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#from_sunday_day_extra_error").show();
            $("#from_sunday_day_extra").focus();
            document.getElementById("from_sunday_day_extra").style.borderColor = "red";
            error_from_sunday_day_extra = true;
        }else if(until_sunday_day>from_sunday_day_extra || from_sunday_day_extra==until_sunday_day){
            $("#from_sunday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#from_sunday_day_extra_error").show();
            $("#from_sunday_day_extra").focus();
            document.getElementById("from_sunday_day_extra").style.borderColor = "red";
            error_from_sunday_day_extra = true;
        }else{
            $("#from_sunday_day_extra_error").hide();
            document.getElementById("from_sunday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - sunday
    $("#from_sunday_day_extra").change(function () {
        $("#from_sunday_day_extra_error").hide();
        document.getElementById("from_sunday_day_extra").style.borderColor = "#ddd";
    });

    // ------ Hide error ------//
    $("#until_sunday_day_extra_error").hide();

    // -- Disable all errors --//
    var error_until_sunday_day_extra = false;

    function check_sunday_day_extra_until(){

        var from_sunday_day_extra = $("#from_sunday_day_extra").val();
        var until_sunday_day_extra = $("#until_sunday_day_extra").val();

        if(until_sunday_day_extra == 0){
            $("#until_sunday_day_extra_error").html("Το πεδίο είναι υποχρεωτικό");
            $("#until_sunday_day_extra_error").show();
            $("#until_sunday_day_extra").focus();
            document.getElementById("until_sunday_day_extra").style.borderColor = "red";
            error_until_sunday_day_extra = true;
        }else if(from_sunday_day_extra>until_sunday_day_extra || from_sunday_day_extra==until_sunday_day_extra){
            $("#until_sunday_day_extra_error").html("Μη έγκυρη τιμή");
            $("#until_sunday_day_extra_error").show();
            $("#until_sunday_day_extra").focus();
            document.getElementById("until_sunday_day_extra").style.borderColor = "red";
            error_until_sunday_day_extra = true;
        }else{
            $("#until_sunday_day_extra_error").hide();
            document.getElementById("until_sunday_day_extra").style.borderColor = "green";
        }
    }

    //Hide Error When DropDown Changed - sunday
    $("#until_sunday_day_extra").change(function () {
        $("#until_sunday_day_extra_error").hide();
        document.getElementById("until_sunday_day_extra").style.borderColor = "#ddd";
    });

    $('#btn_save_sunday_day').click(function () {

        error_from_sunday_day = false;
        error_until_sunday_day = false;
        error_from_sunday_day_extra = false;
        error_until_sunday_day_extra = false;

        var groomer_email = $('#session_email').val();

        var day_id = $("#date option:selected").attr('id');

        var from_sunday_day = $("#from_sunday_day option:selected").val();
        var until_sunday_day = $("#until_sunday_day option:selected").val();

        var from_sunday_day_extra = $("#from_sunday_day_extra option:selected").val();
        var until_sunday_day_extra = $("#until_sunday_day_extra option:selected").val();

        var isOpenChecked = $('#sunday_day_open').is(':checked');
        var isOpenCheckedExtra = $('#sunday_day_extra_open').is(':checked');

        var isClosedChecked = $('#sunday_day_closed').is(':checked');

        var isOpenedCollapse = $('#collapseExtraVardiasunday').attr("aria-expanded", true);

        if(isOpenChecked){
            check_sunday_day_from();
            check_sunday_day_until();
        }
        if(isOpenCheckedExtra){
            check_sunday_day_extra_from();
            check_sunday_day_extra_until();
        }

        if(isClosedChecked){

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                data:{
                    closed_sunday_hours:1,
                    groomer_email:groomer_email,day_id:day_id,
                    from_sunday_day:from_sunday_day,until_sunday_day:until_sunday_day,
                    from_sunday_day_extra:from_sunday_day_extra,until_sunday_day_extra:until_sunday_day_extra
                },
                success: function(response){
                    if(response.indexOf('update_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο της Κυριακής ενημερώθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_sunday_day").style.borderColor = "#ddd";
                        document.getElementById("until_sunday_day").style.borderColor = "#ddd";
                        document.getElementById("from_sunday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_sunday_day_extra").style.borderColor = "#ddd";
                    }

                    if(response.indexOf('insert_working_hours') >= 0){
                        Swal.fire({
                            icon: 'success',
                            html: "Το ωράριο της Κυριακής καταχωρήθηκε με επιτυχία" + "</br>" + "Το κατάστημά σας θα παραμείνει κλειστό",
                            confirmButtonColor: "#b5c5ff",
                        }).then(function() {
                            location.reload();
                        });
                        document.getElementById("from_sunday_day").style.borderColor = "#ddd";
                        document.getElementById("until_sunday_day").style.borderColor = "#ddd";
                        document.getElementById("from_sunday_day_extra").style.borderColor = "#ddd";
                        document.getElementById("until_sunday_day_extra").style.borderColor = "#ddd";
                    }
                }
            });

        }


        if(isOpenChecked){

            if(isOpenedCollapse){
                if (error_from_sunday_day == 0 && error_until_sunday_day == 0 && error_from_sunday_day_extra == 0 && error_until_sunday_day_extra == 0) {
                    $.ajax({
                        url:'../../groomer/groomer_server.php',
                        type: 'post',
                        data:{
                            opened_sunday_hours:1,
                            groomer_email:groomer_email,day_id:day_id,
                            from_sunday_day:from_sunday_day,until_sunday_day:until_sunday_day,
                            from_sunday_day_extra:from_sunday_day_extra,until_sunday_day_extra:until_sunday_day_extra
                        },
                        success: function(response){
                            if(response.indexOf('update_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο της Κυριακής ενημερώθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                                document.getElementById("from_sunday_day").style.borderColor = "#ddd";
                                document.getElementById("until_sunday_day").style.borderColor = "#ddd";
                                document.getElementById("from_sunday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_sunday_day_extra").style.borderColor = "#ddd";
                            }

                            if(response.indexOf('insert_working_hours') >= 0){
                                Swal.fire({
                                    icon: 'success',
                                    html: "Το ωράριο της Κυριακής καταχωρήθηκε με επιτυχία",
                                    confirmButtonColor: "#b5c5ff",
                                }).then(function() {
                                    location.reload();
                                });
                                document.getElementById("from_sunday_day").style.borderColor = "#ddd";
                                document.getElementById("until_sunday_day").style.borderColor = "#ddd";
                                document.getElementById("from_sunday_day_extra").style.borderColor = "#ddd";
                                document.getElementById("until_sunday_day_extra").style.borderColor = "#ddd";
                            }
                        }
                    });
                    return true;
                }else{
                    return false;
                }
            }

            if (error_from_sunday_day == 0 && error_until_sunday_day == 0) {
                $.ajax({
                    url:'../../groomer/groomer_server.php',
                    type: 'post',
                    data:{
                        opened_sunday_hours:1,
                        groomer_email:groomer_email,day_id:day_id,
                        from_sunday_day:from_sunday_day,until_sunday_day:until_sunday_day,
                        from_sunday_day_extra:from_sunday_day_extra,until_sunday_day_extra:until_sunday_day_extra
                    },
                    success: function(response){
                        if(response.indexOf('update_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο της Κυριακής ενημερώθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_sunday_day").style.borderColor = "#ddd";
                            document.getElementById("until_sunday_day").style.borderColor = "#ddd";
                            document.getElementById("from_sunday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_sunday_day_extra").style.borderColor = "#ddd";
                        }

                        if(response.indexOf('insert_working_hours') >= 0){
                            Swal.fire({
                                icon: 'success',
                                html: "Το ωράριο της Κυριακής καταχωρήθηκε με επιτυχία",
                                confirmButtonColor: "#b5c5ff",
                            }).then(function() {
                                location.reload();
                            });
                            document.getElementById("from_sunday_day").style.borderColor = "#ddd";
                            document.getElementById("until_sunday_day").style.borderColor = "#ddd";
                            document.getElementById("from_sunday_day_extra").style.borderColor = "#ddd";
                            document.getElementById("until_sunday_day_extra").style.borderColor = "#ddd";
                        }
                    }
                });
                return true;
            }else{
                return false;
            }
        }
    });

    //---------------------------------END JAVASCRIPT FOR SUNDAY ------------------------------------------//

});