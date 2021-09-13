<?php
require_once '../includes/database/config.php';

//If token exist then give email
//If token does not exist then redirect to login page

if(isset($_GET['token'])){
    $token = mysqli_real_escape_string($db,$_GET['token']);
    $query = "SELECT * FROM email_verification WHERE token='$token'";
    $result = mysqli_query($db,$query);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $token = $row['token'];
        $email = $row['email'];
    }else{
        echo "<script>window.location = '../groomer/index.php';</script>";
    }
}else{
    echo "<script>window.location = '../groomer/index.php';</script>";
}
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
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <!--################################## Load Verified Account Custom Styling ####################################-->
    <link rel="stylesheet" href="assets/css/verified_account.css">
    <!--###################################### Load Verified Account Custom JS ####################################-->
    <script src="assets/js/verified_account.js"></script>
    <title>Επαλήθευση Λογαριασμού</title>
</head>
<body>

<div class="col-md-12">
    <div class="d-flex justify-content-center align-items-center">
        <form method="post">
            <h3 class="header_form">Επαλήθευση Λογαριασμού</h3>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="verified_email">Email</label><span class="required"> *</span>
                    <input type="email" class="form-control " id="verified_email" name="verified_email" readonly autocomplete="off" value="<?php echo $row['email'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="verified_code">Κωδικός Επαλήθευσης</label><span class="required"> *</span>
                    <input type="text" class="form-control " id="verified_code" name="verified_code" autocomplete="off">
                    <small>Εισάγεται τον 6ψήφιο κωδικό επαλήθευσης</small>
                    <p class="error_form" id="verified_code_error"></p>
                </div>
            </div>
            <div class="form-group col-md-12">
                <button type="button" id="btn_vierfied_account" name='btn_vierfied_account' class="btn btn-warning btn-lg btn-block">Επαλήθευση Λογαριασμού</button>
            </div>
        </form>
    </div>
</div>


</body>
</html>