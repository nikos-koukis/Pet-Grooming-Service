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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js'></script>
    <!--############################# Load Groomer Register Custom Styling ####################################-->
    <link rel="stylesheet" href="assets/css/groomer_register.css?<?php echo time(); ?>">
    <!--############################# Load Groomer Register Custom JS #########################################-->
    <script src="assets/js/groomer_register.js?<?php echo time(); ?>"></script>
    <title>Εγγραφή Groomer</title>
</head>
<body>
<div class="row g-0">
    <div class="col-md-6 g-0">
        <div class="leftside d-flex justify-content-center align-items-center">
            <form name="groomer_register_form" id="groomer_register_form">
                <h2 class="welcome_header_form">Είσαι Animal Groomer?</h2>
                <h5 class="header_form">Κάνε την εγγραφή σου</h5>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="groomer_email">Email</label><span class="required"> *</span>
                        <input type="email" class="form-control " id="groomer_email" autocomplete="off">
                        <p class="error_form" id="groomer_email_error"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="groomer_company">Εταιρεία</label><span class="required"> *</span>
                        <input type="text" class="form-control" id="groomer_company" autocomplete="off">
                        <p class="error_form" id="groomer_company_error"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="groomer_phone">Κινητό</label><span class="required"> *</span>
                        <input type="phone" class="form-control" id="groomer_phone" autocomplete="off">
                        <p class="error_form" id="groomer_phone_error"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="groomer_afm">Α.Φ.Μ</label><span class="required"> *</span>
                        <input type="text" class="form-control" id="groomer_afm" autocomplete="off">
                        <p class="error_form" id="groomer_afm_error"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="groomer_address">Διεύθυνση</label><span class="required"> *</span>
                        <input type="text" class="form-control" id="groomer_address" autocomplete="off">
                        <p class="error_form" id="groomer_address_error"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="groomer_city">Πόλη</label><span class="required"> *</span>
                        <select id="groomer_city" class="form-select">
                            <option selected value="0">-- Επιλέξτε --</option>
                            <option value="1">Πάτρα</option>
                            <option value="2">Αθήνα</option>
                            <option value="3">Θεσσαλονίκη</option>
                        </select>
                        <p class="error_form" id="groomer_city_error"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="groomer_postcode">Ταχυδρομικός Κώδικας</label><span class="required"> *</span>
                        <input type="text" class="form-control" id="groomer_postcode" autocomplete="off">
                        <p class="error_form" id="groomer_postcode_error"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="groomer_password">Κωδικός Πρόσβασης</label><span class="required"> *</span>
                        <div class="input-group">
                            <input type="password" class="form-control" id="groomer_password" autocomplete="off">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i onclick="show_hide_password()" id="eye" class="bi bi-eye-fill"></i></span>
                            </div>
                        </div>
                        <p class="error_form" id="groomer_password_error"></p>
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
                    <div class="form-group col-md-12">
                        <label for="groomer_confirm_password">Επιβεβαίωση Κωδικού</label><span class="required"> *</span>
                        <div class="input-group">
                            <input type="password" class="form-control" id="groomer_confirm_password" autocomplete="off">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i onclick="show_hide_confirm_password()" id="eye_slash" class="bi bi-eye-fill"></i></span>
                            </div>
                        </div>
                        <p class="error_form" id="groomer_confirm_password_error"></p>
                    </div>
                </div>
                <div>
                    <p class="link_already_member">Είστε ήδη μέλος;</p>
                    <a href="index.php" class="link_already_member">Σύνδεση</a>
                </div>
                <div class="form-group col-md-12 btn_div">
                    <button type="submit" id="btn_register_groomer" name='btn_register_groomer' class="btn btn-warning btn-lg btn-block">Εγγραφή Groomer</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6 g-0">
        <div class="rightside d-flex justify-content-center align-items-center">
        </div>
    </div>
</div>
</body>
</html>