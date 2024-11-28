<div class="con container">
<?php 

echo '<div class="row"><div class="tabla" id="tabla1"><div class="col-lg-6 col-md-12"><table>';
echo '<tr><th colspan="3">'.date('W', strtotime($date)).'. hét</th></tr>';
$sorszamolo = 0;
if (is_array($etlapok)) {
foreach($etlapok as $key => $adat){//Az etlap_rendelés felületen összeállított $etlapok tömb felbontása
    
    
    if(!is_null($adat)){
        
        
        if($adat === 0){// 0 esetén szünnap
            echo '<tr>';
            echo '<td class="elso">'.$key.'</td>';
            echo '<td colspan="2" class="szunnap">szünnap</td>'; 
            echo '</tr>';
        }
        else{
            
            
            echo '<tr>';
            echo '<td rowspan="3" class="elso">'.$key.'</td>';//sor elején dátum
            
            $sor = $beEtlapSor->getSor($adat, $Db);
            $elso = $kiETEL->getEtel($sor['leves'], $Db);
            $masodik = $kiETEL->getEtel($sor['aetel'], $Db);
            $harmadik = $kiETEL->getEtel($sor['betel'], $Db);
            
            
            //--------------------------naphoz tartozó 3 étel-----------------------------
            echo '<td class="masodik">';
            echo '<span class="kover">Leves:</span> '.$elso['etelNev'].'<br><input type="button" value="i" class="infogomb"><div class="felugro">'
                  .$EtelHozzav->osszetetel($Db, $elso['eid']).''.$kiETEL->getPic($elso['eid'], 'felugrokep');
            echo '<br>Nettó tömeg: '.$elso['tomeg'].' g</div></td>';
                
            $today = date("Y-m-d H:i:s");


            $most = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
            $hatar = mktime(16, 0, 0, date("m", strtotime($key)), date("d",strtotime($key))-1, date("Y",strtotime($key)));
            
            if(strtotime($today)<=$hatar){
                if(!isset($_SESSION['kosar'][$adat][$sor['leves']])){
                    $_SESSION['kosar'][$adat][$sor['leves']] = 0;
                    $_SESSION['kosar'][$adat][$sor['aetel']] = 0;
                    $_SESSION['kosar'][$adat][$sor['betel']] = 0;
                }
                
                echo '<td><div class="negyedik" id="'.$adat.''.$sor['leves'].'"><a href="index.php?action=kosar&datum='.$adat.'&eid='.$sor['leves'].'&act=minus&tabla='.($sorszamolo+1).'">
                      <input type="button" value=" - "></a><input type ="number" class="achor" min="0" value="'.$_SESSION['kosar'][$adat][$sor['leves']].'" readonly>';
                echo '<a href="index.php?action=kosar&datum='.$adat.'&eid='.$sor['leves'].'&act=plus&tabla='.($sorszamolo+1).'"><input type="button" value="+"></a></div></td></tr>';
            }
            else{
                echo '<td class="harmadik">Előző nap 16 óráig lehet rendelni!</td></tr>';
            }
            
            
            echo '<tr><td class="masodik">';
                echo '<span class="kover">A menü:</span> '.$masodik['etelNev'];
                echo '<br><input type="button" value="i" class="infogomb">';
                echo '<div class="felugro">'.$EtelHozzav->osszetetel($Db, $masodik['eid']).''.$kiETEL->getPic($masodik['eid'], 'felugrokep').'<br>Nettó tömeg: '.$masodik['tomeg'].' g</div>';
            echo '</td>';
            if(strtotime($today)<=$hatar){
                echo '<td><div class="negyedik" id="'.$adat.''.$sor['aetel'].'"><a href="index.php?action=kosar&datum='.$adat.'&eid='.$sor['aetel'].'&act=minus&tabla='.($sorszamolo+1).'">
                      <input type="button" value="-"></a><input type ="number" min="0" value="'.$_SESSION['kosar'][$adat][$sor['aetel']].'" readonly><a href="index.php?action=kosar&datum='
                      .$adat.'&eid='.$sor['aetel'].'&act=plus&tabla='.($sorszamolo+1).'"><input type="button" value="+"></a></div></td></tr>';
            }
            else{
                echo '<td class="harmadik">Előző nap 16 óráig lehet rendelni!</td></tr>';
            }
            echo '<tr><td class="masodik">';
                echo '<span class="kover">B menü:</span> '.$harmadik['etelNev'];
                echo '<br><input type="button" value="i" class="infogomb">';
                echo '<div class="felugro">'.$EtelHozzav->osszetetel($Db, $harmadik['eid']).''.$kiETEL->getPic($harmadik['eid'], 'felugrokep').'<br>Nettó tömeg: '.$harmadik['tomeg'].' g</div>';
            echo '</td>';
            if(strtotime($today)<=$hatar){
                echo '<td><div class="negyedik" id="'.$adat.''.$sor['betel'].'"><a href="index.php?action=kosar&datum='.$adat.'&eid='.$sor['betel'].'&act=minus&tabla='.($sorszamolo+1).'">
                      <input type="button" value="-"></a><input type ="number" min="0" value="'.$_SESSION['kosar'][$adat][$sor['betel']].'" readonly><a href="index.php?action=kosar&datum='.$adat.'&eid='
                      .$sor['betel'].'&act=plus&tabla='.($sorszamolo+1).'"><input type="button" value="+"></a></div></td></tr>';
            }
            else{
                echo '<td class="harmadik">Előző nap 16 óráig lehet rendelni!</td></tr>';
            } 
            //--------------------------naphoz tartozó 3 étel vége-----------------------------
        }
    }
    else{
        if (date("N", strtotime($key)) == 7){
            if($sorszamolo<2){
                echo '</table></div></div>';
                if($sorszamolo == 1){
                    echo '</div><div class="row"><div class="tabla" id="tabla3"><div class="col-12"><table><tr>';
                }else{
                    echo '<div class="tabla"><div class="col-lg-6 col-md-12" id="tabla2"><table><tr>';
                }
                $sorszamolo++;
                echo '<th colspan = "3">'.(date('W')+$sorszamolo).'. hét</th></tr>';
                
            }
            else{
                echo '</table></div></div></div>';
            }
        }
        
    }
}
}

?>
</div>