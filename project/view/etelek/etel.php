
<form method="post" action="index.php?action=etelCRUD">
    	Megnevezés:<input type="text" name="etelNev" required>
    	Nettó tömeg:<input type="number" name="tomeg" required>
    	<input type="submit" name="submit" id="elso" value="Hozzáad">
</form>
<hr>
<h5>Módosítás/törlés:</h5>
<?php 
if(isset($_GET['act']) && $_GET['act']==='kepes'){
    $kiETEL->etelLista($Db, 'kepes');//ételek módosítása képpel együtt
}
else{
    $kiETEL->etelLista($Db, 'form');//ételek módosítása kép nélkül
}
?>