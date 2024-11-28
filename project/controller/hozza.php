<?php
//---------------Hozzávalók ételek felület megjelenítése a megfelelő infókkal(melyik étel van kiválasztva)-------------- 
if(isset($_POST['etel'])){
    $kivetel = $kiETEL->getEtel($_POST['etel'], $Db);
}
elseif (isset($_GET['eid'])){
    $kivetel = $kiETEL->getEtel($_GET['eid'], $Db);
}

require 'view/etelek/hozzavalo.php';
?>