<!-- Étel/hozzávaló admin felület fő view -->
<div class="con">
    <div class="hozzav-cont">
    <h2>Hozzávalók</h2><hr>
    	<form method="post" action="index.php?action=hozzavaloAdd">
    	Megnevezés:<input type="text" name="hnev" required>
    	Mértékegység:<input type="text" name="megys" class="megys" required>
    	
    	<label for="allergen">Allergén:</label>
    	<input type="checkbox" id="allergen" name="allergen">
    	<input type="submit" name="submit" id="elso" value="Hozzáad">
    	</form>
    	<hr>
    	<h5>Módosítás/törlés:</h5>
    	<?php 
    	if(isset($kivetel)){
    	    $kiHOZZ->hlista($Db,'form',$kivetel['eid']);
    	}
    	else{
    	    $kiHOZZ->hlista($Db,'form');
    	}
    	?>
    </div>
    <div class="hozzav-cont"><h2>Ételek</h2>
    <?php if(isset($_GET['act']) && $_GET['act']=='kepes'){?>
    <a href="index.php?action=hozza"><input type="button" value="Egyszerű módosítás"></a><hr>
		<?php }else{?>
	<a href="index.php?action=hozza&act=kepes"><input type="button" value="Anyagnormák módosítása"></a><hr>	    
		<?php }
		require 'etel.php'; ?>
    </div>
    <div class="hozzav-cont" id="right">
    <h2>Hozzávalók ételekhez rendelése</h2><hr>
    	<?php require 'etel_hozzav.php'; ?>
    </div>
    <?php require 'view/user/telepulesForm.php'; ?>
</div>