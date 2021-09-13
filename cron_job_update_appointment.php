<?php
require_once 'includes/database/config.php';

/*Με αυτό το αρχείο και με την βοήθεια cron jobs απο cpanel θα θέτουμε κάποιο ραντεβού ως is_expired εφόσον
 περάσει η ημερομηνία και ώρα διεξαγωγής του ραντεβου.
 Άρα με το 1ο query θέτουμε is_expired=1
*/


$query = "SELECT * FROM appointments WHERE MINUTE(appointment_time)<=MINUTE(CURTIME()) 
                                     AND HOUR(appointment_time)<=HOUR(CURTIME()) 
                                     AND appointment_date <= CURDATE()";

$result = mysqli_query($db, $query);

foreach ($result as $row) {
    $id =  $row['id'];
    $query2 = "UPDATE appointments SET is_expired=1 WHERE id=$id";
    $result2 = mysqli_query($db, $query2);

}

/* Με αυτό το query θέτουμε in_completed=1 όσα appointments γίνουν is_expired=1 και είναι μονο in_process=1
*/

$query2 = "SELECT * FROM appointments WHERE MINUTE(appointment_time)<=MINUTE(CURTIME()) 
                                     AND HOUR(appointment_time)<=HOUR(CURTIME()) 
                                     AND appointment_date <= CURDATE() AND in_process=1
                                     AND in_process=1";
$result2 = mysqli_query($db, $query2);

while($row = mysqli_fetch_array($result2)){

    $id = $row['id'];

    $query = "UPDATE appointments SET completed=1,in_process=0 WHERE id=$id";
    $result = mysqli_query($db, $query);

}



?>