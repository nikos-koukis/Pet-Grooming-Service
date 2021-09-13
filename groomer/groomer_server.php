<?php

require_once '../includes/database/config.php';

use PHPMailer\PHPMailer\PHPMailer;

######################################## Register Groomer ###############################################

#########################################################################################################

if(isset($_POST['groomer_register_from_ajax'])){

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $groomer_company =  $db->real_escape_string($_POST['groomer_company']);
    $groomer_phone =  $db->real_escape_string($_POST['groomer_phone']);
    $groomer_afm =  $db->real_escape_string($_POST['groomer_afm']);
    $groomer_address =  $db->real_escape_string($_POST['groomer_address']);
    $groomer_city =  $db->real_escape_string($_POST['groomer_city']);
    $groomer_postcode =  $db->real_escape_string($_POST['groomer_postcode']);
    $password =  $db->real_escape_string($_POST['groomer_password']);
    $groomer_password = password_hash($password, PASSWORD_BCRYPT);

    $check_groomer_email = "SELECT * FROM groomer WHERE email='$groomer_email'";
    $check_email_result = mysqli_query($db,$check_groomer_email);

    if($check_email_result->num_rows > 0){
        exit("error_groomer_email_exist");
    }else{

        $query = "INSERT INTO groomer (email, company, city, address, postcode, phone, afm, password) 
            VALUES ('$groomer_email', '$groomer_company','$groomer_city','$groomer_address','$groomer_postcode', 
            '$groomer_phone', '$groomer_afm','$groomer_password'
            )";

        $result = mysqli_query($db,$query);

    }
}

if(isset($_POST['groomer_register_send_email_from_ajax'])){

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);

    $token = uniqid(md5(time()));
    $six_digit_random_number = mt_rand(100000, 999999);
    $query = "INSERT INTO email_verification(email,token,code) VALUES ('$groomer_email','$token','$six_digit_random_number')";
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

        $mail->addAddress($groomer_email);
        $mail->setFrom( $mail->Username);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Επαλήθευση Λογαριασμού';
        $url = "<a href='https://groomedoo.eu/common/verified_account.php?token=$token'>σύνδεσμο</a>";
        $mail->Body    = "Πατήστε τον $url για να επαληθεύσετε τον λογαριασμό σας με τον παρακάτω 6ψήφιο κωδικό.<br><br><b>Κωδικός Επαλήθευσης:</b> $six_digit_random_number";

        if($mail->send()) {
            echo "Email sending successfully...";
        } else {
            echo "Email sending failed...";
        }

    }

}

#########################################################################################################
############################## Groomer Verification Email ###############################################

if(isset($_POST['verification'])) {

    $verified_email = $db->real_escape_string($_POST['verified_email']);
    $verified_code = $db->real_escape_string($_POST['verified_code']);

    $query = "SELECT * FROM email_verification WHERE email='$verified_email' AND code='$verified_code'";
    $result = mysqli_query($db,$query);

    if($result->num_rows > 0){
        $query2 = "UPDATE groomer SET verified=1 WHERE email='$verified_email'";
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

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);

    $check_groomer_email = "SELECT * FROM groomer WHERE email='$groomer_email'";
    $check_email_result = mysqli_query($db,$check_groomer_email);

    if($check_email_result->num_rows == 0){
        exit("error"); //Den uparxei tetoio email
    }

}

############################ Send Email About Forget Verified Email ##########################################

if(isset($_POST['forget_verified_code_send_email_from_ajax'])){

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);

    $token = uniqid(md5(time()));
    $six_digit_random_number = mt_rand(100000, 999999);
    $query = "INSERT INTO email_verification(email,token,code) VALUES ('$groomer_email','$token','$six_digit_random_number')";
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

        $mail->addAddress($groomer_email);
        $mail->setFrom( $mail->Username);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Επαλήθευση Λογαριασμού';
        $url = "<a href='https://groomedoo.eu/common/verified_account.php?token=$token'>σύνδεσμο</a>";
        $mail->Body    = "Πατήστε τον $url για να επαληθεύσετε τον λογαριασμό σας με τον παρακάτω 6ψήφιο κωδικό.<br><br><b>Κωδικός Επαλήθευσης:</b> $six_digit_random_number";

        if($mail->send()) {
            echo "Email sending successfully...";
        } else {
            echo "Email sending failed...";
        }
    }
}

#########################################################################################################
################################### Groomer Forget Password #############################################

if(isset($_POST['groomer_forget_pass_from_ajax'])){

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);

    $check_groomer_email = "SELECT * FROM groomer WHERE email='$groomer_email'";
    $check_email_result = mysqli_query($db,$check_groomer_email);

    if($check_email_result->num_rows == 0){
        exit("error"); //Den uparxei tetoio email
    }

}

######################## Send Email About Groomer Forget Password ##########################################

if(isset($_POST['groomer_forget_pass_send_email_from_ajax'])){

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);

    $token = uniqid(md5(time()));
    $query = "INSERT INTO reset_password(email,token) VALUES ('$groomer_email','$token')";
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

        $mail->addAddress($groomer_email);
        $mail->setFrom( $mail->Username);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Επαναφορά Κωδικού Πρόσβασης';
        $url = "<a href='https://groomedoo.eu/groomer/groomer_reset_password.php?token=$token'>σύνδεσμο</a>";
        $mail->Body    = "Πατήστε τον $url για να επαναφέρετε τον κωδικό σας.";

        if($mail->send()) {
            echo "Email sending successfully...";
        } else {
            echo "Email sending failed...";
        }
    }
}

################################################################################################

####################### Groomer Change Password - Reset  ##########################################


if(isset($_POST['groomer_change_pass_from_ajax'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $password =  $db->real_escape_string($_POST['groomer_password']);
    $groomer_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "UPDATE groomer SET password='$groomer_password' WHERE email='$groomer_email'";
    $result = mysqli_query($db,$query);

    if($result){
        $del_query = "DELETE FROM reset_password WHERE email='$groomer_email'";
        $del_result = mysqli_query($db,$del_query);
        exit("success");
    }else{
        exit("error");
    }

}

################################################################################################
####################### Groomer Edit Profile  ##########################################

if(isset($_POST['groomer_profile_from_ajax'])){

    $email = $db->real_escape_string($_POST['email']);
    $query = "SELECT * FROM groomer WHERE email='$email'";
    $result = mysqli_query($db,$query);

    $return_arr = array();

    while($row = mysqli_fetch_array($result)){
        $company = $row['company'];
        $city = $row['city'];
        $address = $row['address'];
        $postcode = $row['postcode'];
        $phone = $row['phone'];
        $afm = $row['afm'];

        $return_arr[] = array("company" => $company, "city" => $city, "address" => $address ,"postcode"=> $postcode, "phone" => $phone, "afm"=>$afm);
    }

    exit(json_encode($return_arr));

}

################################################################################################
####################### Groomer Edit Profile Company  ##########################################

if(isset($_POST['profile_edit_company_from_ajax'])) {

    $company = $db->real_escape_string($_POST['company']);
    $email = $db->real_escape_string($_POST['email']);

    $query = "UPDATE groomer SET company='$company' WHERE email='$email'";

    $result = mysqli_query($db,$query);

    if($result){
        exit("success");
    }

}

################################################################################################
####################### Groomer Edit Profile City  ##########################################

if(isset($_POST['profile_edit_city_from_ajax'])) {

    $city = $db->real_escape_string($_POST['city']);
    $email = $db->real_escape_string($_POST['email']);

    $query = "UPDATE groomer SET city='$city' WHERE email='$email'";

    $result = mysqli_query($db,$query);

    if($result){
        exit("success");
    }

}

################################################################################################
####################### Groomer Edit Profile Address  ##########################################

if(isset($_POST['profile_edit_address_from_ajax'])) {

    $address = $db->real_escape_string($_POST['address']);
    $email = $db->real_escape_string($_POST['email']);

    $query = "UPDATE groomer SET address='$address' WHERE email='$email'";

    $result = mysqli_query($db,$query);

    if($result){
        exit("success");
    }

}

################################################################################################
####################### Groomer Edit Profile Postcode  ##########################################

if(isset($_POST['profile_edit_postcode_from_ajax'])) {

    $postcode = $db->real_escape_string($_POST['postcode']);
    $email = $db->real_escape_string($_POST['email']);

    $query = "UPDATE groomer SET postcode='$postcode' WHERE email='$email'";

    $result = mysqli_query($db,$query);

    if($result){
        exit("success");
    }

}

################################################################################################
####################### Groomer Edit Profile Phone ##########################################

if(isset($_POST['profile_edit_phone_from_ajax'])) {

    $phone = $db->real_escape_string($_POST['phone']);
    $email = $db->real_escape_string($_POST['email']);

    $query = "UPDATE groomer SET phone='$phone' WHERE email='$email'";

    $result = mysqli_query($db,$query);

    if($result){
        exit("success");
    }

}

################################################################################################
####################### Groomer Edit Profile AFM ##########################################

if(isset($_POST['profile_edit_afm_from_ajax'])) {

    $afm = $db->real_escape_string($_POST['afm']);
    $email = $db->real_escape_string($_POST['email']);

    $query = "UPDATE groomer SET afm='$afm' WHERE email='$email'";

    $result = mysqli_query($db,$query);

    if($result){
        exit("success");
    }

}

################################################################################################
####################### Groomer Edit Profile Current Password ##########################################

if(isset($_POST['profile_edit_current_password_from_ajax'])) {

    $groomer_email = $db->real_escape_string($_POST['email']);
    $current_groomer_password = $db->real_escape_string($_POST['current_password']);
    $new_groomer_password = $db->real_escape_string($_POST['new_password']);

    $query = "SELECT * FROM groomer WHERE email='$groomer_email' ";
    $result = mysqli_query($db,$query);


    if($result->num_rows > 0) {
        $row = mysqli_fetch_array($result);

        $current_password = $row['password'];

        if(password_verify($current_groomer_password, $row['password'])){

            $hash_password = password_hash($new_groomer_password, PASSWORD_BCRYPT);

            $query_update = "UPDATE groomer SET password='$hash_password' WHERE email='$groomer_email' ";
            $result_update = mysqli_query($db,$query_update);
            if($result_update){
                exit("success_changed_password");
            }
        }else{
            exit('error_current_password');
        }
    }
}

################################################################################################
####################### Save Closed Monday Working Hours #######################################

if(isset($_POST['closed_monday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_monday_day = $db->real_escape_string($_POST['from_monday_day']);
    $until_monday_day = $db->real_escape_string($_POST['until_monday_day']);
    $from_monday_day_extra = $db->real_escape_string($_POST['from_monday_day_extra']);
    $until_monday_day_extra = $db->real_escape_string($_POST['until_monday_day_extra']);

    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db,$query_groomer);

    if($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour= mysqli_query($db,$query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id,is_closed=1,status='closed',
                        from_hour='$from_monday_day', until_hour='$until_monday_day', from_hour_extra='$from_monday_day_extra', 
                        until_hour_extra='$until_monday_day_extra' WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db,$query);
            exit("update_working_hours");
        }else{
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra,is_closed,status)
            VALUES ($groomer_id,$day_id,'$from_monday_day','$until_monday_day',
                    '$from_monday_day_extra','$until_monday_day_extra',1,'closed')";

            $result = mysqli_query($db,$query);
            exit("insert_working_hours");
        }

    }

}

################################################################################################
####################### Save Closed Tuesday Working Hours #######################################

if(isset($_POST['closed_tuesday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_tuesday_day = $db->real_escape_string($_POST['from_tuesday_day']);
    $until_tuesday_day = $db->real_escape_string($_POST['until_tuesday_day']);
    $from_tuesday_day_extra = $db->real_escape_string($_POST['from_tuesday_day_extra']);
    $until_tuesday_day_extra = $db->real_escape_string($_POST['until_tuesday_day_extra']);

    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db,$query_groomer);

    if($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour= mysqli_query($db,$query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id,is_closed=1,status='closed',
                        from_hour='$from_tuesday_day', until_hour='$until_tuesday_day', from_hour_extra='$from_tuesday_day_extra', 
                        until_hour_extra='$until_tuesday_day_extra' WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db,$query);
            exit("update_working_hours");
        }else{
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra, is_closed, status)
            VALUES ($groomer_id,$day_id,'$from_tuesday_day','$until_tuesday_day',
                    '$from_tuesday_day_extra','$until_tuesday_day_extra',1, 'closed')";

            $result = mysqli_query($db,$query);
            exit("insert_working_hours");
        }

    }

}

################################################################################################
####################### Save Closed Wednesday Working Hours ####################################

if(isset($_POST['closed_wednesday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_wednesday_day = $db->real_escape_string($_POST['from_wednesday_day']);
    $until_wednesday_day = $db->real_escape_string($_POST['until_wednesday_day']);
    $from_wednesday_day_extra = $db->real_escape_string($_POST['from_wednesday_day_extra']);
    $until_wednesday_day_extra = $db->real_escape_string($_POST['until_wednesday_day_extra']);

    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db,$query_groomer);

    if($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour= mysqli_query($db,$query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id,is_closed=1,
                        from_hour='$from_wednesday_day', until_hour='$until_wednesday_day', from_hour_extra='$from_wednesday_day_extra', 
                        until_hour_extra='$until_wednesday_day_extra', status='closed'
                        WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db,$query);
            exit("update_working_hours");
        }else{
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra, is_closed, status)
            VALUES ($groomer_id,$day_id,'$from_wednesday_day','$until_wednesday_day',
                    '$from_wednesday_day_extra','$until_wednesday_day_extra',1, 'closed')";

            $result = mysqli_query($db,$query);
            exit("insert_working_hours");
        }

    }

}

################################################################################################
####################### Save Closed Thursday Working Hours #####################################

if(isset($_POST['closed_thursday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_thursday_day = $db->real_escape_string($_POST['from_thursday_day']);
    $until_thursday_day = $db->real_escape_string($_POST['until_thursday_day']);
    $from_thursday_day_extra = $db->real_escape_string($_POST['from_thursday_day_extra']);
    $until_thursday_day_extra = $db->real_escape_string($_POST['until_thursday_day_extra']);

    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db,$query_groomer);

    if($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour= mysqli_query($db,$query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id,is_closed=1,status='closed',
                        from_hour='$from_thursday_day', until_hour='$until_thursday_day', from_hour_extra='$from_thursday_day_extra', 
                        until_hour_extra='$until_thursday_day_extra' WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db,$query);
            exit("update_working_hours");
        }else{
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra, is_closed, status)
            VALUES ($groomer_id,$day_id,'$from_thursday_day','$until_thursday_day',
                    '$from_thursday_day_extra','$until_thursday_day_extra',1,'closed')";

            $result = mysqli_query($db,$query);
            exit("insert_working_hours");
        }

    }

}

################################################################################################
####################### Save Closed Friday Working Hours #######################################

if(isset($_POST['closed_friday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_friday_day = $db->real_escape_string($_POST['from_friday_day']);
    $until_friday_day = $db->real_escape_string($_POST['until_friday_day']);
    $from_friday_day_extra = $db->real_escape_string($_POST['from_friday_day_extra']);
    $until_friday_day_extra = $db->real_escape_string($_POST['until_friday_day_extra']);

    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db,$query_groomer);

    if($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour= mysqli_query($db,$query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id,is_closed=1,status='closed',
                        from_hour='$from_friday_day', until_hour='$until_friday_day', from_hour_extra='$from_friday_day_extra', 
                        until_hour_extra='$until_friday_day_extra' WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db,$query);
            exit("update_working_hours");
        }else{
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra, is_closed, status)
            VALUES ($groomer_id,$day_id,'$from_friday_day','$until_friday_day',
                    '$from_friday_day_extra','$until_friday_day_extra',1,'closed')";

            $result = mysqli_query($db,$query);
            exit("insert_working_hours");
        }

    }

}

################################################################################################
####################### Save Closed Saturday Working Hours #####################################

if(isset($_POST['closed_saturday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_saturday_day = $db->real_escape_string($_POST['from_saturday_day']);
    $until_saturday_day = $db->real_escape_string($_POST['until_saturday_day']);
    $from_saturday_day_extra = $db->real_escape_string($_POST['from_saturday_day_extra']);
    $until_saturday_day_extra = $db->real_escape_string($_POST['until_saturday_day_extra']);

    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db,$query_groomer);

    if($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour= mysqli_query($db,$query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id,is_closed=1,status='closed',
                        from_hour='$from_saturday_day', until_hour='$until_saturday_day', from_hour_extra='$from_saturday_day_extra', 
                        until_hour_extra='$until_saturday_day_extra' WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db,$query);
            exit("update_working_hours");
        }else{
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra, is_closed, status)
            VALUES ($groomer_id,$day_id,'$from_saturday_day','$until_saturday_day',
                    '$from_saturday_day_extra','$until_saturday_day_extra',1,'closed')";

            $result = mysqli_query($db,$query);
            exit("insert_working_hours");
        }

    }

}

################################################################################################
####################### Save Closed Sunday Working Hours ######################################

if(isset($_POST['closed_sunday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_sunday_day = $db->real_escape_string($_POST['from_sunday_day']);
    $until_sunday_day = $db->real_escape_string($_POST['until_sunday_day']);
    $from_sunday_day_extra = $db->real_escape_string($_POST['from_sunday_day_extra']);
    $until_sunday_day_extra = $db->real_escape_string($_POST['until_sunday_day_extra']);

    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db,$query_groomer);

    if($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour= mysqli_query($db,$query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id, is_closed=1,status='closed',
                        from_hour='$from_sunday_day', until_hour='$until_sunday_day', from_hour_extra='$from_sunday_day_extra', 
                        until_hour_extra='$until_sunday_day_extra' WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db,$query);
            exit("update_working_hours");
        }else{
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra, is_closed, status)
            VALUES ($groomer_id,$day_id,'$from_sunday_day','$until_sunday_day',
                    '$from_sunday_day_extra','$until_sunday_day_extra',1, 'closed')";

            $result = mysqli_query($db,$query);
            exit("insert_working_hours");
        }

    }

}

################################################################################################
####################### Save Opened Monday Working Hours #######################################
if(isset($_POST['opened_monday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_monday_day = $db->real_escape_string($_POST['from_monday_day']);
    $until_monday_day = $db->real_escape_string($_POST['until_monday_day']);
    $from_monday_day_extra = $db->real_escape_string($_POST['from_monday_day_extra']);
    $until_monday_day_extra = $db->real_escape_string($_POST['until_monday_day_extra']);


    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db, $query_groomer);

    if ($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour = mysqli_query($db, $query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if ($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id,is_closed=0,
                        from_hour='$from_monday_day', until_hour='$until_monday_day', from_hour_extra='$from_monday_day_extra', 
                        until_hour_extra='$until_monday_day_extra' WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_monday_day && $date<$until_monday_day) || ($date>$from_monday_day_extra && $date<$until_monday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }
            }

        } else {
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra, is_closed)
            VALUES ($groomer_id,$day_id,'$from_monday_day','$until_monday_day',
                    '$from_monday_day_extra','$until_monday_day_extra',0)";

            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_monday_day && $date<$until_monday_day) || ($date>$from_monday_day_extra && $date<$until_monday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }
            }
        }

    }
}

################################################################################################
####################### Save Opened Tuesday Working Hours ######################################

if(isset($_POST['opened_tuesday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_tuesday_day = $db->real_escape_string($_POST['from_tuesday_day']);
    $until_tuesday_day = $db->real_escape_string($_POST['until_tuesday_day']);
    $from_tuesday_day_extra = $db->real_escape_string($_POST['from_tuesday_day_extra']);
    $until_tuesday_day_extra = $db->real_escape_string($_POST['until_tuesday_day_extra']);


    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db, $query_groomer);

    if ($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour = mysqli_query($db, $query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if ($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id,is_closed=0,
                        from_hour='$from_tuesday_day', until_hour='$until_tuesday_day', from_hour_extra='$from_tuesday_day_extra', 
                        until_hour_extra='$until_tuesday_day_extra' WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_tuesday_day && $date<$until_tuesday_day) || ($date>$from_tuesday_day_extra && $date<$until_tuesday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }
            }

        } else {
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra, is_closed)
            VALUES ($groomer_id,$day_id,'$from_tuesday_day','$until_tuesday_day',
                    '$from_tuesday_day_extra','$until_tuesday_day_extra',0)";

            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_tuesday_day && $date<$until_tuesday_day) || ($date>$from_tuesday_day_extra && $date<$until_tuesday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }
            }
        }

    }
}

################################################################################################
####################### Save Opened Wednesday Working Hours ####################################

if(isset($_POST['opened_wednesday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_wednesday_day = $db->real_escape_string($_POST['from_wednesday_day']);
    $until_wednesday_day = $db->real_escape_string($_POST['until_wednesday_day']);
    $from_wednesday_day_extra = $db->real_escape_string($_POST['from_wednesday_day_extra']);
    $until_wednesday_day_extra = $db->real_escape_string($_POST['until_wednesday_day_extra']);


    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db, $query_groomer);

    if ($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour = mysqli_query($db, $query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if ($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id,is_closed=0,
                        from_hour='$from_wednesday_day', until_hour='$until_wednesday_day', from_hour_extra='$from_wednesday_day_extra', 
                        until_hour_extra='$until_wednesday_day_extra' WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_wednesday_day && $date<$until_wednesday_day) || ($date>$from_wednesday_day_extra && $date<$until_wednesday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }
            }


        } else {
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra, is_closed)
            VALUES ($groomer_id,$day_id,'$from_wednesday_day','$until_wednesday_day',
                    '$from_wednesday_day_extra','$until_wednesday_day_extra',0)";
            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_wednesday_day && $date<$until_wednesday_day) || ($date>$from_wednesday_day_extra && $date<$until_wednesday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }
            }

        }

    }
}

################################################################################################
####################### Save Opened Thursday Working Hours ####################################

if(isset($_POST['opened_thursday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_thursday_day = $db->real_escape_string($_POST['from_thursday_day']);
    $until_thursday_day = $db->real_escape_string($_POST['until_thursday_day']);
    $from_thursday_day_extra = $db->real_escape_string($_POST['from_thursday_day_extra']);
    $until_thursday_day_extra = $db->real_escape_string($_POST['until_thursday_day_extra']);


    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db, $query_groomer);

    if ($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour = mysqli_query($db, $query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if ($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id,is_closed=0,
                        from_hour='$from_thursday_day', until_hour='$until_thursday_day', from_hour_extra='$from_thursday_day_extra', 
                        until_hour_extra='$until_thursday_day_extra' WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_thursday_day && $date<$until_thursday_day) || ($date>$from_thursday_day_extra && $date<$until_thursday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }
            }

        } else {
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra, is_closed)
            VALUES ($groomer_id,$day_id,'$from_thursday_day','$until_thursday_day',
                    '$from_thursday_day_extra','$until_thursday_day_extra',0)";

            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_thursday_day && $date<$until_thursday_day) || ($date>$from_thursday_day_extra && $date<$until_thursday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }
            }

        }

    }
}

################################################################################################
####################### Save Opened Friday Working Hours ######################################

if(isset($_POST['opened_friday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_friday_day = $db->real_escape_string($_POST['from_friday_day']);
    $until_friday_day = $db->real_escape_string($_POST['until_friday_day']);
    $from_friday_day_extra = $db->real_escape_string($_POST['from_friday_day_extra']);
    $until_friday_day_extra = $db->real_escape_string($_POST['until_friday_day_extra']);


    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db, $query_groomer);

    if ($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour = mysqli_query($db, $query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if ($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id,is_closed=0,
                        from_hour='$from_friday_day', until_hour='$until_friday_day', from_hour_extra='$from_friday_day_extra', 
                        until_hour_extra='$until_friday_day_extra' WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_friday_day && $date<$until_friday_day) || ($date>$from_friday_day_extra && $date<$until_friday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }
            }

        } else {
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra, is_closed)
            VALUES ($groomer_id,$day_id,'$from_friday_day','$until_friday_day',
                    '$from_friday_day_extra','$until_friday_day_extra',0)";

            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_friday_day && $date<$until_friday_day) || ($date>$from_friday_day_extra && $date<$until_friday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }
            }

        }

    }
}

################################################################################################
####################### Save Opened Saturday Working Hours #####################################

if(isset($_POST['opened_saturday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_saturday_day = $db->real_escape_string($_POST['from_saturday_day']);
    $until_saturday_day = $db->real_escape_string($_POST['until_saturday_day']);
    $from_saturday_day_extra = $db->real_escape_string($_POST['from_saturday_day_extra']);
    $until_saturday_day_extra = $db->real_escape_string($_POST['until_saturday_day_extra']);


    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db, $query_groomer);

    if ($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour = mysqli_query($db, $query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if ($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id,is_closed=0,
                        from_hour='$from_saturday_day', until_hour='$until_saturday_day', from_hour_extra='$from_saturday_day_extra', 
                        until_hour_extra='$until_saturday_day_extra' WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_saturday_day && $date<$until_saturday_day) || ($date>$from_saturday_day_extra && $date<$until_saturday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }
            }

        } else {
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra, is_closed)
            VALUES ($groomer_id,$day_id,'$from_saturday_day','$until_saturday_day',
                    '$from_saturday_day_extra','$until_saturday_day_extra',0)";

            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_saturday_day && $date<$until_saturday_day) || ($date>$from_saturday_day_extra && $date<$until_saturday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }
            }

        }

    }
}

################################################################################################
####################### Save Opened Sunday Working Hours #######################################

if(isset($_POST['opened_sunday_hours'])) {

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $day_id = $db->real_escape_string($_POST['day_id']);
    $from_sunday_day = $db->real_escape_string($_POST['from_sunday_day']);
    $until_sunday_day = $db->real_escape_string($_POST['until_sunday_day']);
    $from_sunday_day_extra = $db->real_escape_string($_POST['from_sunday_day_extra']);
    $until_sunday_day_extra = $db->real_escape_string($_POST['until_sunday_day_extra']);


    $query_groomer = "SELECT id FROM groomer WHERE email='$groomer_email'";
    $result_groomer = mysqli_query($db, $query_groomer);

    if ($result_groomer->num_rows > 0) {

        $groomer_row = mysqli_fetch_array($result_groomer);

        $groomer_id = $groomer_row['id'];

        // Check If has hour with this groomer
        $query_hour = "SELECT * FROM groomer_working_hours WHERE groomer_id='$groomer_id' AND day_id=$day_id";
        $result_hour = mysqli_query($db, $query_hour);

        // If this groomer has set open hour, then update this hour
        // We dont want duplicated hours
        if ($result_hour->num_rows > 0) {
            $query = "UPDATE groomer_working_hours SET day_id=$day_id,is_closed=0,
                        from_hour='$from_sunday_day', until_hour='$until_sunday_day', from_hour_extra='$from_sunday_day_extra', 
                        until_hour_extra='$until_sunday_day_extra' WHERE groomer_id=$groomer_id AND day_id=$day_id";

            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_sunday_day && $date<$until_sunday_day) || ($date>$from_sunday_day_extra && $date<$until_sunday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("update_working_hours");
                }
            }

        } else {
            // If this groomer has not set open hour, then insert this hour
            // We dont want duplicated hours
            $query = "INSERT INTO groomer_working_hours (groomer_id, day_id, from_hour, until_hour, from_hour_extra, until_hour_extra, is_closed)
            VALUES ($groomer_id,$day_id,'$from_sunday_day','$until_sunday_day',
                    '$from_sunday_day_extra','$until_sunday_day_extra',0)";

            $result = mysqli_query($db, $query);
            if($result){
                date_default_timezone_set("Europe/Athens");
                $date = date('H:i');
                if(($date>$from_sunday_day && $date<$until_sunday_day) || ($date>$from_sunday_day_extra && $date<$until_sunday_day_extra) ){
                    $update_query = "UPDATE groomer_working_hours SET status='open' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }else{
                    $update_query = "UPDATE groomer_working_hours SET status='closed' WHERE groomer_id=$groomer_id AND day_id=$day_id";
                    $update_result = mysqli_query($db, $update_query);
                    exit("insert_working_hours");
                }
            }
        }

    }
}

################################################################################################
################## Autoload Working Hours In Groomer Dashboard #################################

if(isset($_POST['autoload_working_hours_monday_from_ajax'])) {

    $email = $db->real_escape_string($_POST['email']);
    $day_id = $db->real_escape_string($_POST['day_id']);


    $query = "SELECT groomer_id,day_id,from_hour,until_hour,from_hour_extra,until_hour_extra,email
              FROM groomer_working_hours,groomer WHERE groomer.id=groomer_working_hours.groomer_id AND day_id=$day_id AND email='$email'";


    $result = mysqli_query($db,$query);

    $return_arr = array();

    while($row = mysqli_fetch_array($result)){

        $from_hour = $row['from_hour'];
        $until_hour = $row['until_hour'];
        $from_hour_extra = $row['from_hour_extra'];
        $until_hour_extra = $row['until_hour_extra'];

        $return_arr[] = array("from_hour" => $from_hour ,"until_hour"=> $until_hour, "from_hour_extra" => $from_hour_extra, "until_hour_extra" => $until_hour_extra);
    }

        exit(json_encode($return_arr));

}

################################################################################################
######################### Check Groomer Store Notification #####################################

if(isset($_POST['check_groomer_store_situation'])) {

    $groomer_id = $db->real_escape_string($_POST['groomer_id']);
    $current_date = $db->real_escape_string($_POST['current_date']);

    $query = "SELECT groomer_working_hours.groomer_id,groomer_working_hours.day_id,
                     groomer_working_hours.from_hour,groomer_working_hours.until_hour,
                     groomer_working_hours.from_hour_extra,groomer_working_hours.until_hour_extra,
                     groomer_working_hours.is_closed,
                     groomer_working_days.name_engl 
                     FROM groomer_working_hours,groomer_working_days 
                     WHERE groomer_working_hours.day_id=groomer_working_days.id 
                     AND groomer_working_hours.groomer_id='$groomer_id' 
                     AND groomer_working_days.name_engl='$current_date'";

    $result = mysqli_query($db,$query);

    $return_arr = array();

    while($row = mysqli_fetch_array($result)){

        $from_hour = $row['from_hour'];
        $until_hour = $row['until_hour'];
        $from_hour_extra = $row['from_hour_extra'];
        $until_hour_extra = $row['until_hour_extra'];
        $is_closed = $row['is_closed'];

        $return_arr[] = array("from_hour" => $from_hour ,"until_hour"=> $until_hour, "from_hour_extra" => $from_hour_extra,
            "until_hour_extra" => $until_hour_extra, "is_closed" => $is_closed);
    }

    exit(json_encode($return_arr));

}

################################################################################################
######################### Manual Entry Appointment #####################################


if(isset($_POST['manual_entry_appointment'])) {

    $groomer_id = $db->real_escape_string($_POST['groomer_id']);
    $appointment_date = $db->real_escape_string($_POST['appointment_date']);
    $appointment_time = $db->real_escape_string($_POST['appointment_time']);
    $modal_email = $db->real_escape_string($_POST['modal_email']);
    $modal_name = $db->real_escape_string($_POST['modal_name']);
    $modal_surname = $db->real_escape_string($_POST['modal_surname']);
    $modal_phone = $db->real_escape_string($_POST['modal_phone']);

    $query_check_appointments = "SELECT * FROM appointments WHERE appointment_date = '$appointment_date' AND appointment_time ='$appointment_time' 
                             AND ( booked=1 OR in_process=1) AND is_expired=0 AND groomer_id=$groomer_id";
    $result_check_appointments = mysqli_query($db,$query_check_appointments);

    if ($result_check_appointments->num_rows > 0) {
        exit("mi_diathesimo_rantevou");
    }else{

        $query_check_customer = "SELECT * FROM customer WHERE email='$modal_email'";
        $result_check_customer = mysqli_query($db,$query_check_customer);

        if($result_check_customer->num_rows > 0){
            while($row = mysqli_fetch_array($result_check_customer)){
                $is_user = $row['is_user'];
                $user_id = $row['user_id'];
            }
            $query_insert_customer = "INSERT INTO customer (email, name, surname, phone ,appointment_date, appointment_time, is_user, user_id)
                 VALUES ('$modal_email','$modal_name','$modal_surname','$modal_phone','$appointment_date','$appointment_time',$is_user,$user_id)";
            $result_insert_customer = mysqli_query($db,$query_insert_customer);

            if($result_insert_customer){
                $query_check_customer = "SELECT * FROM customer WHERE email='$modal_email' AND appointment_date='$appointment_date' 
                         AND appointment_time='$appointment_time'";
                $result_check_customer = mysqli_query($db, $query_check_customer);

                while ($row = mysqli_fetch_array($result_check_customer)) {
                    $customer_id = $row['id'];
                }

                $query_insert_appoint = "INSERT INTO appointments (customer_id, groomer_id,appointment_date, appointment_time, booked, in_process)
                                       VALUES ('$customer_id',$groomer_id,'$appointment_date','$appointment_time',0,1)";
                $result_insert_appoint = mysqli_query($db, $query_insert_appoint);

                if($result_insert_appoint){
                    exit("success_appoint_customer");
                }
            }

        }else{

            //Συνάρτηση για δημιουργία τυχαίου κωδικού πρόσβασης
            function password_generate($chars)
            {
                $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
                return substr(str_shuffle($data), 0, $chars);
            }

            $password =  password_generate(16);
            $new_user_password = password_hash($password, PASSWORD_BCRYPT);

            $query_new_user = "INSERT INTO user (email,name,surname,phone, password, verified, is_customer)
                               VALUES ('$modal_email','$modal_name','$modal_surname','$modal_phone', '$new_user_password',1,1)";

            $result_new_user = mysqli_query($db,$query_new_user);

            if($result_new_user){

                $query_check_user = "SELECT * FROM user WHERE email='$modal_email'";
                $result_check_user = mysqli_query($db,$query_check_user);

                while ($row = mysqli_fetch_array($result_check_user)) {
                    $user_id = $row['id'];
                }
                $query_insert_new_customer = "INSERT INTO customer (email, name, surname, phone ,appointment_date, appointment_time, is_user, user_id)
                 VALUES ('$modal_email','$modal_name','$modal_surname','$modal_phone','$appointment_date','$appointment_time',1, $user_id)";
                $result_insert_new_customer = mysqli_query($db,$query_insert_new_customer);

                if($result_insert_new_customer){
                    $query_check_customer = "SELECT * FROM customer WHERE email='$modal_email' AND appointment_date='$appointment_date'
                         AND appointment_time='$appointment_time'";
                    $result_check_customer = mysqli_query($db, $query_check_customer);

                    while ($row = mysqli_fetch_array($result_check_customer)) {
                        $customer_id = $row['id'];
                    }

                    $query_insert_appoint = "INSERT INTO appointments (customer_id, groomer_id,appointment_date, appointment_time, booked, in_process)
                                       VALUES ('$customer_id',$groomer_id,'$appointment_date','$appointment_time',0,1)";
                    $result_insert_appoint = mysqli_query($db, $query_insert_appoint);

                    if($result_insert_appoint){
                        exit("success_appoint_new_customer");
                    }

                }

            }

        }

    }
}

//Αποστολή Email στον πελάτη για την καταχώρηση του ραντεβού

if(isset($_POST['success_appoint_customer_send_email'])) {

    $appointment_date = $db->real_escape_string($_POST['appointment_date']);
    $appointment_time = $db->real_escape_string($_POST['appointment_time']);
    $modal_email = $db->real_escape_string($_POST['modal_email']);
    $modal_surname = $db->real_escape_string($_POST['modal_surname']);

    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 1;
    $mail->SMTPAuth = true;
    $mail->Host       = $_ENV["EMAIL_HOST"];
    $mail->Username   = $_ENV["EMAIL_NAME"];
    $mail->Password   = $_ENV["EMAIL_PASS"];
    $mail->SMTPSecure = $_ENV["EMAIL_SECURITY"];
    $mail->Port       = $_ENV["EMAIL_PORT"];

    $mail->addAddress($modal_email);
    $mail->setFrom( $mail->Username);

    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Ενημέρωση για το ραντεβού στις ' . $appointment_date . ' και ώρα ' . $appointment_time;
    $mail->Body    = "Γεια σας κος/κα $modal_surname . <br> Θα θέλαμε να σας ενημερώσουμε πως το ραντεβού σας στις $appointment_date και ώρα $appointment_time
                          έγινε αποδεκτό.<br>Σας περιμένουμε!";

    if($mail->send()) {
        echo "Email sending successfully...";
    } else {
        echo "Email sending failed...";
    }

}

//Αποστολή Email στον πελάτη για την καταχώρηση του ραντεβού

if(isset($_POST['success_appoint_new_customer_send_email'])) {

    $appointment_date = $db->real_escape_string($_POST['appointment_date']);
    $appointment_time = $db->real_escape_string($_POST['appointment_time']);
    $modal_email = $db->real_escape_string($_POST['modal_email']);
    $modal_surname = $db->real_escape_string($_POST['modal_surname']);

    $token = uniqid(md5(time()));
    $query = "INSERT INTO reset_password(email,token) VALUES ('$modal_email','$token')";
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

        $mail->addAddress($modal_email);
        $mail->setFrom( $mail->Username);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $url = "<a href='https://groomedoo.eu/user/user_reset_password.php?token=$token'>σύνδεσμο</a>";
        $url_app = "<a href='https://groomedoo.eu/'>https://groomedoo.eu/</a>";

        $mail->Subject = 'Ενημέρωση για το ραντεβού στις ' . $appointment_date . ' και ώρα ' . $appointment_time;
        $mail->Body    = "Γεια σας κος/κα $modal_surname . <br> Θα θέλαμε να σας ενημερώσουμε πως το ραντεβού σας στις $appointment_date και ώρα $appointment_time
                          έγινε αποδεκτό.<br>Σας περιμένουμε!<br><br><br>
                          Πήραμε την πρωτοβουλία να σας δημιουργήσουμε λογαριασμό στην διαδικτυακή μας πλατφόρμα
                          $url_app ώστε το επόμενο ραντεβού σας να το κλείσετε ξεκούραστα μέσα από την εφαρμογή μας.<br>
                          Πατήστε τον $url ώστε να ορίστετε καινούργιο κωδικό πρόσβασης.<br>
                          Το email σύνδεσης είναι το $modal_email.";

        if($mail->send()) {
            echo "Email sending successfully...";
        } else {
            echo "Email sending failed...";
        }
    }

}

################################################################################################
######################### Disable Appointment #####################################

if(isset($_POST['disable_appointment'])) {

    $date = $db->real_escape_string($_POST['date']);
    $groomer_id = $db->real_escape_string($_POST['groomer_id']);

    $query = "SELECT * FROM appointments WHERE appointment_date='$date' AND groomer_id='$groomer_id'
                                  AND ( booked=true OR in_process=true OR completed=true)";
    $result = mysqli_query($db, $query);

    $return_arr = array();

    while($row = mysqli_fetch_array($result)){

        $appointment_time = $row['appointment_time'];

        $return_arr[] = array("appointment_time"=> $appointment_time);
    }

    exit(json_encode($return_arr));
}

if(isset($_POST['accept_appointment'])) {

    $appointment_id = $db->real_escape_string($_POST['appointment_id']);
    $appointment_date = $db->real_escape_string($_POST['appointment_date']);
    $appointment_time = $db->real_escape_string($_POST['appointment_time']);
    $email = $db->real_escape_string($_POST['email']);
    $surname = $db->real_escape_string($_POST['surname']);
    $phone = $db->real_escape_string($_POST['phone']);

    $query = "UPDATE appointments SET booked = false, in_process = true WHERE id=$appointment_id;";
    $result = mysqli_query($db, $query);
    if($result){
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->Host       = $_ENV["EMAIL_HOST"];
        $mail->Username   = $_ENV["EMAIL_NAME"];
        $mail->Password   = $_ENV["EMAIL_PASS"];
        $mail->SMTPSecure = $_ENV["EMAIL_SECURITY"];
        $mail->Port       = $_ENV["EMAIL_PORT"];

        $mail->addAddress($email);
        $mail->setFrom( $mail->Username);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Ενημέρωση για το ραντεβού στις ' . $appointment_date . ' και ώρα ' . $appointment_time;
        $mail->Body    = "Γεια σας κος/κα $surname . <br> Θα θέλαμε να σας ενημερώσουμε πως το ραντεβού σας στις $appointment_date και ώρα $appointment_time
                          έγινε αποδεκτό.<br>Σας περιμένουμε!";

        if($mail->send()) {
            echo "Email sending successfully...";
        } else {
            echo "Email sending failed...";
        }
        exit('appointment_accepted');
    }else{
        exit('error_in_appointment_accepted');
    }

}

if(isset($_POST['decline_appointment'])) {
    $appointment_id = $db->real_escape_string($_POST['appointment_id']);
    $appointment_date = $db->real_escape_string($_POST['appointment_date']);
    $appointment_time = $db->real_escape_string($_POST['appointment_time']);
    $email = $db->real_escape_string($_POST['email']);
    $surname = $db->real_escape_string($_POST['surname']);
    $phone = $db->real_escape_string($_POST['phone']);
    $query = "UPDATE appointments SET booked = false, canceled = true WHERE id=$appointment_id;";
    $result = mysqli_query($db, $query);

    if($result){
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->Host       = $_ENV["EMAIL_HOST"];
        $mail->Username   = $_ENV["EMAIL_NAME"];
        $mail->Password   = $_ENV["EMAIL_PASS"];
        $mail->SMTPSecure = $_ENV["EMAIL_SECURITY"];
        $mail->Port       = $_ENV["EMAIL_PORT"];

        $mail->addAddress($email);
        $mail->setFrom( $mail->Username);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Ενημέρωση για το ραντεβού στις ' . $appointment_date . ' και ώρα ' . $appointment_time;
        $mail->Body    = "Γεια σας κος/κα $surname . <br> Θα θέλαμε να σας ενημερώσουμε πως το ραντεβού σας στις $appointment_date και ώρα $appointment_time
                          απορρίφθηκε. Παρακαλώ προσπαθήστε ξανά";

        if($mail->send()) {
            echo "Email sending successfully...";
        } else {
            echo "Email sending failed...";
        }
        exit('appointment_declined');
    }else{
        exit('error_in_appointment_declined');
    }
}

#########################################################################################################
############################## Groomer Appointment Page Modal ###########################################################
if(isset($_POST['groomer_appointment_modal_from_ajax'])) {
    $id = $db->real_escape_string($_POST['id']);

    $select_appointments_customer = "SELECT * FROM customer,appointments WHERE appointments.customer_id = customer.id 
                                      AND appointments.id=$id";
    $select_appointments_customer_result = mysqli_query($db,$select_appointments_customer);

    $return_arr = array();

    while($row = mysqli_fetch_array($select_appointments_customer_result)) {
        $email = $row['email'];
        $name = $row['name'];
        $surname = $row['surname'];
        $phone = $row['phone'];
        $appointment_date = $row['appointment_date'];
        $appointment_time = $row['appointment_time'];
        $booked = $row['booked'];

        $return_arr[] = array("email"=> $email, "name"=>$name, "surname"=>$surname, "phone"=>$phone,
                              "appointment_date"=>$appointment_date,"appointment_time"=>$appointment_time,
                              "booked" => $booked);
    }

    exit(json_encode($return_arr));

}
#########################################################################################################
############################## Groomer Log In ###########################################################

session_start();
if(isset($_SESSION['groomerLoggedIN']) && $_SESSION['groomer_remember_me']){
    header('Location: groomer_dashboard/groomer_dashboard.php');
    exit();
}

if(isset($_POST['groomer_login_from_ajax'])){

    $groomer_email = $db->real_escape_string($_POST['groomer_email']);
    $groomer_password = $db->real_escape_string($_POST['groomer_password']);
    $groomer_remember_me = isset($_POST['groomer_remember_me']);

    $query = "SELECT * FROM groomer WHERE email='$groomer_email' ";
    $result = mysqli_query($db,$query);

    if($result->num_rows > 0){

        $row = mysqli_fetch_array($result);
        $verified = $row['verified'];

        if(password_verify($groomer_password, $row['password'])){

            if($verified == false){
                exit("not_verified");
            }else{

                if (!empty($_POST['groomer_remember_me'])) {
                    setcookie("email",$groomer_email, time() + (10*365*24*60*60));
                }else{
                    if (isset($_COOKIE["email"])) {
                        setcookie("email","");
                    }
                }

                $_SESSION['groomerLoggedIN'] = '1';
                $_SESSION['email'] = $groomer_email;
                $_SESSION['groomer_remember_me'] = $groomer_remember_me;
                exit("success");

            }

        }else{
            exit("error");
        }

    }else{
        exit("error_login");
    }


}
?>
