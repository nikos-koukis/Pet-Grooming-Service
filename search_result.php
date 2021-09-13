<?php
    require_once 'includes/database/config.php';

    /* Redirect στην αρχική σελίδα αν στο url δεν υπάρχουν παράμετροι
     π.χ https://groomedoo.eu/search_result.php/ */

    if(!isset($_GET['current_date']) || !isset($_GET['city']) || !isset($_GET['year']) || !isset($_GET['month']) || !isset($_GET['date'])) {
        header('Location: ./');
        exit;
    }

    $date = $db->real_escape_string($_GET['current_date']);
    $city = $db->real_escape_string($_GET['city']);
    $year = $db->real_escape_string($_GET['year']);
    $month = $db->real_escape_string($_GET['month']);
    $day = $db->real_escape_string($_GET['date']);


    $query = "SELECT groomer.id,groomer.email,groomer.company,groomer.city,groomer.address,groomer.phone,status
                  FROM groomer INNER JOIN groomer_working_hours ON groomer.id=groomer_working_hours.groomer_id
                  INNER JOIN groomer_working_days ON groomer_working_hours.day_id=groomer_working_days.id
                  WHERE groomer_working_days.name_engl='$date' AND groomer.city='$city' AND groomer_working_hours.is_closed=0";

    $result = mysqli_query($db,$query);


    session_start();

    $email = $_SESSION['email'];
    $query2 = "SELECT * FROM user WHERE email='$email'";
    $result2 = mysqli_query($db,$query2);
    while($row = mysqli_fetch_array($result2)){
        $user_name = $row['name'];
        $user_id = $row['id'];
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

    <!--######################### Load Navbar Custom Styling ############################-->
    <link rel="stylesheet" href="navbar/assets/css/navbar.css?<?php echo time(); ?>">
    <!--######################### Load Custom Styling ############################-->
    <link rel="stylesheet" href="assets/css/search_result.css?<?php echo time(); ?>">
    <!--######################### Load  Custom JS ############################-->
    <script src="assets/js/search_result.js?<?php echo time(); ?>"></script>
    <!--######################### Load Modal Custom Styling ############################-->
    <link rel="stylesheet" href="user/assets/css/modal_login.css?<?php echo time(); ?>">
    <!--######################### Load Modal Custom JS ############################-->
    <script src="user/assets/js/modal_login.js?<?php echo time(); ?>"></script>
    <!--######################### Load Modal Register Custom Styling ############################-->
    <link rel="stylesheet" href="user/assets/css/modal_register.css?<?php echo time(); ?>">
    <!--######################### Load Modal Register Custom JS ############################-->
    <script src="user/assets/js/modal_register.js?<?php echo time(); ?>"></script>

    <title>Αποτελέσματα Αναζήτησης</title>
</head>
<body>
<!--####### Load Navbar ##########-->
<!--####### Load User Login Modal ##########-->
<!--####### Load User Register Modal ##########-->
<?php
require_once 'navbar/navbar.php';
require_once 'user/modal_login.php';
require_once 'user/modal_register.php';
?>


<div class="container">
    <div class="row">
        <div class="col-sm-4" id="row">
            <h2>Pet Grooming Services</h2>
        </div>
        <div class="col-sm" id="row">
            <input type="date" class="form-control" id="date">
            <p class="error_form" id="date_error"></p>
        </div>
        <div class="col-sm">
            <select class="form-select form-select mb-3" id="city">
                <option selected value="0">-- Επιλέξτε Πόλη--</option>
                <option value="1">Πάτρα</option>
                <option value="2">Αθήνα</option>
                <option value="3">Θεσσαλονίκη</option>
            </select>
            <p class="error_form" id="city_error"></p>
        </div>
        <div class="col-sm">
            <button type="button" id="btn_search" class="btn btn-primary btn-block">Αναζήτηση</button>
        </div>
    </div>

    <div class="available_groomer">
        <?php $isEmpty = true;
        while($row = mysqli_fetch_array($result)){ ?>
            <?php
            $isEmpty = false;

            $groomer_id = $row['id'];
            $groomer_email = $row['email'];
            $groomer_company = $row['company'];
            $groomer_city = $row['city'];
            $groomer_address = $row['address'];
            $groomer_phone = $row['phone'];
            $status = $row['status'];

            ?>

            <div class="wrapper">
                <p hidden id="year"><?php echo $year; ?></p>
                <p hidden id="month"><?php echo $month; ?></p>
                <p hidden id="day"><?php echo $day; ?></p>
                <p hidden id="day_name"><?php echo $date ; ?></p>
                <div class="card text-center">
                    <div class="card-header" id="card_groomer_company">
                        <?php echo $groomer_company;  ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-text"><i class='bx bx-envelope'></i> <?php echo $groomer_email; ?></h5>
                        <h5 class="card-text"><i class='bx bxs-city'></i> <?php echo $groomer_city; ?></h5>
                        <h5 class="card-text"><i class='bx bxs-map'></i> <?php echo $groomer_address; ?></h5>
                        <h5 class="card-text"><i class='bx bxs-phone' ></i> <?php echo $groomer_phone; ?></h5>
                        <?php if($status == 'closed') { ?>
                            <h5 class="card-text status_closed"><i class='bx bx-x' ></i> <?php echo "Κλειστό"; ?></h5>
                        <?php }else{ ?>
                            <h5 class="card-text status_open"><i class='bx bx-check' ></i> <?php echo "Ανοιχτό"; ?></h5>
                        <?php } ?>
                    </div>
                    <div class="card-footer text-muted">
                        <button type="button" value="<?php echo $groomer_id ?>" id="btn_schedule_appointment" class="btn btn-primary btn-block btn_schedule_appoin">ΚΛΕΙΣΤΕ ΡΑΝΤΕΒΟΥ</button>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php
        if($isEmpty) {
            echo "<h4>Δεν υπάρχει διαθέσιμος Groomer για $city με ημερομηνία $day/$month/$year</h4>";
        }
        ?>
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