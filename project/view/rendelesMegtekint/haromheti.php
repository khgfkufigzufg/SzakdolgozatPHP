<!-- Admin oldali rendelés megtekintés kisegítő táblázata a  segédtábla a rendelésMegtekint controllerben jön létre-->
<div class="haromheti"> 
	<h3>A következő 3 heti szükségletek</h3><hr>
	<?php 
	//print_r($haromheti);
	foreach ($haromheti as $hozzav => $adat){
	    $hnev = $kiHOZZ->getHozzavalo($hozzav, $Db);
	    echo $hnev.': ';
	    foreach ($adat as $megys => $db){
	        echo $db.' '.$megys.'<br>';
	    }
	}
	
	
	?>
	
</div>
<div class="mai"> 
	<h3>Teendők a kiválasztott napra</h3>
	<?php 
	echo '<form method="post" action="index.php?action=rendelesMegtekint&act='. $_GET['act'].'">';

	?>
		<input type ="date" name="kivdatum" <?php
		if(isset($_POST['kivdatum'])){
		    echo 'value="'.$_POST['kivdatum'].'"';
		} 
		else{
		    echo 'value="'.date("Y-m-d").'"';
		}
		?> required>
		<input type ="submit" value="Megtekintés">
	</form>
	<hr>
	<?php 
	if(isset($nap)){
	    foreach ($nap as $etel => $db){
	        $etelNev = $kiETEL->getEtel($etel, $Db);
	        echo $etelNev['etelNev'].': '.$db.' db<br>';
	    }
	}
	else{
	   echo '<div class="mess">Nincs a kiválaszott napra teendő</div>';
	}
	
	
	?>
	
</div>