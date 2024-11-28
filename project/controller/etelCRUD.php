<?php
//---------------Admin étel hozzávaló felület hoz ide Étel add, del upd-----------------
if(isset($_POST['etelNev'])){
    $kiETEL->setEtel($_POST['etelNev'], $_POST['tomeg']);
    $kiETEL->addEtel($Db);
}

if(!empty($_GET['delID'])){
    $kiETEL->delEtel($Db, $_GET['delID']);
    if(file_exists('img/info/'.$_GET['delID'].'jpg')){
        unlink('img/info/'.$_GET['delID'].'jpg');
    }
}

if(!empty($_GET['updID'])){
    $etelNev = $_POST['etelNev'.$_GET["updID"]];
    $tomeg = $_POST['tomeg'.$_GET["updID"]];
    $kiETEL->setEtel($etelNev, $tomeg); //ETEL osztály segéd pédánya
    $kiETEL->updEtel($Db, $_GET['updID']);
    

    
    if(isset($_FILES["info".$_GET['updID']])){ //fájl feltötlt
        $target_dir = "img/info/";
        $target_file = $target_dir . $_GET['updID'].'.jpg'; //teljes elérési út
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $uploadOK = 0;

        if($imageFileType != "jpg"){ //csak jpg lehetséges(később változhat!!)
            $uploadOK = 1;
        }
        
        if ($_FILES["info".$_GET["updID"]]["size"] > 5000000000) {
            $uploadOK = 2;
        }
        
        if($uploadOK == 0){
            if (move_uploaded_file($_FILES["info".$_GET['updID']]["tmp_name"], $target_file)) {
                $uploadOK = -1;
            }
        }
    }
}





if($uploadOK==-1){
    header('Location:index.php?action=hozza&act=kepes');
    exit;
}
else{
    header('Location:index.php?action=hozza');
    exit;
}


?>