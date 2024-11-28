<?php
//---------------Admin étel hozzávaló felület hoz ide ÉtelHozzávaló kapcsolatlétrehozása + mennyiseg mod-----------------
if(isset($_GET['eid']) && isset($_GET['hid'])){ //kapcsolat hozzáadás
    $eh = new EtelHozzav();
    $eh->setEtelHozzav($_GET['hid'], $_GET['eid'], 0);
    $eh->addEtelHozzav($Db);
    
    header('Location:index.php?action=hozza&eid='.$_GET['eid']);
    exit;
}

if(!empty($_GET["torole"]) && !empty($_GET["torolh"])){ //kapcsolat hozzáadás
    $EtelHozzav->delEtelHozzav($Db, $_GET["torole"], $_GET["torolh"]);
    
    header('Location:index.php?action=hozza&eid='.$_GET['torole']);
    exit;
}
if(!empty($_GET["upde"]) && !empty($_GET["updh"])){ //mennyiseg mod
    
    $mennyi = $_POST["eh".$_GET["updh"].''.$_GET["upde"]];
    
    $EtelHozzav->updateEtelHozzav($_GET["updh"], $_GET["upde"], $mennyi, $Db);
    
    header('Location:index.php?action=hozza&eid='.$_GET['upde']);
    exit;
}


header('Location:index.php?action=hozza');
exit;
?>