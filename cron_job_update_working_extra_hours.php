<?php

require_once 'includes/database/config.php';


$query = "SELECT * FROM groomer_working_days,groomer_working_hours WHERE groomer_working_days.id=groomer_working_hours.day_id
          AND groomer_working_days.name_engl_complete=DAYNAME(CURDATE())";

$result = mysqli_query($db, $query);

foreach ($result as $row) {

    $id =  $row['id'];


    $query = "SELECT * FROM groomer_working_hours WHERE
                    TIME(CURTIME()) >= TIME(from_hour_extra) AND TIME(CURTIME()) <= TIME(until_hour_extra) AND id=$id";

    $result = mysqli_query($db, $query);

    while($row = mysqli_fetch_array($result)){

        $id = $row['id'];

        $update_query = "UPDATE groomer_working_hours SET status='open' WHERE id=$id";
        $update_result = mysqli_query($db, $update_query);
    }

}




?>