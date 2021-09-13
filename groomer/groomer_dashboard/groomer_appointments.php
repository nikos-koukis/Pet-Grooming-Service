<?php

session_start();

require_once '../../includes/database/config.php';

if(!isset($_SESSION['groomerLoggedIN'])){
    header('Location: ../user_register.php');
    exit();
}


if(isset($_GET['date']) ) {
    $date = $db->real_escape_string($_GET['date']);
}


$email = $_SESSION['email'];
$query = "SELECT * FROM groomer WHERE email='$email'";
$result = mysqli_query($db,$query);
while($row = mysqli_fetch_array($result)){
    $id = $row['id'];
}


$query2 = "SELECT groomer_working_hours.groomer_id,groomer_working_hours.day_id,
                     groomer_working_hours.from_hour,groomer_working_hours.until_hour,
                     groomer_working_hours.from_hour_extra,groomer_working_hours.until_hour_extra,
                     groomer_working_hours.is_closed,
                     groomer_working_days.name_engl,groomer_working_days.name  
                     FROM groomer_working_hours,groomer_working_days 
                     WHERE groomer_working_hours.day_id=groomer_working_days.id 
                     AND groomer_working_hours.groomer_id='$id' 
                     AND groomer_working_days.name_engl_complete= DAYNAME('$date')";
$result2 = mysqli_query($db,$query2);

while($row = mysqli_fetch_array($result2)){

    $from_hour = $row['from_hour'];
    $until_hour = $row['until_hour'];
    $from_hour_extra = $row['from_hour_extra'];
    $until_hour_extra = $row['until_hour_extra'];
    $is_closed = $row['is_closed'];
    $name = $row['name'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/images/favicon.png"/>

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
    <!--######################### Load Groomer Working Hours Custom Styling ############################-->
    <link rel="stylesheet" href="assets/css/groomer_appointments.css?<?php echo time(); ?>">
    <!--######################### Load Groomer Working Hours Custom JS ############################-->
    <script src="assets/js/groomer_appointments.js?<?php echo time(); ?>"></script>
    <title>Groomer Appointments</title>

</head>
<body>
<input type="hidden" id="session_groomer_id" value="<?php echo $id; ?>"  /> <!-- Session Email -->
<!--####### Pre Loader Screen ##########-->
<!--####### Pre Loader Screen ##########-->
<?php
require_once './preloader_screen/preloader_screen.php';
?>

<!--####### NavBar Menu ##########-->
<?php
require_once './navbar/groomer_navbar.php';
?>

<div class="main">
    <div class="main-header" id="main-header">
        <div class="mobile-toggle" id="mobile-toggle">
            <i class='bx bx-menu-alt-right'></i>
        </div>
        <div class="main-title ">
            Διαθέσιμα Ραντεβού
        </div>
    </div>

    <div class="container">
        <h6><span><i class='bx bx-calendar'></i>Διαθέσιμα Ραντεβού</span></h6>
        <div class="container_appointments">

            <div class="row">
                <div class="col-sm-2">
                    <label for="choose_date_for_appointment">Επιλέξτε Ημερομηνία:</label>
                </div>
                <div class="col-sm">
                    <input type="date" class="form-control" id="choose_date_for_appointment">
                    <p class="error_appointment" id="appointment_choose_date_error"></p>
                </div>
                <div class="col-sm">
                    <button type="button" class="btn btn-primary" id="choose_date_for_appointment_btn">Αναζήτηση</button>
                </div>
            </div>

            <?php
            if ($result2->num_rows == 0) {

                $query = "SELECT * FROM groomer_working_days WHERE name_engl_complete= DAYNAME('$date')";
                $result = mysqli_query($db,$query);

                while($row = mysqli_fetch_array($result)){

                    $name = $row['name'];

                    ?>
                    <div class="row" id="store_situation">
                        <div class="col-sm-2">
                            <p class="store_situation_text">Κατάσταση Λειτουργίας Καταστήματος:</p>
                        </div>
                        <div class="col-sm">
                            <p class="store_situation_value" id="store_situation_value">Δεν έχετε ορίσει ωράριο λειτουργίας για την
                                <?php echo $name ?></p>
                        </div>
                        <div class="col-sm">
                            <a href="groomer_working_hours.php" class="btn btn-primary store_situation_settings">Επεξεργασία Ωραρίου</a>
                        </div>
                    </div>
                    <?php
                }
            }else{
                if($is_closed==1){
                    ?>
                    <div class="row" id="store_situation">
                        <div class="col-sm-2">
                            <p class="store_situation_text">Κατάσταση Λειτουργίας Καταστήματος:</p>
                        </div>
                        <div class="col-sm">
                            <p class="store_situation_value" id="store_situation_value"><?php echo $name ?> <i class='bx bx-right-arrow-alt'></i> Κλειστό <i class="fa fa-window-close" style="color: red"></i>
                                Δε μπορείτε να δείτε τα διαθέσιμα ραντεβού</p>
                        </div>
                        <div class="col-sm">
                            <a href="groomer_working_hours.php" class="btn btn-primary store_situation_settings">Επεξεργασία Ωραρίου</a>
                        </div>
                    </div>
                    <?php
                }
                if($is_closed==0){
                    ?>
                    <div class="row" id="store_situation">
                        <div class="col-sm-2">
                            <p class="store_situation_text">Κατάσταση Λειτουργίας Καταστήματος:</p>
                        </div>
                        <div class="col-sm">
                            <p class="store_situation_value" id="store_situation_value"><?php echo $name ?> <i class='bx bx-right-arrow-alt'></i> Ανοιχτό <i class="fa fa-check" style="color: green"></i></p>
                        </div>
                        <div class="col-sm">
                            <a href="groomer_working_hours.php" class="btn btn-primary store_situation_settings">Επεξεργασία Ωραρίου</a>
                        </div>
                    </div>
                    <div class="row" id="store_opening_hours">
                        <div class="col-sm-2">
                            <p class="store_opening_hours_text">Ωράριο Λειτουργίας:</p>
                        </div>
                        <?php
                        if( $from_hour_extra != 0 && $until_hour_extra != 0){ ?>
                            <div class="col-sm">
                                <p class="store_opening_hours_value" id="store_opening_hours_value">
                                    <?php echo $from_hour . "-" .  $until_hour . " &" . $from_hour_extra . "-" . $until_hour_extra ;?></p>
                            </div>
                        <?php } else{ ?>
                            <div class="col-sm">
                                <p class="store_opening_hours_value" id="store_opening_hours_value">
                                    <?php echo $from_hour . "-" .  $until_hour  ;?></p>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="row justify-content-start" id="available_appointments">

                        <div class="col-2">
                            <p class="available_appointments_text">Διαθέσιμα Ραντεβού:</p>
                        </div>

                        <div class="col-6" id="buttons_available_appointments">
                            <!-- Populate Buttons For Available Appointments with PHP -->
                            <?php
                            if( $from_hour_extra != 0 && $until_hour_extra != 0) {
                                $start_time = strtotime($from_hour);
                                $end_time   = strtotime($until_hour);
                                $start_extra_time = strtotime($from_hour_extra);
                                $end_extra_time   = strtotime($until_hour_extra);
                                for ($i=$start_time; $i<=$end_time-30; $i = $i + 30*60){
                                    echo '<button type="button" class="btn btn-primary appointment_button" value="'. date('H:i',$i) . '" data-toggle="modal" data-target="#modal'. $i . '">'. date('H:i',$i) .'</button>';
                                }
                                for ($i=$start_extra_time; $i<=$end_extra_time-30; $i = $i + 30*60){
                                    echo '<button type="button" class="btn btn-primary appointment_button" value="'. date('H:i',$i) . '" data-toggle="modal" data-target="#modal'. $i . '">'. date('H:i',$i) .'</button>';
                                }
                            }else{
                                $start_time = strtotime($from_hour);
                                $end_time   = strtotime($until_hour);
                                for ($i=$start_time; $i<=$end_time-30; $i = $i + 30*60){
                                    echo '<button type="button" class="btn btn-primary appointment_button" value="'. date('H:i',$i) . '" data-toggle="modal" data-target="#modal'. $i . '">'. date('H:i',$i) .'</button>';
                                }
                            }
                            ?>
                        </div>

                    </div>
                    <?php
                }

            }
            ?>

            <!-- Modal -->
            <div class="appointment_modal modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Κλείστε Ραντεβού</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class='bx bx-message-square-x'></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">

                                <div class="row">
                                    <div class="col-8 col-sm-6">
                                        <p class="edit_appointment_text">Επεξεργασία Ραντεβού:</p>
                                    </div>
                                    <div class="col-4 col-sm-6">
                                        <p class="edit_appointment_time"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <p class="client_info_text">Στοιχεία Πελάτη:</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <input type="email" class="form-control" id="client_email" placeholder="Email">
                                        <p class="modal_error" id="modal_error_email"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <input type="text" class="form-control" id="client_name" placeholder="Όνομα">
                                        <p class="modal_error" id="modal_error_name"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <input type="text" class="form-control" id="client_surname" placeholder="Επίθετο">
                                        <p class="modal_error" id="modal_error_surname"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <input type="text" class="form-control" id="client_phone" placeholder="Κινητό">
                                        <p class="modal_error" id="modal_error_phone"></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="btn_modal_close" data-dismiss="modal">Ακύρωση</button>
                            <button type="button" class="btn btn-primary" id="btn_modal_save">Αποθήκευση</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>

</body>
</html>