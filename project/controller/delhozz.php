<?php
//---------------getbe felvitt hozzávaló törlése(Admin étel hozzávaló felület hoz ide)-----------------
if(!empty($_REQUEST['delID'])){
    $kiHOZZ->delHozzavalo($Db, $_REQUEST['delID']);
}
header('Location:index.php?action=hozza');
exit;
?>