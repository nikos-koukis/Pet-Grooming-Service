<?php
require_once '../includes/database/config.php';
require_once 'user_server.php';

//If token exist then give email
//If token does not exist then redirect to login page

if(isset($_GET['token'])){
    $token = mysqli_real_escape_string($db,$_GET['token']);
    $query = "SELECT * FROM reset_password WHERE token='$token'";
    $result = mysqli_query($db,$query);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $token = $row['token'];
        $email = $row['email'];
    }else{
        echo "<script>window.location = 'https://groomedoo.eu/';</script>";
    }
}else{
    echo "<script>window.location = 'https://groomedoo.eu/';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/favicon.png" type="image" sizes="16x16">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <!--################# Load User Change Password Custom Styling ##############################################-->
    <link rel="stylesheet" href="assets/css/user_reset_password.css?<?php echo time(); ?>">
    <!--################# Load User Change Password Custom Custom JS ############################################-->
    <script src="assets/js/user_reset_password.js?<?php echo time(); ?>"></script>
    <title>Επαναφορά Κωδικού Πρόσβασης</title>
</head>
<body>


<div class="col-md-12">
    <div class="d-flex justify-content-center align-items-center">
        <form>
            <h3 class="header_form">Αλλαγή Κωδικού Πρόσβασης</h3>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="user_email">Email</label><span class="required"> *</span>
                    <input type="email" class="form-control " id="user_email" readonly autocomplete="off" value="<?php echo $row['email'] ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="user_password">Κωδικός Πρόσβασης</label><span class="required"> *</span>
                    <div class="input-group">
                        <input type="password" class="form-control" id="user_password" autocomplete="off">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i onclick="show_hide_password()" id="eye" class="bi bi-eye-fill"></i></span>
                        </div>
                    </div>
                    <p class="error_form" id="user_password_error"></p>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="user_confirm_password">Επιβεβαίωση Κωδικού</label><span class="required"> *</span>
                    <div class="input-group">
                        <input type="password" class="form-control" id="user_confirm_password" autocomplete="off">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i onclick="show_hide_confirm_password()" id="eye_slash" class="bi bi-eye-fill"></i></span>
                        </div>
                    </div>
                    <p class="error_form" id="user_confirm_password_error"></p>
                </div>
            </div>
            <div class="form-group col-md-12">
                <button type="button" id="btn_user_reset_pass" class="btn btn-warning btn-lg btn-block">Αλλαγή Κωδικού</button>
            </div>
        </form>
    </div>
</div>




</body>
</html>