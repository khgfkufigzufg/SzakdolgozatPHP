<?php
//---------------KIJELENTKEZÉS-----------------
$cookie_name = "user";
setcookie($cookie_name, '', time() - (86400 * 30), "/");
unset($_SESSION["user"]);
unset($_SESSION["ideigEtlap"]);
unset($_SESSION["dbtetel"]);

header('Location:index.php');
exit;
?>