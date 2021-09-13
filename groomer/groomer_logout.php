<?php


session_start();

unset($_SESSION["groomerLoggedIN"]);
session_destroy();
setcookie("email","");
header('Location: ./index.php');
exit();




?>