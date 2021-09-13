<?php

session_start();


if(!isset($_SESSION['groomerLoggedIN'])){
    header('Location: ../index.php');
    exit();
}

?>
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">-->
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->

<!-- SIDEBAR -->

<div class="sidebar">
    <div class="sidebar-logo">
        <a href="https://groomedoo.eu/groomer/groomer_dashboard/groomer_dashboard.php">
            <i class='bx bxl-baidu'></i>
            <p>Grooming Space</p>
        </a>
        <div class="sidebar-close" id="sidebar-close">
            <i class='bx bx-left-arrow-alt'></i>
        </div>
    </div>
    <div class="profile_content">
        <div class="profile">
            <div class="profile_details">
                <div class="name_groomer">
                    <div class="name">Καλώς Όρισες</div>
                    <div class="groomer" id="groomer"><?echo $_SESSION['email']; ?></div>

                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-outline" id="btn_logout">
        <i class='bx bx-power-off'></i>
    </button>
    <!-- SIDEBAR MENU -->
    <ul class="sidebar-menu" id="sidebar-menu">
        <li>
            <a href="groomer_dashboard.php">
                <i class='bx bxs-dashboard'></i>
                <span>Πίνακας Ελέγχου</span>
            </a>
        </li>
        <li>
            <a href="groomer_profile.php">
                <i class='bx bx-user-circle'></i>
                <span>Το προφιλ μου</span>
            </a>
        </li>

        <li>
            <a href="groomer_appointment_page.php">
                <i class='bx bx-calendar'></i>
                <span>Ραντεβού</span>
            </a>
        </li>

        <li>
            <a href="groomer_appointments_history.php">
                <i class='bx bx-clipboard'></i>
                <span>Ιστορικό</span>
            </a>
        </li>

        <li class="sidebar-submenu">
            <a href="#" class="sidebar-menu-dropdown">
                <i class='bx bx-time-five'></i>
                <span>Ωράριο</span>
                <div class="dropdown-icon"></div>
            </a>
            <ul class="sidebar-menu sidebar-menu-dropdown-content" id="dropdown_menu">
                <li>
                    <a href="groomer_working_hours.php">
                        Ωράριο Λειτουργίας
                    </a>
                </li>
                <li>
                    <a href="groomer_appointments.php">
                        Κλείσε Ραντεβού
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->

</div>
<!-- END SIDEBAR -->

<div class="overlay"></div>