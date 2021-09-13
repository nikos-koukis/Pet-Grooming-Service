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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="../assets/images/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

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
    <!--######################### Load Groomer Dashboard Custom Styling ############################-->
    <link rel="stylesheet" href="assets/css/groomer_dashboard.css?<?php echo time(); ?>">
    <!--######################### Load Groomer Dashboard Custom JS ############################-->
    <script src=assets/js/groomer_dashboard.js?<?php echo time(); ?>"></script>


    <title>Πίνακας Ελέγχου</title>
</head>
<body>
<input type="hidden" id="session_email" value="<?php echo $email; ?>"  /> <!-- Session Email -->

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
            Πίνακας Ελέγχου
        </div>
    </div>

    <?php
    $query_check_appointment = "SELECT * FROM customer,appointments WHERE appointments.groomer_id=$groomer_id AND booked=true AND 	is_expired=0
                                      AND appointments.customer_id = customer.id ORDER BY appointments.appointment_date ASC, appointments.appointment_time ASC";
    $result_check_appointment = mysqli_query($db,$query_check_appointment);

    $query_count_appointment = "SELECT count(*) c FROM appointments WHERE groomer_id=$groomer_id AND booked=true AND is_expired=0";
    $result_count_appointment = mysqli_query($db,$query_count_appointment);
    while($row = mysqli_fetch_array($result_count_appointment)){
        $count = $row['c'];
    }

    if ($result_check_appointment->num_rows == 1) {
        ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading"></h4>
                <p>Υπάρχει <?php echo $count; ?> νέα αίτηση για ραντεβού</p>
                <hr>
                <div id="accordion">
                    <div class="card">
                        <h5 class="card-header">
                            <a id="check_appointment_dropdown" data-toggle="collapse" href="#check_appointment_collapse" aria-expanded="true" aria-controls="collapse-example" class="d-block">
                                <i class="fa fa-chevron-down pull-right"></i>
                                Δείτε Περισσότερα
                            </a>
                            <div id="check_appointment_collapse" class="collapse" aria-labelledby="heading-example">
                                <?php
                                while($row = mysqli_fetch_array($result_check_appointment)){
                                    $appointment_id = $row['id'];
                                    $name = $row['name'];
                                    $surname = $row['surname'];
                                    $email = $row['email'];
                                    $phone = $row['phone'];
                                    $appointment_date = $row['appointment_date'];
                                    $appointment_time = $row['appointment_time'];
                                    $entry_appointment = $row['entry_appointment'];

                                    ?>
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="card-header">
                                                <p>Νέα Αίτηση</p>
                                            </div>
                                            <p class="card-text name">Όνομα: <?php echo $name; ?></p>
                                            <p class="card-text surname" value="<?php echo $surname; ?>">Επώνυμο: <?php echo $surname; ?></p>
                                            <p class="card-text email" value="<?php echo $email; ?>">Email: <?php echo $email; ?></p>
                                            <p class="card-text phone" value="<?php echo $phone; ?>">Κινητό: <?php echo $phone; ?></p>
                                            <p class="card-text appointment_date" value="<?php echo $appointment_date; ?>">Ημερομηνία: <?php echo $appointment_date; ?></p>
                                            <p class="card-text appointment_time" value="<?php echo $appointment_time; ?>">Ώρα: <?php echo $appointment_time; ?></p>
                                            <div class="form-group col-md-12" id="div_btn">
                                                <button type="button" value="<?php echo $appointment_id ?>" id="btn_accept" class="btn btn-primary btn-block accept">ΑΠΟΔΟΧΗ ΑΙΤΗΣΗΣ</button>
                                            </div>
                                            <div class="form-group col-md-12" id="div_btn">
                                                <button type="button" value="<?php echo $appointment_id ?>" id="btn_decline" class="btn btn-primary btn-block decline">ΑΠΟΡΡΙΨΗ ΑΙΤΗΣΗΣ</button>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            Ημερομηνία Αίτησης: <?php echo $entry_appointment; ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </h5>
                    </div>
                </div>
            </div>
        <?php
    }else if($result_check_appointment->num_rows > 1){
        ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"></h4>
            <p>Υπάρχουν <?php echo $count; ?> νέες αιτήσεις για ραντεβού</p>
            <hr>

            <div id="accordion">
                <div class="card">
                    <h5 class="card-header">
                        <a id="check_appointment_dropdown" data-toggle="collapse" href="#check_appointment_collapse" aria-expanded="true" aria-controls="collapse-example" class="d-block">
                            <i class="fa fa-chevron-down pull-right"></i>
                            Δείτε Περισσότερα
                        </a>
                        <div id="check_appointment_collapse" class="collapse" aria-labelledby="heading-example">
                            <?php
                            while($row = mysqli_fetch_array($result_check_appointment)){
                                $appointment_id = $row['id'];
                                $name = $row['name'];
                                $surname = $row['surname'];
                                $email = $row['email'];
                                $phone = $row['phone'];
                                $appointment_date = $row['appointment_date'];
                                $appointment_time = $row['appointment_time'];
                                $entry_appointment = $row['entry_appointment'];

                            ?>
                                <div class="card text-center">
                                    <div class="card-body">
                                        <div class="card-header">
                                            <p>Νέα Αίτηση</p>
                                        </div>
                                        <p class="card-text name">Όνομα: <?php echo $name; ?></p>
                                        <p class="card-text surname" value="<?php echo $surname; ?>">Επώνυμο: <?php echo $surname; ?></p>
                                        <p class="card-text email" value="<?php echo $email; ?>">Email: <?php echo $email; ?></p>
                                        <p class="card-text phone" value="<?php echo $phone; ?>">Κινητό: <?php echo $phone; ?></p>
                                        <p class="card-text appointment_date" value="<?php echo $appointment_date; ?>">Ημερομηνία: <?php echo $appointment_date; ?></p>
                                        <p class="card-text appointment_time" value="<?php echo $appointment_time; ?>">Ώρα: <?php echo $appointment_time; ?></p>
                                        <div class="form-group col-md-12" id="div_btn">
                                            <button type="button" value="<?php echo $appointment_id ?>" id="btn_accept" class="btn btn-primary btn-block accept">ΑΠΟΔΟΧΗ ΑΙΤΗΣΗΣ</button>
                                        </div>
                                        <div class="form-group col-md-12" id="div_btn">
                                            <button type="button" value="<?php echo $appointment_id ?>" id="btn_decline" class="btn btn-primary btn-block decline">ΑΠΟΡΡΙΨΗ ΑΙΤΗΣΗΣ</button>
                                        </div>
                                    </div>
                                    <div class="card-footer text-muted">
                                        Ημερομηνία Αίτησης: <?php echo $entry_appointment; ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </h5>
                </div>
            </div>

        </div>
        <?php
    }else{
        ?>
        <div class="alert alert-secondary" role="alert">
            <h4 class="alert-heading"></h4>
            <p>Δεν υπάρχει κάποια νέα αίτηση για ραντεβού.</p>
            <hr>
        </div>
        <?php
    }
    ?>

    <?php
    /*
 * Query For Count User By Groomer
 * */

    $query_count_user = "SELECT COUNT(DISTINCT(user_id)) count_user FROM appointments,customer
                     WHERE customer.id=appointments.customer_id AND groomer_id=$groomer_id";
    $result_count_user = mysqli_query($db,$query_count_user);
    while($row = mysqli_fetch_array($result_count_user)){
        $count_user = $row['count_user'];
    }

    $query_count_appointment = "SELECT COUNT(id) count_appointments FROM appointments WHERE groomer_id=$groomer_id";
    $result_count_appointment = mysqli_query($db,$query_count_appointment);
    while($row = mysqli_fetch_array($result_count_appointment)){
        $count_appoitnement = $row['count_appointments'];
    }

    $query_count_in_process_appoint = "SELECT COUNT(id) count_in_process_appoint FROM appointments 
                                       WHERE groomer_id=$groomer_id AND in_process=1";
    $result_count_in_process_appoint = mysqli_query($db,$query_count_in_process_appoint);
    while($row = mysqli_fetch_array($result_count_in_process_appoint)){
        $count_in_process_appoint = $row['count_in_process_appoint'];
    }

    $query_count_completed_appoint = "SELECT COUNT(id) count_completed_appoint FROM appointments 
                                       WHERE groomer_id=$groomer_id AND completed=1";
    $result_count_completed_appoint = mysqli_query($db,$query_count_completed_appoint);
    while($row = mysqli_fetch_array($result_count_completed_appoint)){
        $count_completed_appoint = $row['count_completed_appoint'];
    }

    $query_count_canceled_appoint = "SELECT COUNT(id) count_canceled_appoint FROM appointments 
                                       WHERE groomer_id=$groomer_id AND canceled=1";
    $result_count_canceled_appoint = mysqli_query($db,$query_count_canceled_appoint);
    while($row = mysqli_fetch_array($result_count_canceled_appoint)){
        $count_canceled_appoint = $row['count_canceled_appoint'];
    }
    ?>

    <div class="wrapper">
        <div class="grid-container">

            <div class="card">
                <i class='bx bx-user dashboard_icon'id="fa_icon_user_card"></i>
                <div class="card-body">
                    <h5 class="card-title" id="card_title_user"><?php echo $count_user; ?></h5>
                    <p class="card-text" id="card_text_user">Εγγεγραμένοι Χρήστες</p>
                </div>
            </div>

            <div class="card">
                <i class='bx bx-trending-up dashboard_icon' id="fa_icon_appoint_in_process_card"></i>
                <div class="card-body">
                    <h5 class="card-title" id="card_title_in_process_appoint"><?php echo $count_in_process_appoint; ?></h5>
                    <p class="card-text" id="card_text_in_process_appoint">Ραντεβού σε Εξέλιξη</p>
                </div>
            </div>

            <div class="card">
                <i class='bx bx-check-double dashboard_icon' id="fa_icon_appoint_completed_card"></i>
                <div class="card-body">
                    <h5 class="card-title" id="card_title_completed_appoint"><?php echo $count_completed_appoint; ?></h5>
                    <p class="card-text" id="card_text_completed_appoint">Ολοκληρωμένα Ραντεβού</p>
                </div>
            </div>

            <div class="card">
                <i class='bx bx-x dashboard_icon' id="fa_icon_appoint_canceled_card"></i>
                <div class="card-body">
                    <h5 class="card-title" id="card_title_canceled_appoint"><?php echo $count_canceled_appoint; ?></h5>
                    <p class="card-text" id="card_text_canceled_appoint">Ακυρωθέντα Ραντεβού</p>
                </div>
            </div>

        </div>
    </div>

</div>

</body>

</html>