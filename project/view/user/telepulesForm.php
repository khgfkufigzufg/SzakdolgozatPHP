<!-- telepules töröl/módosít -->
<div class="hozzav-cont">
	<h2>Települések</h2><hr>
    <form method="post" action="index.php?action=telepules">
        	Megnevezés:<input type="text" name="telepNev" required>
        	Irányítószám:<input type="number" name="irsz" required>
        	<input type="submit" name="submit" id="elso" value="Hozzáad">
    </form>
    <hr>
    <h5>Törlés:</h5>
    
    <?php 
    $lista->telepulesLista($Db, 'ki');
    ?>
    
</div>