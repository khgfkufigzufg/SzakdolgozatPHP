<?php
//---------------BEJELENTKEZÉS-----------------
$login = TRUE;
if(isset($_POST['email']) and isset($_POST['jelszo'])){
    $login = FALSE;
    $sql = "SELECT * FROM user WHERE email='".$_POST['email']."'";
    $sql .= " AND jelszo = '".md5($_POST['jelszo'])."'";
    
    if($result = $Db->execSQL($sql)){ //Megnézzük, hogy volt-e ilyen felhasználó
        if($row = $result->fetch_assoc()){
            $login = TRUE;
            $_SESSION["user"] = $row;
            
            if($_POST['suti']){ //A felhasználó döntése alapján COOKIE mentése
                $cookie_name = "user";
                $cookie_value = $row['email'];
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            }
            header('Location:index.php');
            exit;
        }
    }
}
require 'view/belep.php';
?>