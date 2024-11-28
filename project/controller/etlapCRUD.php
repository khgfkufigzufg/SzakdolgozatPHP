<?php
if(isset($_POST['datum'])){ //admin étlap létrehozás közben a sorokat itt tároljuk
    if(isset($_SESSION['ideigEtlap'])){
        $_SESSION['ideigEtlap'][count($_SESSION['ideigEtlap'])+1]['datum'] = $_POST['datum'];
        $_SESSION['ideigEtlap'][count($_SESSION['ideigEtlap'])]['leves'] = $_POST['leves'];
        $_SESSION['ideigEtlap'][count($_SESSION['ideigEtlap'])]['aetel'] = $_POST['aetel'];
        $_SESSION['ideigEtlap'][count($_SESSION['ideigEtlap'])]['betel'] = $_POST['betel'];
    }
    else{
        $_SESSION['ideigEtlap'][1]['datum'] = $_POST['datum'];
        $_SESSION['ideigEtlap'][1]['leves'] = $_POST['leves'];
        $_SESSION['ideigEtlap'][1]['aetel'] = $_POST['aetel'];
        $_SESSION['ideigEtlap'][1]['betel'] = $_POST['betel'];
    }
    
}


if(isset($_SESSION['ideigEtlap'])){ //kitörölt elemek a tömbben maradnak null értékkel
    $nullos=1;
    while($nullos<count($_SESSION['ideigEtlap']) && $_SESSION['ideigEtlap'][$nullos]==null){
        $nullos++;
    }
    echo $nullos;
}


if(!empty($_GET['delID'])){
    if($nullos == $_GET['delID']){
        $_SESSION['ideigEtlap'][$nullos]=NULL;
        $nullos++;
    }
    else{
        $sv = $_SESSION['ideigEtlap'][$nullos];
        $_SESSION['ideigEtlap'][$nullos]=NULL;
        $_SESSION['ideigEtlap'][$_GET['delID']]= $sv;
        $nullos++;
    }
    echo '  '.$nullos;
}


if(count($_SESSION['ideigEtlap'])>1){ //ideiglenes étlap sorba rendezése
    for($i=$nullos;$i<count($_SESSION['ideigEtlap']);$i++){
        $min=$i+1;
        for($j=$i;$j<count($_SESSION['ideigEtlap'])+1;$j++){
            if($_SESSION['ideigEtlap'][$j]['datum']<$_SESSION['ideigEtlap'][$min]['datum']){
                $min=$j;
            }    
        }
        $sv = $_SESSION['ideigEtlap'][$i];
        $_SESSION['ideigEtlap'][$i] = $_SESSION['ideigEtlap'][$min];
        $_SESSION['ideigEtlap'][$min] = $sv;
    }
}


if(!empty($_GET['lead'])){ //etlapSorok mentése az adatbázisba
    foreach($_SESSION['ideigEtlap'] as $etlapSor){
        if($etlapSor != NULL){
            $beEtlapSor->setEtlapSor($etlapSor['leves'], $etlapSor['aetel'], $etlapSor['betel'], $etlapSor['datum']);
            $beEtlapSor->addSor($Db);
            unset($_SESSION['ideigEtlap']);
        }
    }
}


header('Location:index.php?action=etlap');
exit;

?>