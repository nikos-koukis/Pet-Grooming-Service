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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <!--################### Load Groomer Forget Password Custom Styling ################################-->
    <link rel="stylesheet" href="assets/css/groomer_forget_password.css">
    <!--################### Load Groomer Forget Password Custom JS #####################################-->
    <script src="assets/js/groomer_forget_password.js"></script>
    <title>Groomer Forget Password</title>
</head>
<body>

<div class="col-md-12">
    <div class="d-flex justify-content-center ">
        <form>
            <img src="assets/images/reset_pass_logo.png" alt="logo_img">
            <h3 class="header_form">Επαναφορά Κωδικού Πρόσβασης</h3>
            <div class="form-group col-md-12">
                <label for="groomer_email">Email</label><span class="required"> *</span>
                <input type="email" class="form-control form-control-lg" id="groomer_email" name="groomer_email" autocomplete="off">
                <p class="error_form" id="groomer_email_error"></p>
            </div>
            <div class="form-group col-md-12">
                <button type="button" id="btn_groomer_forget_pass" name='btn_groomer_forget_pass' class="btn btn-primary btn-lg btn-block">Επαναφορά</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>