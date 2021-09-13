<?php
require_once 'includes/database/config.php';

/* Redirect στην προηγούμενη σελίδα αν στο url δεν υπάρχουν παράμετροι */

if(!isset($_GET['groomer_id']) || !isset($_GET['city']) || !isset($_GET['year']) || !isset($_GET['month']) || !isset($_GET['date']) || !isset($_GET['current_date'])) {
    header('Location: ./');
    exit;
}

$groomer_id = $db->real_escape_string($_GET['groomer_id']);
$date = $db->real_escape_string($_GET['current_date']);
$city = $db->real_escape_string($_GET['city']);
$year = $db->real_escape_string($_GET['year']);
$month = $db->real_escape_string($_GET['month']);
$day = $db->real_escape_string($_GET['date']);

$query = "SELECT groomer.id,groomer.email,groomer.company,groomer.city,groomer.address,groomer.postcode,groomer.phone,
              groomer_working_hours.from_hour,groomer_working_hours.until_hour,
              groomer_working_hours.from_hour_extra,groomer_working_hours.until_hour_extra, groomer_working_days.name_engl
              FROM groomer INNER JOIN groomer_working_hours ON groomer.id=groomer_working_hours.groomer_id
              INNER JOIN groomer_working_days ON groomer_working_hours.day_id=groomer_working_days.id
              WHERE groomer.id='$groomer_id' AND groomer_working_days.name_engl='$date'";

$result = mysqli_query($db,$query);

session_start();

$email = $_SESSION['email'];
$query2 = "SELECT * FROM user WHERE email='$email'";
$result2 = mysqli_query($db,$query2);
while($row = mysqli_fetch_array($result2)){
    $user_id = $row['id'];
    $user_name = $row['name'];
    $user_email = $row['email'];
    $user_name = $row['name'];
    $user_surname = $row['surname'];
    $user_phone = $row['phone'];
}

while($row = mysqli_fetch_array($result)) {
    $groomer_id = $row['id'];
    $groomer_email = $row['email'];
    $groomer_company = $row['company'];
    $groomer_city = $row['city'];
    $groomer_address = $row['address'];
    $groomer_postcode = $row['postcode'];
    $groomer_phone = $row['phone'];
    $groomer_from_hour = $row['from_hour'];
    $groomer_until_hour = $row['until_hour'];
    $groomer_from_hour_extra = $row['from_hour_extra'];
    $groomer_until_hour_extra = $row['until_hour_extra'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/images/favicon.png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

    <!--######################### Load Navbar Custom Styling ############################-->
    <link rel="stylesheet" href="navbar/assets/css/navbar.css?<?php echo time(); ?>">
    <!--######################### Load Custom Styling ############################-->
    <link rel="stylesheet" href="assets/css/appointment.css?<?php echo time(); ?>">
    <!--######################### Load Modal Custom JS ############################-->
    <script src="assets/js/appointment.js?<?php echo time(); ?>"></script>
    <!--######################### Load Modal Custom Styling ############################-->
    <link rel="stylesheet" href="user/assets/css/modal_login.css?<?php echo time(); ?>">
    <!--######################### Load Modal Custom JS ############################-->
    <script src="user/assets/js/modal_login.js?<?php echo time(); ?>"></script>
    <!--######################### Load Modal Register Custom Styling ############################-->
    <link rel="stylesheet" href="user/assets/css/modal_register.css?<?php echo time(); ?>">
    <!--######################### Load Modal Register Custom JS ############################-->
    <script src="user/assets/js/modal_register.js?<?php echo time(); ?>"></script>

    <title>Διαθέσιμα Ραντεβού</title>
</head>
<body>
<input hidden id="session_email" value="<?php echo $user_id; ?>"  /> <!-- Session Email -->
<p hidden class="from_hour"><?php echo $groomer_from_hour; ?></p>
<p hidden class="until_hour"><?php echo $groomer_until_hour; ?></p>
<p hidden class="from_hour_extra"><?php echo $groomer_from_hour_extra; ?></p>
<p hidden class="until_hour_extra"><?php echo $groomer_until_hour_extra; ?></p>
<p hidden id="year"><?php echo $year; ?></p>
<p hidden id="month"><?php echo $month; ?></p>
<p hidden id="day"><?php echo $day; ?></p>

<!--####### Load Navbar ##########-->
<!--####### Load User Login Modal ##########-->
<!--####### Load User Register Modal ##########-->
<?php
require_once 'user/modal_login.php';
require_once 'user/modal_register.php';
require_once 'navbar/navbar.php';
?>

<div class="main-content">
    <div class="groomer_header">
        <p>Στοιχεία Groomer</p>
    </div>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="card-container">
                        <div class="card" id="email_card">
                            <figure class="front">
                                <i class="fa fa-envelope" id="email_icon"></i>
                            </figure>
                            <figure class="back" id="email_back">
                                <div class="card-body">
                                    <p class="card-text"><?php echo $groomer_email; ?></p>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-container">
                        <div class="card" id="company_card">
                            <figure class="front">
                                <i class="fa fa-building-o" id="icon_company"></i>
                            </figure>
                            <figure class="back" id="company_back">
                                <div class="card-body">
                                    <p class="card-text"><?php echo $groomer_company; ?></p>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-container">
                        <div class="card" id="city_card">
                            <figure class="front">
                                <i class="bx bxs-city" id="icon_city"></i>
                            </figure>
                            <figure class="back" id="city_back">
                                <div class="card-body">
                                    <p class="card-text"><?php echo $groomer_city; ?></p>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-container">
                        <div class="card" id="address_card">
                            <figure class="front">
                                <i class="fa fa-map-marker" id="icon_map_marker"></i>
                            </figure>
                            <figure class="back" id="address_back">
                                <div class="card-body">
                                    <p class="card-text"><?php echo $groomer_address; ?></p>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row" id="second_row">
                <div class="col-sm">
                    <div class="card-container">
                        <div class="card" id="postcode_card">
                            <figure class="front">
                                <i class="fa fa-address-card" id="icon_postcode"></i>
                            </figure>
                            <figure class="back" id="postcode_back">
                                <div class="card-body">
                                    <p class="card-text"><?php echo $groomer_postcode; ?></p>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-container">
                        <div class="card" id="phone_card">
                            <figure class="front">
                                <i class="fa fa-phone" id="icon_phone"></i>
                            </figure>
                            <figure class="back" id="phone_back">
                                <div class="card-body">
                                    <p class="card-text"><?php echo $groomer_phone; ?></p>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-container">
                        <div class="card" id="time_card">
                            <figure class="front">
                                <i class="fa fa-clock-o" id="icon_time"></i>
                            </figure>
                            <figure class="back" id="back_time">
                                <div class="card-body">
                                    <?php
                                    if( $groomer_from_hour_extra != 0 && $groomer_until_hour_extra != 0){ ?>
                                        <p class="card-text"><?php echo $groomer_from_hour . '-' . $groomer_until_hour . ' ' . $groomer_from_hour_extra . '-' . $groomer_until_hour_extra; ?></p>
                                    <?php }else{ ?>
                                        <p class="card-text"><?php echo $groomer_from_hour . '-' . $groomer_until_hour; ?></p>
                                    <?php } ?>
                                </div
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>


<div class="second-content">
    <div class="appointment_header">
        <p>Κάντε Κράτηση</p>
    </div>
    <div id="buttons_available_appointments">
        <!-- Populate Buttons For Available Appointments with PHP -->
        <?php
        if( $groomer_from_hour_extra != 0 && $groomer_until_hour_extra != 0){ ?>
            <?php
            $start_time = strtotime($groomer_from_hour);
            $end_time   = strtotime($groomer_until_hour);
            $start_extra_time = strtotime($groomer_from_hour_extra);
            $end_extra_time   = strtotime($groomer_until_hour_extra);
            for ($i=$start_time; $i<=$end_time-30; $i = $i + 30*60){
                echo '<button type="button" id="btn_appointment" class="btn btn-primary appointment_button" value="'. date('H:i',$i) . '" data-toggle="modal" data-target="#modal'. $i . '">' . date('H:i',$i) . '</button>';
            }
            for ($i=$start_extra_time; $i<=$end_extra_time-30; $i = $i + 30*60){
                echo '<button type="button" id="btn_appointment" class="btn btn-primary appointment_button" value="'. date('H:i',$i) . '" data-toggle="modal" data-target="#modal'. $i . '">' . date('H:i',$i) . '</button>';
            }
            ?>
        <?php }else{ ?>
            <?php
            $start_time = strtotime($groomer_from_hour);
            $end_time   = strtotime($groomer_until_hour);
            for ($i=$start_time; $i<=$end_time-30; $i = $i + 30*60){
                echo '<button type="button" id="btn_appointment" class="btn btn-primary appointment_button" value="'. date('H:i',$i) . '" data-toggle="modal" data-target="#modal'. $i . '">' . date('H:i',$i) . '</button>';
            }
            ?>
        <?php } ?>
        <?php

        ?>
    </div>
</div>

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
                    <p hidden id="user_id"><?php echo $user_id; ?></p>
                    <div class="row">
                        <div class="col-8 col-sm-6">
                            <p class="edit_appointment_text">Ώρα:</p>
                        </div>
                        <div class="col-4 col-sm-6">
                            <p class="edit_appointment_time"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8 col-sm-6">
                            <p class="edit_appointment_text">Ημερομηνία:</p>
                        </div>
                        <div class="col-4 col-sm-6">
                            <p class="edit_appointment_date"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <p class="client_info_text">Στοιχεία Πελάτη:</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <input type="email" class="form-control" id="client_email" value="<?php echo $user_email; ?>" disabled />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <input type="text" class="form-control" id="client_name" value="<?php echo $user_name; ?>" disabled />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <input type="text" class="form-control" id="client_surname" value="<?php echo $user_surname; ?>" disabled />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <input type="text" class="form-control" id="client_phone" value="<?php echo $user_phone; ?>" disabled />
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group col-md-12">
                    <button type="button" class="btn btn-primary btn-block" id="btn_book_appointment">Κλείσε Ραντεβού</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_SESSION['userLoggedIN'])) {
    $query_user_appoint = "SELECT * FROM user INNER JOIN customer ON user.id=customer.user_id 
                           INNER JOIN appointments ON customer.id=appointments.customer_id 
                           WHERE user.id=$user_id AND in_process=true AND is_expired=0 
                           ORDER BY appointments.appointment_date DESC, appointments.appointment_time DESC";
    $result_user_appoint = mysqli_query($db, $query_user_appoint);
    while ($row = mysqli_fetch_array($result_user_appoint)) {
        $appointment_date = $row['appointment_date'];
        $appointment_time = $row['appointment_time'];
        $appointment_date_format = date("d-m-Y", strtotime($appointment_date));
    }
}
?>
<?php if ($result_user_appoint->num_rows > 0) { ?>
    <div class="modal fade" id="user_appointment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Τα ραντεβού σας</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Το ραντεβού σας είναι προγραμματισμένο για τις <?php echo $appointment_date_format; ?> και ώρα
                    <?php echo $appointment_time; ?>.
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" id="btn_user_appointment_modal" href="user/user_appointment.php" role="button">Μάθετε περισσότερα</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

</body>



</html>
