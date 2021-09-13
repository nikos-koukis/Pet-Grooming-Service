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
    <!--######################### Load Groomer Working Hours Custom Styling ############################-->
    <link rel="stylesheet" href="assets/css/groomer_working_hours.css?<?php echo time(); ?>">
    <!--######################### Load Groomer Working Hours Custom JS ############################-->
    <script src="assets/js/groomer_working_hours.js?<?php echo time(); ?>"></script>
    <title>Groomer Working Hours</title>

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

<div class="main">
    <div class="main-header" id="main-header">
        <div class="mobile-toggle" id="mobile-toggle">
            <i class='bx bx-menu-alt-right'></i>
        </div>
        <div class="main-title ">
            Ώρες Λειτουργίας
        </div>
    </div>

    <div class="container">
        <h6><span><i class='bx bxs-time-five'></i> Ώρες λειτουργίας</span></h6>
        <div class="container_hours">
            <div class="row">
                <div class="col-sm-2">
                    <label for="date" >Επιλέξτε Ημέρα:</label>
                </div>

                <div class="col-sm-6">
                    <select id="date" class="form-select">
                        <option selected id="1" value="container_days_monday">Δευτέρα</option>
                        <option id="2" value="container_days_tuesday">Τρίτη</option>
                        <option id="3" value="container_days_wednesday">Τετάρτη</option>
                        <option id="4" value="container_days_thursday">Πέμπτη</option>
                        <option id="5" value="container_days_friday">Παρασκευή</option>
                        <option id="6" value="container_days_saturday">Σάββατο</option>
                        <option id="0" value="container_days_sunday">Κυριακή</option>
                    </select>
                </div>
            </div>

            <!-------------------------------------------MONDAY CONTAINER---------------------------------------------------------->

            <div class="container_days" id="container_days_monday">
                <h6><span><img src="assets/images/monday.png" id="img_day"> Δευτέρα </span></h6>
                <div class="row" id="row">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_monday_day" value="0" id="monday_day_open">
                        <label class="form-check-label" for="monday_day_open" >
                            Ανοιχτό
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_monday_day" value="1" id="monday_day_closed" checked>
                        <label class="form-check-label" for="monday_day_closed">
                            Κλειστό
                        </label>
                    </div>
                    <h5>Βάρδια</h5>
                    <div class="col-md-6 mb-3">
                        <label for="from_monday_day">Από:</label>
                        <select id="from_monday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('00:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="from_monday_day_error"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="until_monday_day">Μέχρι:</label>
                        <select id="until_monday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('09:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="until_monday_day_error"></p>
                    </div>

                    <button class="btn extra_vardia" id="btn_extra_vardia_monday" data-toggle="collapse" href="#collapseExtraVardiaMonday" role="button" aria-expanded="false" aria-controls="collapseExample" >
                        <i id="btn_icon_monday" class="fa fa-plus"></i>
                    </button>

                    <div class="collapse" id="collapseExtraVardiaMonday">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_monday_day_extra" value="0" id="monday_day_extra_open">
                            <label class="form-check-label" for="monday_day_extra_open">
                                Ανοιχτό
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_monday_day_extra" value="1" id="monday_day_extra_closed" checked>
                            <label class="form-check-label" for="monday_day_extra_closed">
                                Κλειστό
                            </label>
                        </div>
                        <h5>Επιπλέον Βάρδια</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="from_monday_day_extra">Από:</label>
                                <select id="from_monday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('09:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="from_monday_day_extra_error"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="until_monday_day_extra">Μέχρι:</label>
                                <select id="until_monday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('09:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="until_monday_day_extra_error"></p>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-info" id="btn_save_monday_day">Αποθήκευση</button>


                </div>
            </div>

            <!-------------------------------------------TUESDAY CONTAINER---------------------------------------------------------->

            <div class="container_days" id="container_days_tuesday">
                <h6><span><img src="assets/images/tuesday.png" id="img_day"> Τρίτη</span></h6>
                <div class="row" id="row">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_tuesday_day" value="0" id="tuesday_day_open">
                        <label class="form-check-label" for="tuesday_day_open" >
                            Ανοιχτό
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_tuesday_day" value="1" id="tuesday_day_closed" checked>
                        <label class="form-check-label" for="tuesday_day_closed">
                            Κλειστό
                        </label>
                    </div>
                    <h5>Βάρδια</h5>
                    <div class="col-md-6 mb-3">
                        <label for="from_tuesday_day">Από:</label>
                        <select id="from_tuesday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('00:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="from_tuesday_day_error"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="until_tuesday_day">Μέχρι:</label>
                        <select id="until_tuesday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('00:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="until_tuesday_day_error"></p>
                    </div>

                    <button class="btn extra_vardia" id="btn_extra_vardia_tuesday" data-toggle="collapse" href="#collapseExtraVardiaTuesday" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i id="btn_icon_tuesday" class="fa fa-plus"></i>
                    </button>

                    <div class="collapse" id="collapseExtraVardiaTuesday">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_tuesday_day_extra" value="0" id="tuesday_day_extra_open">
                            <label class="form-check-label" for="tuesday_day_extra_open">
                                Ανοιχτό
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_tuesday_day_extra" value="1" id="tuesday_day_extra_closed" checked>
                            <label class="form-check-label" for="tuesday_day_extra_closed">
                                Κλειστό
                            </label>
                        </div>
                        <h5>Επιπλέον Βάρδια</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="from_tuesday_day_extra">Από:</label>
                                <select id="from_tuesday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('00:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="from_tuesday_day_extra_error"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="until_tuesday_day_extra">Μέχρι:</label>
                                <select id="until_tuesday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('00:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="until_tuesday_day_extra_error"></p>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-info" id="btn_save_tuesday_day">Αποθήκευση</button>


                </div>
            </div>

            <!-------------------------------------------WEDNESDAY CONTAINER---------------------------------------------------------->

            <div class="container_days" id="container_days_wednesday">
                <h6><span><img src="assets/images/wednesday.png" id="img_day"> Τετάρτη</span></h6>
                <div class="row" id="row">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_wednesday_day" value="0" id="wednesday_day_open">
                        <label class="form-check-label" for="wednesday_day_open" >
                            Ανοιχτό
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_wednesday_day" value="1" id="wednesday_day_closed" checked>
                        <label class="form-check-label" for="wednesday_day_closed">
                            Κλειστό
                        </label>
                    </div>
                    <h5>Βάρδια</h5>
                    <div class="col-md-6 mb-3">
                        <label for="from_wednesday_day">Από:</label>
                        <select id="from_wednesday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('00:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="from_wednesday_day_error"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="until_wednesday_day">Μέχρι:</label>
                        <select id="until_wednesday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('00:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="until_wednesday_day_error"></p>
                    </div>

                    <button class="btn extra_vardia" id="btn_extra_vardia_wednesday" data-toggle="collapse" href="#collapseExtraVardiaWednesday" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i id="btn_icon_wednesday" class="fa fa-plus"></i>
                    </button>

                    <div class="collapse" id="collapseExtraVardiaWednesday">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_wednesday_day_extra" value="0" id="wednesday_day_extra_open">
                            <label class="form-check-label" for="wednesday_day_extra_open">
                                Ανοιχτό
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_wednesday_day_extra" value="1" id="wednesday_day_extra_closed" checked>
                            <label class="form-check-label" for="wednesday_day_extra_closed">
                                Κλειστό
                            </label>
                        </div>
                        <h5>Επιπλέον Βάρδια</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="from_wednesday_day_extra">Από:</label>
                                <select id="from_wednesday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('00:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="from_wednesday_day_extra_error"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="until_wednesday_day_extra">Μέχρι:</label>
                                <select id="until_wednesday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('00:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="until_wednesday_day_extra_error"></p>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-info" id="btn_save_wednesday_day">Αποθήκευση</button>


                </div>
            </div>

            <!-------------------------------------------THURSDAY CONTAINER---------------------------------------------------------->

            <div class="container_days" id="container_days_thursday">
                <h6><span><img src="assets/images/thursday.png" id="img_day"> Πέμπτη</span></h6>
                <div class="row" id="row">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_thursday_day" value="0" id="thursday_day_open">
                        <label class="form-check-label" for="thursday_day_open" >
                            Ανοιχτό
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_thursday_day" value="1" id="thursday_day_closed" checked>
                        <label class="form-check-label" for="thursday_day_closed">
                            Κλειστό
                        </label>
                    </div>
                    <h5>Βάρδια</h5>
                    <div class="col-md-6 mb-3">
                        <label for="from_thursday_day">Από:</label>
                        <select id="from_thursday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('00:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="from_thursday_day_error"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="until_thursday_day">Μέχρι:</label>
                        <select id="until_thursday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('00:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="until_thursday_day_error"></p>
                    </div>

                    <button class="btn extra_vardia" id="btn_extra_vardia_thursday" data-toggle="collapse" href="#collapseExtraVardiaThursday" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i id="btn_icon_thursday" class="fa fa-plus"></i>
                    </button>

                    <div class="collapse" id="collapseExtraVardiaThursday">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_thursday_day_extra" value="0" id="thursday_day_extra_open">
                            <label class="form-check-label" for="thursday_day_extra_open">
                                Ανοιχτό
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_thursday_day_extra" value="1" id="thursday_day_extra_closed" checked>
                            <label class="form-check-label" for="thursday_day_extra_closed">
                                Κλειστό
                            </label>
                        </div>
                        <h5>Επιπλέον Βάρδια</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="from_thursday_day_extra">Από:</label>
                                <select id="from_thursday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('00:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="from_thursday_day_extra_error"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="until_thursday_day_extra">Μέχρι:</label>
                                <select id="until_thursday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('00:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="until_thursday_day_extra_error"></p>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-info" id="btn_save_thursday_day">Αποθήκευση</button>


                </div>
            </div>

            <!-------------------------------------------FRIDAY CONTAINER---------------------------------------------------------->

            <div class="container_days" id="container_days_friday">
                <h6><span><img src="assets/images/friday.png" id="img_day"> Παρασκευή</span></h6>
                <div class="row" id="row">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_friday_day" value="0" id="friday_day_open">
                        <label class="form-check-label" for="friday_day_open" >
                            Ανοιχτό
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_friday_day" value="1" id="friday_day_closed" checked>
                        <label class="form-check-label" for="friday_day_closed">
                            Κλειστό
                        </label>
                    </div>
                    <h5>Βάρδια</h5>
                    <div class="col-md-6 mb-3">
                        <label for="from_friday_day">Από:</label>
                        <select id="from_friday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('00:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="from_friday_day_error"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="until_friday_day">Μέχρι:</label>
                        <select id="until_friday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('00:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="until_friday_day_error"></p>
                    </div>

                    <button class="btn extra_vardia" id="btn_extra_vardia_friday" data-toggle="collapse" href="#collapseExtraVardiaFriday" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i id="btn_icon_friday" class="fa fa-plus"></i>
                    </button>

                    <div class="collapse" id="collapseExtraVardiaFriday">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_friday_day_extra" value="0" id="friday_day_extra_open">
                            <label class="form-check-label" for="friday_day_extra_open">
                                Ανοιχτό
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_friday_day_extra" value="1" id="friday_day_extra_closed" checked>
                            <label class="form-check-label" for="friday_day_extra_closed">
                                Κλειστό
                            </label>
                        </div>
                        <h5>Επιπλέον Βάρδια</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="from_friday_day_extra">Από:</label>
                                <select id="from_friday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('00:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="from_friday_day_extra_error"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="until_friday_day_extra">Μέχρι:</label>
                                <select id="until_friday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('00:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="until_friday_day_extra_error"></p>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-info" id="btn_save_friday_day">Αποθήκευση</button>


                </div>
            </div>

            <!-------------------------------------------SATURDAY CONTAINER---------------------------------------------------------->

            <div class="container_days" id="container_days_saturday">
                <h6><span><img src="assets/images/saturday.png" id="img_day"> Σάββατο</span></h6>
                <div class="row" id="row">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_saturday_day" value="0" id="saturday_day_open">
                        <label class="form-check-label" for="saturday_day_open" >
                            Ανοιχτό
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_saturday_day" value="1" id="saturday_day_closed" checked>
                        <label class="form-check-label" for="saturday_day_closed">
                            Κλειστό
                        </label>
                    </div>
                    <h5>Βάρδια</h5>
                    <div class="col-md-6 mb-3">
                        <label for="from_saturday_day">Από:</label>
                        <select id="from_saturday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('00:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="from_saturday_day_error"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="until_saturday_day">Μέχρι:</label>
                        <select id="until_saturday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('00:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="until_saturday_day_error"></p>
                    </div>

                    <button class="btn extra_vardia" id="btn_extra_vardia_saturday" data-toggle="collapse" href="#collapseExtraVardiaSaturday" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i id="btn_icon_saturday" class="fa fa-plus"></i>
                    </button>

                    <div class="collapse" id="collapseExtraVardiaSaturday">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_saturday_day_extra" value="0" id="saturday_day_extra_open">
                            <label class="form-check-label" for="saturday_day_extra_open">
                                Ανοιχτό
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_saturday_day_extra" value="1" id="saturday_day_extra_closed" checked>
                            <label class="form-check-label" for="saturday_day_extra_closed">
                                Κλειστό
                            </label>
                        </div>
                        <h5>Επιπλέον Βάρδια</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="from_saturday_day_extra">Από:</label>
                                <select id="from_saturday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('00:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="from_saturday_day_extra_error"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="until_saturday_day_extra">Μέχρι:</label>
                                <select id="until_saturday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('00:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="until_saturday_day_extra_error"></p>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-info" id="btn_save_saturday_day">Αποθήκευση</button>


                </div>
            </div>

            <!-------------------------------------------SUNDAY CONTAINER---------------------------------------------------------->

            <div class="container_days" id="container_days_sunday">
                <h6><span><img src="assets/images/sunday.png" id="img_day"> Κυριακή</span></h6>
                <div class="row" id="row">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_sunday_day" value="0" id="sunday_day_open">
                        <label class="form-check-label" for="sunday_day_open" >
                            Ανοιχτό
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio_sunday_day" value="1" id="sunday_day_closed" checked>
                        <label class="form-check-label" for="sunday_day_closed">
                            Κλειστό
                        </label>
                    </div>
                    <h5>Βάρδια</h5>
                    <div class="col-md-6 mb-3">
                        <label for="from_sunday_day">Από:</label>
                        <select id="from_sunday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('00:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="from_sunday_day_error"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="until_sunday_day">Μέχρι:</label>
                        <select id="until_sunday_day" class="form-select">
                            <option selected value="0">-- Επιλέξτε Ώρα --</option>
                            <?php
                            $start_time = strtotime('00:00');
                            $end_time   = strtotime('23:30');
                            for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                ?>
                                <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="error_open_hour" id="until_sunday_day_error"></p>
                    </div>

                    <button class="btn extra_vardia" id="btn_extra_vardia_sunday" data-toggle="collapse" href="#collapseExtraVardiaSunday" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i id="btn_icon_sunday" class="fa fa-plus"></i>
                    </button>

                    <div class="collapse" id="collapseExtraVardiaSunday">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_sunday_day_extra" value="0" id="sunday_day_extra_open">
                            <label class="form-check-label" for="sunday_day_extra_open">
                                Ανοιχτό
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_sunday_day_extra" value="1" id="sunday_day_extra_closed" checked>
                            <label class="form-check-label" for="sunday_day_extra_closed">
                                Κλειστό
                            </label>
                        </div>
                        <h5>Επιπλέον Βάρδια</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="from_sunday_day_extra">Από:</label>
                                <select id="from_sunday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('00:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="from_sunday_day_extra_error"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="until_sunday_day_extra">Μέχρι:</label>
                                <select id="until_sunday_day_extra" class="form-select">
                                    <option selected value="0">-- Επιλέξτε Ώρα --</option>
                                    <?php
                                    $start_time = strtotime('00:00');
                                    $end_time   = strtotime('23:30');
                                    for ($i=$start_time; $i<=$end_time; $i = $i + 30*60){
                                        ?>
                                        <option value="<?php echo date('H:i',$i) ?>"><?php echo date('H:i',$i) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="error_open_hour" id="until_sunday_day_extra_error"></p>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-info" id="btn_save_sunday_day">Αποθήκευση</button>

                </div>
            </div>

        </div>
    </div>


</div>


</body>
</html>
