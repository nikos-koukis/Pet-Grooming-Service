<?php

require_once '../includes/database/config.php';

session_start();

if(!isset($_SESSION['userLoggedIN'])){
    header('Location: https://groomedoo.eu/');
    exit();
}

$email = $_SESSION['email'];
$query = "SELECT * FROM user WHERE email='$email'";
$result = mysqli_query($db,$query);
while($row = mysqli_fetch_array($result)){
    $user_name = $row['name'];
    $user_id = $row['id'];
}

$query_user_appoint = "SELECT * FROM user INNER JOIN customer ON user.id=customer.user_id 
                           INNER JOIN appointments ON customer.id=appointments.customer_id
                           INNER JOIN groomer ON appointments.groomer_id=groomer.id
                           WHERE user.id=$user_id
                           ORDER BY appointments.appointment_date DESC , appointments.appointment_time DESC";
$result_user_appoint = mysqli_query($db, $query_user_appoint);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/favicon.png" type="image" sizes="16x16">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!--######################### Load Navbar Custom Styling ############################-->
    <link rel="stylesheet" href="/navbar/assets/css/navbar.css?<?php echo time(); ?>">
    <!--######################### Load User Appointment Custom Styling ############################-->
    <link rel="stylesheet" href="assets/css/user_appointment.css?<?php echo time(); ?>">
    <!--######################### Load User Appointment Custom JS ############################-->
    <script src="assets/js/user_appointment.js?<?php echo time(); ?>" ></script>


    <title>Τα ραντεβού</title>
</head>
<body>

<!--####### Load Navbar ##########-->

<?php
require_once '../navbar/navbar.php';
?>

<div class="container">
    <div class="container_info">
        <div class="header">
            <p>Τα ραντεβού μου</p>
        </div>
        <?php if($result_user_appoint->num_rows > 0){ ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ημερομηνία</th>
                <th scope="col">Ώρα</th>
                <th scope="col">Groomer</th>
                <th scope="col">Κατάσταση</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                $counter = 0;
                while ($row = $result_user_appoint->fetch_assoc()) {
                    $counter++;
                    echo"<tr class='table_row'>";
                    echo"<td id='td'>" . $counter . "</td>";
                    echo"<td id='td'>" . $row['appointment_date'] . "</td>";
                    echo"<td id='td''>" . $row['appointment_time'] . "</td>";
                    echo"<td id='td'>" . $row['company'] . "</td>";
                    if($row['is_expired'] == 1){
                        echo"<td id='td'><button id='btn_completed' type='button' class='btn btn-outline-primary'>Ολοκληρωμένο</button></td>";
                    }
                    else if($row['booked'] == 1){
                        echo"<td id='td'><button id='btn_booked' type='button' class='btn btn-outline-primary'>Εκκρεμεί</button></td>";
                    }else if($row['in_process'] == 1){
                        echo"<td id='td'><button type='button' class='btn btn-outline-primary'>Σε εξέλιξη</button></td>";
                    }else if($row['completed'] == 1){
                        echo"<td id='td'><button id='btn_completed' type='button' class='btn btn-outline-primary'>Ολοκληρωμένο</button></td>";
                    }else if($row['canceled'] == 1){
                        echo"<td id='td'><button id='btn_canceled' type='button' class='btn btn-outline-primary'>Ακυρωμένο</button></td>";
                    }
                    echo"</tr>";
                }
                ?>
            </tr>
            </tbody>
        </table>
        <?php }else{ ?>
        <h3 class="user_appoint_table_empty">Μέχρι στιγμής δεν έχει πραγματοποιηθεί κάποιο ραντεβού.</h3>
        <?php } ?>
    </div>

</div>



</body>
</html>