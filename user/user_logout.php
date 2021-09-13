<?php


session_start();

unset($_SESSION["userLoggedIN"]);
session_destroy();
setcookie("email","");
header('Location: ../');
exit();

?>