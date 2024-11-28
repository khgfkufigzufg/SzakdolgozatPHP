<!-- Admin oldali rendelés megtekintés kisegítő táblázata a  segédtábla a rendelésMegtekint controllerben jön létre-->
<?php
require 'view/rendelesMegtekint/haromheti.php';
echo '<div class="con"><div class="etlapcr">';
echo '<a href="index.php?action=rendelesMegtekint&act=mai"><input type="button" value="Mai tételek"></a><a href="index.php?action=rendelesMegtekint&act=kif"><input type="button" value="Rendelés kifizetés"></a>';
echo '<h2>Mai tételek megtekintése</h2><hr>';

if(isset($maitetelek)){
    echo '<div class="sor">';
    echo '<div class="koz">Megrendelő neve</div>';
    echo '<div class="koz">Telefonszáma</div>';
    echo '<div class="koz">Címe</div>';
    echo '<div class="koz">Fizetési mód</div>';
    echo '<div class="koz">Étel - mennyiség</div></div>';
    echo '<hr>';
    foreach($maitetelek as $rendeles => $tetelek){
        
        echo '<div class="sor">';
        
        $sv ='<div class="koz">';
        foreach ($tetelek as $tetel => $adat){
            if(!is_numeric($tetel)){
                $megrendelo = $User->getUser($adat, $Db);
            }
            else{
                $etel = $kiETEL->getEtel($tetel, $Db);
                $sv .= $etel['etelNev'].' '.$adat.' db<hr>';
            }
        }
        $sv .='</div>';
        
        echo '<div class="koz">'.$megrendelo['unev'].'</div>';
        echo '<div class="koz">'.$megrendelo['tel'].'</div>';
        
        
        $telepules = $lista->getTelepules($megrendelo['tid'], $Db);
        echo '<div class="koz">'.$telepules.' ';
        echo $megrendelo['utca_hsz'].'</div>';
        
        $rend = $Rendeles->getRendeles($rendeles, $Db);
        $fizetesimod = "";
        if($rend['fizetette'] == 1){
            $fizetesimod = "kifizetve";
        }
        elseif($rend['kartyase'] == 1){
            $fizetesimod = "kártyás";
        }
        else{
            $fizetesimod = "kézpénz";
        }
        echo '<div class="koz">'.$fizetesimod.'</div>';
        echo $sv;
        echo '</div><hr>';
    }
}
else{
    echo '<div class="mess">Mára nincs teenedő</div>';
}


echo '</div></div>';

