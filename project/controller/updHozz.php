<?php
//-----------------------Hozzávaló update----------------------------
if(!empty($_REQUEST['updID'])){
    $s = $_REQUEST['updID'];
    $updHozz = new Hozzavalo();
    
    if(isset($_POST['allergen'.$s])){
        $allergen = 1;
    }
    else{
        $allergen = 0;
    }
    
    $updHozz->setHozzavalo($_POST['megys'.$s], $_POST['hnev'.$s], $allergen);
    $updHozz->updHozzavalo($s, $Db);
}
header('Location:index.php?action=hozza');
exit;

?>