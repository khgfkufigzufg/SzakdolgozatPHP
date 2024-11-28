<!-- Ételhozzávaló összekapcsolás form -->
<form method="post" action="index.php?action=hozza">
<?php 

if(isset($kivetel)){
    echo $kivetel['etelNev'];
    echo '<input type="submit" value="Másik étel">';
}
else{
    echo '<select name="etel"> ';
    $kiETEL->etelLista($Db, "list");
    echo ' </select><input type="submit" value="Küld">';
}
?>
</form>

<?php 
if(isset($kivetel)){
    echo '<hr>';
    $EtelHozzav->updForm($kivetel['eid'], $Db);//Etelhez tartozó összes hozzávaló mennyiséggel(formok)
}

?>
