$(document).ready(function () {


    $( ".btn_info" ).each(function() {
        $(this).on("click", function () {

            var appointment_id = $(this).attr('data-target');
            var id = $(this).val();

            $('.appointment_modal_table').prop('id',appointment_id.substr(1));
            $('#btn_accept').val(id);
            $('#btn_decline').val(id);

            $('.modal-footer').hide();

            $.ajax({
                url:'../../groomer/groomer_server.php',
                type: 'post',
                dataType: 'JSON',
                data:{
                    groomer_appointment_modal_from_ajax:1,
                    id:id
                },
                success: function(response){
                    var len = response.length;
                    for(var i=0; i<len; i++){
                        var email = response[i].email;
                        var name = response[i].name;
                        var surname = response[i].surname;
                        var phone = response[i].phone;
                        var appointment_date = response[i].appointment_date;
                        var appointment_time = response[i].appointment_time;
                        var booked = response[i].booked;

                        if(booked==1){
                            $('.modal-footer').show();
                        }
                    }
                    $('#appointment_table_email').html("<i class='fa fa-envelope icon_modal' style='color:#810000'></i>" + " " + email);
                    $('#appointment_table_name').html("<i class='fa fa-user-circle-o icon_modal' style='color:green'></i>" + " " + name + " " + surname);
                    $('#appointment_table_phone').html("<i class='fa fa-phone icon_modal' style='color:blue'></i>" + " " + phone );
                    $('#appointment_table_date').html("<i class='fa fa-calendar icon_modal'></i>" + " " + appointment_date );
                    $('#appointment_table_time').html("<i class='fa fa-clock-o icon_modal'></i>" + " " + appointment_time );

                }
            });

        });
    });
});