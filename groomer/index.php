<!--------------------------- This Page is For Groomer Login ---------------------------------->
<?php
require_once '../includes/database/config.php';
require_once 'groomer_server.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon.png" type="image" sizes="16x16">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <!--######################### Load Groomer Login Custom Styling ############################-->
    <link rel="stylesheet" href="assets/css/groomer_login.css?<?php echo time(); ?>">
    <!--########################## Load Groomer Login Custom JS #################################-->
    <script src="assets/js/groomer_login.js?<?php echo time(); ?>"></script>
    <title>Groomer Login Page</title>
</head>
<body>

<div class="col-md-12">
    <div class="d-flex justify-content-center align-items-center">
        <form name="groomer_login_form" id="groomer_login_form" method="post">
            <img src="assets/images/login_logo.png" alt="logo_img"/>
            <h3 class="header_form">Κάνε Σύνδεση</h3>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="groomer_email">Email</label><span class="required"> *</span>
                    <input type="email" class="form-control " id="groomer_email" name="groomer_email" autocomplete="off"  >
                    <p class="error_form" id="groomer_email_error"></p>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="groomer_password">Κωδικός Πρόσβασης</label><span class="required"> *</span>
                    <div class="input-group">
                        <input type="password" class="form-control" id="groomer_password" name="groomer_password" autocomplete="off">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i onclick="show_hide_password()" id="eye" class="bi bi-eye-fill"></i></span>
                        </div>
                    </div>
                    <p class="error_form" id="groomer_password_error"></p>
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="groomer_remember_me" name="groomer_remember_me" >
                <label class="form-check-label" for="groomer_remember_me">
                    <b>Να με θυμάσαι</b>
                </label>
            </div>
            <div>
                <p class="forget_password">Ξεχάσατε τον κωδικό σας;</p>
                <a href="groomer_forget_password.php" class="forget_password">Επαναφορά</a>
            </div>
            <div>
                <p class="link_not_member">Δεν έχετε λογαριασμό;</p>
                <a href="groomer_register.php" class="link_not_member">Εγγραφείτε</a>
            </div>
            <div class="form-group col-md-12">
                <button type="button" id="btn_groomer_login" name='btn_groomer_login' class="btn btn-primary btn-lg btn-block">Συνδέσου</button>
                <p class="error_form" id="groomer_invalid_credits_error"></p>
            </div>
        </form>
    </div>
</div>

</body>
</html>