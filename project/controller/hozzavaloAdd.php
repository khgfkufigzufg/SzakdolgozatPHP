<?php
//----------------------Hozzávaló felvét--------------------------
if(isset($_POST['submit'])){
    $ujhozzav = new Hozzavalo();
    if(isset($_POST['allergen'])){
        $allergen = 1;
    }
    else{
        $allergen = 0;
    }
    
    $ujhozzav->setHozzavalo($_POST['megys'], $_POST['hnev'], $allergen);
    $ujhozzav->addHozzavalo($Db);
}
header('Location:index.php?action=hozza');
exit;
?>