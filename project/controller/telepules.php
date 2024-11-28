<?php
//------------------Település módosítása/felvétele---------------------
if(isset($_POST['telepNev'])){
    
    $lista->setTelepules($_POST['irsz'], $_POST['telepNev']);
    $lista->addTelepules($Db);
}

if(isset($_GET['delID'])){
    $lista->delTelepules($Db, $_GET['delID']);
}


header('Location:index.php?action=hozza');
exit;

?>