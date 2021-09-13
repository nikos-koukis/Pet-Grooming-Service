<nav class="nav-bar">
    <a href="https://groomedoo.eu/" ><img src="../../navbar/assets/images/main_logo.png" id="main_logo"></a>
    <?php
    if(isset($_SESSION['userLoggedIN'])){
        ?>
        <p id="welcome_user"><a>Γεια σου, <?php echo $user_name; ?></a></p>
        <img src="../../../user/assets/images/settings_img.png" id="img_settings_gear" data-toggle="dropdown" >
        <div class="dropdown-menu">
            <div>
                <a href="../user/user_profile.php" id="icon_profile"> Το προφίλ μου</a>
            </div>
            <div>
                <a href="../user/user_appointment.php"> Τα ραντεβού μου</a>
            </div>
            <div>
                <a id="link_user_logout" href="#">Αποσύνδεση</a>
            </div>
        </div>
        <?php
    }else{
        ?>
        <p id="not_login_info">
            <a id="login_link" href="#">Σύνδεση</a> |
            <a href="#" id="register_link">Εγγραφή</a>
        </p>
        <?php
    }
    ?>
</nav>