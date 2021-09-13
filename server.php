<?php

require_once 'includes/database/config.php';


if(isset($_POST['disable_appointment'])) {

    $date = $db->real_escape_string($_POST['date']);
    $groomer_id = $db->real_escape_string($_POST['groomer_id']);

    $query = "SELECT * FROM appointments WHERE appointment_date='$date' AND groomer_id='$groomer_id'
                                  AND ( booked=true OR in_process=true OR completed=true)";
    $result = mysqli_query($db, $query);

    $return_arr = array();

    while($row = mysqli_fetch_array($result)){

        $appointment_time = $row['appointment_time'];

        $return_arr[] = array("appointment_time"=> $appointment_time);
    }

    exit(json_encode($return_arr));
}


if(isset($_POST['entry_appointment'])) {

    $groomer_id = $db->real_escape_string($_POST['groomer_id']);
    $user_id = $db->real_escape_string($_POST['user_id']);
    $appointment_date = $db->real_escape_string($_POST['appointment_date']);
    $appointment_time = $db->real_escape_string($_POST['appointment_time']);
    $modal_email = $db->real_escape_string($_POST['modal_email']);
    $modal_name = $db->real_escape_string($_POST['modal_name']);
    $modal_surname = $db->real_escape_string($_POST['modal_surname']);
    $modal_phone = $db->real_escape_string($_POST['modal_phone']);

    $query = "SELECT * FROM appointments WHERE appointment_date = '$appointment_date'
                                         AND appointment_time = '$appointment_time'AND booked = 1 AND is_expired=0";

    $result = mysqli_query($db, $query);
    if ($result->num_rows > 0) {
        exit('to_radevou_uparxei');
    }else{

        $re_entry_for_decline_query = "SELECT customer.id,customer.name,customer.user_id,appointments.customer_id,appointments.groomer_id,appointments.appointment_date,appointments.appointment_time
                              FROM customer,appointments
                              WHERE customer.id=appointments.customer_id AND customer.user_id=$user_id AND appointments.groomer_id = $groomer_id
                                AND appointments.appointment_date = '$appointment_date' AND appointments.appointment_time = '$appointment_time'
                                AND appointments.canceled = 1  AND is_expired=0";

        $result_re_entry_for_decline = mysqli_query($db, $re_entry_for_decline_query);

        while($row = mysqli_fetch_array($result_re_entry_for_decline)){

            $customer_id = $row['id'];
        }

        if ($result_re_entry_for_decline->num_rows > 0) {
            $update_query = "UPDATE appointments SET appointment_date='$appointment_date',appointment_time = '$appointment_time',booked=1,canceled=0
                     WHERE groomer_id=$groomer_id AND appointment_date = '$appointment_date' AND appointment_time = '$appointment_time'
                     AND customer_id=$customer_id AND canceled = 1  AND is_expired=0";
            $result_update_query = mysqli_query($db, $update_query);

            if($result_update_query){
                $update_query = "UPDATE customer SET entry_appointment=CURRENT_TIMESTAMP() WHERE user_id=$user_id AND id=$customer_id";

                $result_update_query = mysqli_query($db, $update_query);
            }
            exit("new_customer_added");
        }else{
            $query = "INSERT INTO customer (email, name, surname, phone ,appointment_date, appointment_time, is_user, user_id)
        VALUES ('$modal_email','$modal_name','$modal_surname','$modal_phone',
                '$appointment_date','$appointment_time',1,$user_id)";

            $result = mysqli_query($db, $query);

            $return_arr = array();

            $query2 = "SELECT * FROM customer WHERE email='$modal_email' AND appointment_date='$appointment_date' AND appointment_time='$appointment_time'";
            $result2 = mysqli_query($db, $query2);

            while ($row = mysqli_fetch_array($result2)) {

                $customer_id = $row['id'];
                $insert_appointment = "INSERT INTO appointments (customer_id, groomer_id,appointment_date, appointment_time, booked)
        VALUES ('$customer_id',$groomer_id,'$appointment_date','$appointment_time',1)";

                $result_ins_appointment = mysqli_query($db, $insert_appointment);

                $update_user_is_customer_query = "UPDATE user set is_customer=1 WHERE id=$user_id";
                $result_update_user_is_customer = mysqli_query($db, $update_user_is_customer_query);

                if ($result_ins_appointment) {
                    exit("new_customer_added");
                }
            }
        }

    }


}


?>