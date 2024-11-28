<?php

//-------------------Új user felvétele-----------------------
$reg = TRUE;
if(isset($_POST['email']) && isset($_POST['unev']) && isset($_POST['utca_hsz']) && isset($_POST['jelszo']) && isset($_POST['jelszo2']) && isset($_POST['phone']) && isset($_POST['phone2']) && isset($_POST['felt'])){
    $reg = FALSE;
    $user = new User();
    $mess = "";
    
    if($_POST['jelszo'] == $_POST['jelszo2']){
        $reg = TRUE;
        
    }
    else{
        $mess .= "A két jelszó nem egyezik meg!";
        $reg = FALSE;
    }
    
    if($reg){
        $user->setUser($_POST['unev'], '06'.$_POST['phone'].'-'.$_POST['phone2'], $_POST['uTelep'], $_POST['utca_hsz'], $_POST['email'], $_POST['jelszo']);
        
        if($user->addUser($Db)){
            header('Location:index.php?action=belep&reg='.$user->getUserInfo()['ID']);
            exit;
        }
        else{
            $mess .= "Foglalt e-mail cím!";
            $reg = FALSE;
        }
        
    }
    /*echo'<pre>';
    print_r($user);
    echo'</pre>';*/
}
elseif(isset($_POST)){
    $reg = FALSE;
    $mess = 'A felhasználási feltételek elfogadása kötelező!';
}

require 'view/regist.php';
?>