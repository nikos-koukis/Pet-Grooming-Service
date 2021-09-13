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
}
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
    <!--######################### Load User Profile Custom Styling ############################-->
    <link rel="stylesheet" href="assets/css/user_profile.css?<?php echo time(); ?>">
    <!--######################### Load User Profile Custom Javascript ############################-->
    <script src="assets/js/user_profile.js?<?php echo time(); ?>"></script>

    <title>Προφίλ Χρήστη</title>
</head>
<body>

<!--####### Load Navbar ##########-->

<?php
require_once '../navbar/navbar.php';
?>

<div class="container">
    <div class="container_info">
        <div class="profile_header">
            <p>Τα στοιχεία μου</p>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <label for="user_email">Email:</label><span class="required"> *</span>
            </div>
            <div class="col-sm">
                <input type="text" class="form-control" id="user_email" value="<?php echo $email; ?>" disabled/>
                <p class="error_profile"  id="profile_email_error"></p>
            </div>
            <div class="col-sm">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <label for="user_name">Όνομα:</label><span class="required"> *</span>
            </div>
            <div class="col-sm">
                <input type="text" class="form-control" id="user_name"  />
                <p class="error_profile" id="profile_user_name_error"></p>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-primary" id="profile_edit_user_name_btn">Ενημέρωση Ονομάτος</button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <label for="user_surname">Επώνυμο:</label><span class="required"> *</span>
            </div>
            <div class="col-sm">
                <input type="text" class="form-control" id="user_surname"  />
                <p class="error_profile" id="profile_user_surname_error"></p>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-primary" id="profile_edit_user_surname_btn">Ενημέρωση Επωνύμου</button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <label for="user_phone">Κινητό:</label><span class="required"> *</span>
            </div>
            <div class="col-sm">
                <input type="text" class="form-control" id="user_phone"  />
                <p class="error_profile" id="profile_user_phone_error"></p>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-primary" id="profile_edit_user_phone_btn">Ενημέρωση Κινητού</button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <label for="user_city" >Πόλη:</label><span class="required"> *</span>
            </div>
            <div class="col-sm">
                <select id="user_city" class="form-select">
                    <option selected value="0">-- Επιλέξτε --</option>
                    <option value="1">Πάτρα</option>
                    <option value="2">Αθήνα</option>
                    <option value="3">Θεσσαλονίκη</option>
                </select>
                <p class="error_profile" id="profile_user_city_error"></p>
            </div>
            <div class="col-sm">
                <button type="button" class="btn btn-primary" id="profile_edit_user_city_btn">Ενημέρωση Πόλης</button>
            </div>
        </div>
    </div>

    <div class="container_info">
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
                                    <label for="current_user_password">Τωρινός Κωδικός Πρόσβασης:</label><span class="required"> *</span>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="current_user_password">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i onclick="show_hide_current_password()" id="eye" class="bi bi-eye-fill"></i></span>
                                        </div>
                                    </div>
                                    <p class="error_profile" id="profile_current_user_password_error"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="new_user_password">Νέος Κωδικός Πρόσβασης:</label><span class="required"> *</span>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="new_user_password">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i onclick="show_hide_new_password()" id="eye_slash" class="bi bi-eye-fill"></i></span>
                                        </div>
                                    </div>
                                    <p class="error_profile" id="profile_new_user_password_error"></p>
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
                                    <label for="con_user_password">Επαλήθευση Κωδικού Πρόσβασης:</label><span class="required"> *</span>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="con_user_password">
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



</body>
</html>