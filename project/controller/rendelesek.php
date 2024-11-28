<?php 
if($_SESSION['user']['admin'] == 1){
    echo '<div class="con"><div class="etlapcr">';
    echo '<a href="index.php?action=rendelesMegtekint&act=mai"><input type="button" value="Mai tételek"></a><a href="index.php?action=rendelesMegtekint&act=kif"><input type="button" value="Rendelés kifizetés"></a>';
    echo '<h2>Beérkezett rendelések kifizetése</h2>';
    echo '<form method="post" action="index.php?action=rendelesMegtekint&act=kif"><input type="text" name="knev"><input type="submit" value="Szürés név alapján"></form><hr>';
    echo '<div class="sor">';
    
    echo '<div class="koz">Rendelés dátuma</div>';
    echo '<div class="koz">Kártyás fiztés</div>';
    echo '<div class="koz">Rendelő neve</div>';
    echo '<div class="koz">Rendelő telefonszáma</div>';
    echo '<div class="koz">Fizetés</div>';
    
    echo '<hr>';
    echo '</div>';
    if(isset($rendelesek)){
        foreach($rendelesek as $rendeles){
            echo '<div class="sor">';
            foreach($rendeles as $key => $adat){
                switch ($key) {
                    case 'rendId':
                        $rendId = $adat;
                        break;
                    case 'userId':
                        $uinfo = $User->getUser($adat, $Db);
                        break;
                    case 'renddatum':
                        echo '<div class="koz">'.$adat.'</div>';
                        break;
                    case 'kartyase':
                        if($adat == 0){
                            echo '<div class="koz">nem</div>';
                        }
                        else{
                            echo '<div class="koz">igen</div>';
                        }
                        break;
                    case 'fizetette':
                        $fiz = $adat;
                        break;
                }
            }
            echo '<div class="koz">'.$uinfo['unev'].'</div><div class="koz">'.$uinfo['tel'].'</div>';
            if($fiz == 0){
                echo '<div class="koz"><a href="index.php?action=rendelesMegtekint&act=kif&kif='.$rendId.'"><input type="button" value="Kifizetés"></a></div>';
            }
            else{
                echo '<div class="koz">fizetett</div>';
            }
            echo'</div>';
            echo '<hr>';
        }
    }
    else{
        echo '<div class="mess">Jelenleg nincs kifizetendő megrendelés</div>';
    }
    echo '</div>';
   
        require 'view/rendelesMegtekint/haromheti.php';
}
else{
    if(isset($rendeleseim)){
        echo '<div class="con kosarRendeles"><h1>Rendeléseim</h1>';
    
        foreach ($rendeleseim as $rendeles => $datumok){
            echo '<div class="egyRendeles">';
            echo '<div class="egyRendelesFej"><div class="Fej">Rendelés leadás dátuma</div><div class="Fej">Rendelés törlése</div><div class="Fej3"><div class="Fej1">Kiszállítás dátuma</div><div class="Fej2">Tételek</div></div></div>';
            $rendelesAdatok = $Rendeles->getRendeles($rendeles, $Db);
            echo '<div class="Rendeles">';
            echo '<div class="datum">'.$rendelesAdatok['renddatum'].'</div><div class="datum"><a href="index.php?action=rendelesMegtekint&delId='.$rendeles.'"><input type="button" class="gomb" value="Törlés"></a></div>';
            echo'<div class="datumok">';
            
            foreach ($datumok as $datum => $etelek){
                echo '<div class="harom"><div class="datumBelso">'.$datum.'</div>';
                $tetelek="";
                foreach ($etelek as $etel => $db){
                    $tetel = $kiETEL->getEtel($etel, $Db);
                    $tetelek .=  '<div class="etel">'.$tetel['etelNev'].': '.$db.' db';
                   
                    $tetelek .=  '</div>';
                }
                echo '<div class="etelek">';
                echo $tetelek.'</div></div>';
                
                
            }
            echo '</div></div></div>';
        }
        echo '</div>';
    }
    else{
        echo'<div class="con mess"><h1>Jelenleg nincs kifizetendő, illetve kiszállítandó tételekkel lévő megrendelése!</h1></div';
    }
}

?>

