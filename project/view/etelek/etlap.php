<div class="con">
<div class="etlapcr">
	<h2>Ideiglenes étlap:</h2>
    <form class="modositok" method="post" action="index.php?action=etlapCRUD">
    Dátum:<input type="date" name="datum" required><br>
    Leves:<select name="leves"><?php $kiETEL->etelLista($Db, 'list'); ?></select><br>
    A étel:<select name="aetel"><?php $kiETEL->etelLista($Db, 'list'); ?></select><br>
    B étel:<select name="betel"><?php $kiETEL->etelLista($Db, 'list'); ?></select><br>
    <input type="submit" name="submit" value="Hozzáad">
    </form>
    <hr>
    <?php 
   
    
    if(isset($_SESSION['ideigEtlap'])){
        echo '<h5>Ideiglenes:</h5>';
        $sor = 1;
        foreach($_SESSION['ideigEtlap'] as $etlapSor){
            if($etlapSor != NULL){
                
                $etel = new Etel();
                $elso = $etel->getEtel($etlapSor['leves'], $Db);
                $masodik = $etel->getEtel($etlapSor['aetel'], $Db);
                $harmadik = $etel->getEtel($etlapSor['betel'], $Db);
                //Etlap készít form
                echo '<form class="modositok" action="index.php?action=etlapCRUD" method="post"><span class="koz">Dátum: '.$etlapSor['datum'].'</span>';
                
                echo '<span class="koz">Leves: '.$elso['etelNev'].'</span>';
                echo '<span class="koz">A étel: '.$masodik['etelNev'].'</span>';
                echo '<span class="koz">B étel: '.$harmadik['etelNev'].'</span>';

                echo '<a href="index.php?action=etlapCRUD&delID='.$sor.'"><input type="button" value="Töröl"></a>';
                echo '</form>';
                
            }
            $sor++;
        }
        if($_SESSION['ideigEtlap'][count($_SESSION['ideigEtlap'])]==null){ //ideiglenes étlap mérete
            echo '<hr>Figyelem leadás után után az étlap nem módosítható!<a><input type="button" value="Lead" disabled></a>';
        }
        else{
            echo '<hr>Figyelem leadás után után az étlap nem módosítható!<a href="index.php?action=etlapCRUD&lead=etlap"><input type="button" value="Lead"></a>';
        }
    }
    ?>
</div>
<hr>
<?php 
$beEtlapSor->keszEtlap($Db, TRUE);


?>
</div>