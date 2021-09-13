<?php

session_start();

require_once '../../includes/database/config.php';

if(!isset($_SESSION['groomerLoggedIN'])){
    header('Location: ../index.php');
    exit();
}

$email = $_SESSION['email'];
$query = "SELECT * FROM groomer WHERE email='$email'";
$result = mysqli_query($db,$query);
while($row = mysqli_fetch_array($result)){
    $groomer_id = $row['id'];
}

$select_appointments = "SELECT * FROM appointments WHERE groomer_id=$groomer_id AND is_expired=1 ORDER BY appointment_date DESC, appointment_time,appointment_date,appointment_date";
$select_appointments_result = mysqli_query($db,$select_appointments);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="../assets/images/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    <!--######################### Load Preloader Screen Custom Styling ############################-->
    <link rel="stylesheet" href="./preloader_screen/assets/css/preloader_screen.css?<?php echo time(); ?>">
    <!--######################### Load Preloader Screen Custom JS ############################-->
    <script src="./preloader_screen/assets/js/preloader_screen.js?<?php echo time(); ?>"></script>
    <!--############################################################################################-->
    <!--############################################################################################-->
    <!--######################### Load Navbar Menu Custom Styling ############################-->
    <link rel="stylesheet" href="navbar/assets/css/groomer_navbar.css?<?php echo time(); ?>">
    <!--######################### Load Navbar Menu Custom JS ############################-->
    <script src="navbar/assets/js/groomer_navbar.js?<?php echo time(); ?>"></script>
    <!--######################### Load Groomer Appointment History Custom Styling ############################-->
    <link rel="stylesheet" href="assets/css/groomer_appointments_history.css?<?php echo time(); ?>">
    <!--######################### Load Groomer Appointment History Custom JS ############################-->
    <script src="assets/js/groomer_appointment_history.js?<?php echo time(); ?>"></script>

    <title>Ιστορικό Ραντεβού</title>
</head>
<body>
<input type="hidden" id="session_email" value="<?php echo $email; ?>"  /> <!-- Session Email -->
<input type="hidden" id="groomer_id" value="<?php echo $groomer_id; ?>"  /> <!-- Groomer Id -->

<!--####### Pre Loader Screen ##########-->
<!--####### Pre Loader Screen ##########-->
<?php
require_once './preloader_screen/preloader_screen.php';
?>


<!--####### NavBar Menu ##########-->
<?php
require_once './navbar/groomer_navbar.php';
?>

<!-- MAIN CONTENT -->
<div class="main">
    <div class="main-header" id="main-header">
        <div class="mobile-toggle" id="mobile-toggle">
            <i class='bx bx-menu-alt-right'></i>
        </div>
        <div class="main-title ">
            Τα Ραντεβού μου
        </div>
    </div>
    <div class="main-content">
        <div class="container">
            <div class="appointment_header">
                <p>Ιστορικό Ραντεβού</p>
            </div>
            <?php if($select_appointments_result->num_rows > 0){ ?>
                <table class="table table-striped" >
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ημερομηνία</th>
                        <th scope="col">Ώρα</th>
                        <th scope="col">Κατάσταση</th>
                        <th scope="col">Προβολή</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                        $counter = 0;
                        while ($row = $select_appointments_result->fetch_assoc()) {
                            $counter++;
                            echo"<tr class='table_row'>";
                            echo"<td id='td'>" . $counter . "</td>";
                            echo"<td id='td'>" . $row['appointment_date'] . "</td>";
                            echo"<td id='td'>" . $row['appointment_time'] . "</td>";

                            if($row['booked'] == 1){
                                echo"<td id='td'><button id='btn_booked' type='button' class='btn btn-outline-primary'>Εκκρεμεί</button></td>";
                            }else if($row['in_process'] == 1){
                                echo"<td id='td'><button type='button' class='btn btn-outline-primary'>Σε εξέλιξη</button></td>";
                            }else if($row['completed'] == 1){
                                echo"<td id='td'><button id='btn_completed' type='button' class='btn btn-outline-primary'>Ολοκληρωμένο</button></td>";
                            }else if($row['canceled'] == 1){
                                echo"<td id='td'><button id='btn_canceled' type='button' class='btn btn-outline-primary'>Ακυρωμένο</button></td>";
                            }
                            ?>
                            <td><button type="button" class="btn btn-info btn_icon btn_info" id="btn_info" value="<?php echo $row['id'] ?>" data-toggle="modal" data-target="#modal<?php echo $row['id'] ?>">
                                    <i class="fa fa-eye btn_icon"></i>
                                </button>
                            </td>
                            <?php
                            echo"</tr>";
                        }
                        ?>
                    </tr>
                    </tbody>
                </table>
            <?php }else{ ?>
                <h3 class="groomer_appoint_history_table_empty">Το ιστορικό σας είναι κενό.</h3>
            <?php } ?>
        </div>
    </div>
</div>

<!--Modal το οποίο δείχνει τα στοιχεία του πελάτη για κάθε ραντεβού που ενεργοποιείται απο το ματάκι του table -->

<div id="modal" class="modal fade appointment_modal_table" tabindex="-1">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Στοιχεία Ραντεβού</h5>
                <i class='bx bxs-calendar' id="calendar_icon"></i>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="appointment_table_email"></p>
                <p id="appointment_table_name"></p>
                <p id="appointment_table_phone"></p>
                <p id="appointment_table_date"></p>
                <p id="appointment_table_time"></p>
            </div>
        </div>
    </div>
</div>

</body>

</html>