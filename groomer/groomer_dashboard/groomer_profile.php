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
    <!--######################### Load Bootstrap Styling ############################-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--######################### Load Bootstrap Javascript ############################-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
    <!--######################### Load Groomer Profile Custom Styling ############################-->
    <link rel="stylesheet" href="assets/css/groomer_profile.css?<?php echo time(); ?>">
    <!--######################### Load Groomer Profile Custom JS ############################-->
    <script src="assets/js/groomer_profile.js?<?php echo time(); ?>"></script>
    <!--######################### Load Ajax JS ############################-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <title>Groomer Dashboard</title>
</head>
<body>

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
            Το προφίλ μου
        </div>
    </div>
    <div class="main-content">


        <div class="container">

            <div class="profile_header">
                <p>Τα στοιχεία μου</p>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <label for="email">Email:</label>
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="email" value="<?php echo $email; ?>" disabled>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <label for="company">Εταιρεία:</label><span class="required"> *</span>
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" id="company">
                    <p class="error_profile" id="profile_company_error"></p>
                </div>
                <div class="col-sm">
                    <button type="button" class="btn btn-primary" id="profile_edit_company_btn">Ενημέρωση Εταιρείας</button>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <label for="city" >Πόλη:</label><span class="required"> *</span>
                </div>
                <div class="col-sm">
                    <select id="city" class="form-select">
                        <option selected value="0">-- Επιλέξτε --</option>
                        <option value="1">Πάτρα</option>
                        <option value="2">Αθήνα</option>
                        <option value="3">Θεσσαλονίκη</option>
                    </select>
                    <p class="error_profile" id="profile_city_error"></p>
                </div>
                <div class="col-sm">
                    <button type="button" class="btn btn-primary" id="profile_edit_city_btn">Ενημέρωση Πόλης</button>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <label for="address">Διεύθυνση:</label><span class="required"> *</span>
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" id="address">
                    <p class="error_profile" id="profile_address_error"></p>
                </div>
                <div class="col-sm">
                    <button type="button" class="btn btn-primary" id="profile_edit_address_btn">Ενημέρωση Διεύθυνσης</button>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <label for="postcode">Τ.Κ:</label><span class="required"> *</span>
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" id="postcode">
                    <p class="error_profile" id="profile_postcode_error"></p>
                </div>
                <div class="col-sm">
                    <button type="button" class="btn btn-primary" id="profile_edit_postcode_btn">Ενημέρωση Τ.Κ</button>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <label for="phone">Κινητό:</label><span class="required"> *</span>
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" id="phone">
                    <p class="error_profile" id="profile_phone_error"></p>
                </div>
                <div class="col-sm">
                    <button type="button" class="btn btn-primary" id="profile_edit_phone_btn">Ενημέρωση Κινητού</button>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <label for="afm">ΑΦΜ:</label><span class="required"> *</span>
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" id="afm" >
                    <p class="error_profile" id="profile_afm_error"></p>
                </div>
                <div class="col-sm">
                    <button type="button" class="btn btn-primary" id="profile_edit_afm_btn">Ενημέρωση ΑΦΜ</button>
                </div>
            </div>

        </div>

        <div class="container">
            <div id="accordion">
                <div class="card">
                    <h5 class="card-header">
                        <a data-toggle="collapse" href="#password_form_collapse" aria-expanded="true" aria-controls="collapse-example" id="link_password_collapsed" class="d-block">
                            <i class="fa fa-chevron-down pull-right"></i>
                            Αλλαγή Κωδικού Πρόσβασης
                        </a>
                    </h5>
                    <div id="password_form_collapse" class="collapse show" aria-labelledby="heading-example">
                        <div class="card-body">

                            <span>
                                 <i class='bx bx-error-circle' id="error_icon_text"></i>
                                <p id="error_icon_text">Επεξεργασία ευαίσθητων δεδομένων</p>
                            </span>
                            <form method="post">

                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="current_groomer_password">Τωρινός Κωδικός Πρόσβασης:</label><span class="required"> *</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="current_groomer_password">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i onclick="show_hide_current_password()" id="eye" class="bi bi-eye-fill"></i></span>
                                            </div>
                                        </div>
                                        <p class="error_profile" id="profile_current_password_error"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="new_groomer_password">Νέος Κωδικός Πρόσβασης:</label><span class="required"> *</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="new_groomer_password">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i onclick="show_hide_new_password()" id="eye_slash" class="bi bi-eye-fill"></i></span>
                                            </div>
                                        </div>
                                        <p class="error_profile" id="profile_new_password_error"></p>
                                        <p>Ισχύς Κωδικού Πρόσβασης: <span id="result"> </span></p>
                                        <div class="progress">
                                            <div id="password-strength" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                        <ul class="list-unstyled">
                                            <li class=""><span class="low-upper-case"><i class="fa fa-times" aria-hidden="true"></i></span>&nbsp; Τουλάχιστον 1 μικρό &amp; 1 κεφαλαίο γράμμα</li>
                                            <li class=""><span class="one-number"><i class="fa fa-times" aria-hidden="true"></i></span> &nbsp;Τουλάχιστον 1 αριθμό (0-9)</li>
                                            <li class=""><span class="one-special-char"><i class="fa fa-times" aria-hidden="true"></i></span> &nbsp;Τουλάχιστον 1 ειδικό χαρακτήρα (!@#$%^&*).</li>
                                            <li class=""><span class="eight-character"><i class="fa fa-times" aria-hidden="true"></i></span>&nbsp; Τουλάχιστον 8 χαρακτήρες</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="con_groomer_password">Επαλήθευση Κωδικού Πρόσβασης:</label><span class="required"> *</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="con_groomer_password">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i onclick="show_hide_con_password()" id="eye_slash_con" class="bi bi-eye-fill"></i></span>
                                            </div>
                                        </div>
                                        <p class="error_profile" id="profile_con_password_error"></p>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger" id="profile_change_password_btn">Αλλαγή Κωδικού Πρόσβασης</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

</div>
<!-- END MAIN CONTENT -->


</body>

</html>