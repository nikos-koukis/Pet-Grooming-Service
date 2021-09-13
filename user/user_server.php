<?php

require_once '../includes/database/config.php';

use PHPMailer\PHPMailer\PHPMailer;

######################################## Register User ###############################################

######################################################################################################


if(isset($_POST['user_register_from_ajax'])){

    $user_email = $db->real_escape_string($_POST['user_register_email']);
    $user_name =  $db->real_escape_string($_POST['user_register_name']);
    $user_surname =  $db->real_escape_string($_POST['user_register_surname']);
    $user_phone =  $db->real_escape_string($_POST['user_register_phone']);
    $user_city =  $db->real_escape_string($_POST['user_register_city']);
    $password =  $db->real_escape_string($_POST['user_register_password']);
    $user_password = password_hash($password, PASSWORD_BCRYPT);

    $check_user_email = "SELECT * FROM user WHERE email='$user_email'";
    $check_email_result = mysqli_query($db,$check_user_email);

    if($check_email_result->num_rows > 0){
        exit("error_user_email_exist");
    }else{

        $query = "INSERT INTO user (email, name, surname, phone, city, password)
            VALUES ('$user_email', '$user_name','$user_surname','$user_phone','$user_city','$user_password'
            )";

        $result = mysqli_query($db,$query);

    }
}

######################################################################################################

######################################## Send Email When User Registered ###############################################


if(isset($_POST['user_register_send_email_from_ajax'])){

    $user_email = $db->real_escape_string($_POST['user_register_email']);

    $token = uniqid(md5(time()));
    $six_digit_random_number = mt_rand(100000, 999999);
    $query = "INSERT INTO email_verification(email,token,code) VALUES ('$user_email','$token','$six_digit_random_number')";
    $result = mysqli_query($db,$query);

    if($result){

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->Host       = $_ENV["EMAIL_HOST"];
        $mail->Username   = $_ENV["EMAIL_NAME"];
        $mail->Password   = $_ENV["EMAIL_PASS"];
        $mail->SMTPSecure = $_ENV["EMAIL_SECURITY"];
        $mail->Port       = $_ENV["EMAIL_PORT"];

        $mail->addAddress($user_email);
        $mail->setFrom( $mail->Username);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Επαλήθευση Λογαριασμού';
        $url = "<a href='https://groomedoo.eu/user/verification/verified_account.php?token=$token'>σύνδεσμο</a>";
        $mail->Body    = "Πατήστε τον $url για να επαληθεύσετε τον λογαριασμό σας με τον παρακάτω 6ψήφιο κωδικό.<br><br><b>Κωδικός Επαλήθευσης:</b> $six_digit_random_number";

        if($mail->send()) {
            echo "Email sending successfully...";
        } else {
            echo "Email sending failed...";
        }

    }

}

#########################################################################################################
############################## User Verification Email ###############################################

if(isset($_POST['verification'])) {

    $verified_email = $db->real_escape_string($_POST['verified_email']);
    $verified_code = $db->real_escape_string($_POST['verified_code']);

    $query = "SELECT * FROM email_verification WHERE email='$verified_email' AND code='$verified_code'";
    $result = mysqli_query($db,$query);

    if($result->num_rows > 0){
        $query2 = "UPDATE user SET verified=1 WHERE email='$verified_email'";
        $result2 = mysqli_query($db,$query2);
        if($result2){
            $del_query = "DELETE FROM email_verification WHERE email='$verified_email'";
            $del_result = mysqli_query($db,$del_query);
            exit("success");
        }else{
            exit("error");
        }
        exit("match");
    }else{
        exit("dont match");
    }

}

#########################################################################################################

######################################### Forget Verified Email ##########################################


if(isset($_POST['forget_verified_code_from_ajax'])) {

    $user_email = $db->real_escape_string($_POST['user_email']);

    $check_user_email = "SELECT * FROM user WHERE email='$user_email'";
    $check_email_result = mysqli_query($db,$check_user_email);

    if($check_email_result->num_rows == 0){
        exit("error"); //Den uparxei tetoio email
    }

}

############################ Send Email About Forget Verified Email ##########################################

if(isset($_POST['forget_verified_code_send_email_from_ajax'])){

    $user_email = $db->real_escape_string($_POST['user_email']);

    $token = uniqid(md5(time()));
    $six_digit_random_number = mt_rand(100000, 999999);
    $query = "INSERT INTO email_verification(email,token,code) VALUES ('$user_email','$token','$six_digit_random_number')";
    $result = mysqli_query($db,$query);

    if($result){

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->Host       = $_ENV["EMAIL_HOST"];
        $mail->Username   = $_ENV["EMAIL_NAME"];
        $mail->Password   = $_ENV["EMAIL_PASS"];
        $mail->SMTPSecure = $_ENV["EMAIL_SECURITY"];
        $mail->Port       = $_ENV["EMAIL_PORT"];

        $mail->addAddress($user_email);
        $mail->setFrom( $mail->Username);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Επαλήθευση Λογαριασμού';
        $url = "<a href='https://groomedoo.eu/user/verification/verified_account.php?token=$token'>σύνδεσμο</a>";
        $mail->Body    = "Πατήστε τον $url για να επαληθεύσετε τον λογαριασμό σας με τον παρακάτω 6ψήφιο κωδικό.<br><br><b>Κωδικός Επαλήθευσης:</b> $six_digit_random_number";

        if($mail->send()) {
            echo "Email sending successfully...";
        } else {
            echo "Email sending failed...";
        }
    }
}

#########################################################################################################
################################### User Forget Password #############################################

if(isset($_POST['user_forget_pass_from_ajax'])){

    $user_email = $db->real_escape_string($_POST['user_email']);

    $check_user_email = "SELECT * FROM user WHERE email='$user_email'";
    $check_email_result = mysqli_query($db,$check_user_email);

    if($check_email_result->num_rows == 0){
        exit("error"); //Den uparxei tetoio email
    }
}


######################## Send Email About User Forget Password ##########################################

if(isset($_POST['user_forget_pass_send_email_from_ajax'])){

    $user_email = $db->real_escape_string($_POST['user_email']);

    $token = uniqid(md5(time()));
    $query = "INSERT INTO reset_password(email,token) VALUES ('$user_email','$token')";
    $result = mysqli_query($db,$query);

    if($result){

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->Host       = $_ENV["EMAIL_HOST"];
        $mail->Username   = $_ENV["EMAIL_NAME"];
        $mail->Password   = $_ENV["EMAIL_PASS"];
        $mail->SMTPSecure = $_ENV["EMAIL_SECURITY"];
        $mail->Port       = $_ENV["EMAIL_PORT"];

        $mail->addAddress($user_email);
        $mail->setFrom( $mail->Username);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Επαναφορά Κωδικού Πρόσβασης';
        $url = "<a href='https://groomedoo.eu/user/user_reset_password.php?token=$token'>σύνδεσμο</a>";
        $mail->Body    = "Πατήστε τον $url για να επαναφέρετε τον κωδικό σας.";

        if($mail->send()) {
            echo "Email sending successfully...";
        } else {
            echo "Email sending failed...";
        }
    }
}

################################################################################################
####################### User Edit Profile - Retrieve Profile Data ##########################################



if(isset($_POST['user_change_pass_from_ajax'])) {

    $user_email = $db->real_escape_string($_POST['user_email']);
    $password = $db->real_escape_string($_POST['user_password']);
    $user_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "UPDATE user SET password='$user_password' WHERE email='$user_email'";
    $result = mysqli_query($db, $query);

    if ($result) {
        $del_query = "DELETE FROM reset_password WHERE email='$user_email'";
        $del_result = mysqli_query($db, $del_query);
        exit("success");
    } else {
        exit("error");
    }

}

################################################################################################

####################### User Change Password - Reset  ##########################################

if(isset($_POST['user_profile_from_ajax'])) {

    $user_email = $db->real_escape_string($_POST['user_email']);

    $query = "SELECT * FROM user WHERE email='$user_email'";
    $result = mysqli_query($db,$query);

    $return_arr = array();

    while($row = mysqli_fetch_array($result)){
        $user_name = $row['name'];
        $user_surname = $row['surname'];
        $user_phone = $row['phone'];
        $user_city = $row['city'];

        $return_arr[] = array("name" => $user_name, "surname" => $user_surname, "phone" => $user_phone ,"city"=> $user_city);

    }
    exit(json_encode($return_arr));
}

################################################################################################
####################### User Edit Profile Name  ################################################

if(isset($_POST['profile_edit_user_name_from_ajax'])) {

    $user_name = $db->real_escape_string($_POST['user_name']);
    $user_email = $db->real_escape_string($_POST['user_email']);

    $query = "UPDATE user SET name='$user_name' WHERE email='$user_email'";

    $result = mysqli_query($db,$query);

    if($result){
        exit("success");
    }

}

################################################################################################
####################### User Edit Profile Surname  #############################################
if(isset($_POST['profile_edit_user_surname_from_ajax'])) {

    $user_surname = $db->real_escape_string($_POST['user_surname']);
    $user_email = $db->real_escape_string($_POST['user_email']);

    $query = "UPDATE user SET surname='$user_surname' WHERE email='$user_email'";

    $result = mysqli_query($db,$query);

    if($result){
        exit("success");
    }

}

################################################################################################
####################### User Edit Profile Phone  #############################################
if(isset($_POST['profile_edit_user_phone_from_ajax'])) {

    $user_phone = $db->real_escape_string($_POST['user_phone']);
    $user_email = $db->real_escape_string($_POST['user_email']);

    $query = "UPDATE user SET phone='$user_phone' WHERE email='$user_email'";

    $result = mysqli_query($db,$query);

    if($result){
        exit("success");
    }

}

################################################################################################
####################### User Edit Profile City  #############################################
if(isset($_POST['profile_edit_user_city_from_ajax'])) {

    $user_city = $db->real_escape_string($_POST['user_city']);
    $user_email = $db->real_escape_string($_POST['user_email']);

    $query = "UPDATE user SET city='$user_city' WHERE email='$user_email'";

    $result = mysqli_query($db,$query);

    if($result){
        exit("success");
    }

}

################################################################################################
####################### Θσερ Edit Profile Current Password ##########################################

if(isset($_POST['user_profile_edit_current_password_from_ajax'])) {

    $user_email = $db->real_escape_string($_POST['email']);
    $current_user_password = $db->real_escape_string($_POST['current_password']);
    $new_user_password = $db->real_escape_string($_POST['new_password']);


    $query = "SELECT * FROM user WHERE email='$user_email' ";
    $result = mysqli_query($db,$query);


    if($result->num_rows > 0) {
        $row = mysqli_fetch_array($result);

        $current_password = $row['password'];

        if(password_verify($current_user_password, $row['password'])){

            $hash_password = password_hash($new_user_password, PASSWORD_BCRYPT);

            $query_update = "UPDATE user SET password='$hash_password' WHERE email='$user_email' ";
            $result_update = mysqli_query($db,$query_update);
            if($result_update){
                exit("success_changed_password");
            }
        }else{
            exit('error_current_password');
        }
    }

}


#########################################################################################################
############################## USER Log In ###########################################################
session_start();
if(isset($_SESSION['userLoggedIN']) && $_SESSION['user_remember_me']){
    header('Location: ../');
    exit();
}


if(isset($_POST['user_login_from_ajax'])){

    $user_email = $db->real_escape_string($_POST['user_email']);
    $user_password = $db->real_escape_string($_POST['user_password']);
    $user_remember_me = isset($_POST['user_remember_me']);

    $query = "SELECT * FROM user WHERE email='$user_email' ";
    $result = mysqli_query($db,$query);

    if($result->num_rows > 0){

        $row = mysqli_fetch_array($result);
        $verified = $row['verified'];

        if(password_verify($user_password, $row['password'])){

            if($verified == false){
                exit("not_verified");
            }else{

                if (!empty($_POST['user_remember_me'])) {
                    setcookie("email",$user_email, time() + (10*365*24*60*60));
                }else{
                    if (isset($_COOKIE["email"])) {
                        setcookie("email","");
                    }
                }

                $_SESSION['userLoggedIN'] = '1';
                $_SESSION['email'] = $user_email;
                $_SESSION['user_remember_me'] = $user_remember_me;
                exit("success");

            }

        }else{
            exit("error");
        }

    }else{
        exit("error_login");
    }

}
