<?php
session_start();

//-------------osztályok---------------
require 'model/db.inc.php';
require 'model/Hozzavalo.php';
require 'model/Telepules.php';
require 'model/Rendeles.php';

require 'model/Etel.php';

require 'model/EtlapSor.php';
require 'model/EtelHozzavalo.php';

require 'model/NapiRendeles.php';
require 'model/User.php';
require 'model/Tetel.php';
//-------------osztályok---------------


if(isset($_COOKIE['user'])){//BELÉPTETÉS----------------------------
    $sql = "SELECT * FROM user WHERE email LIKE '".$_COOKIE['user']."'";
    $result = $Db->execSQL($sql);
    if($row = $result->fetch_assoc()){
        $_SESSION['user'] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="hu">
    <head>
    	<!-- Head -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    
	<?php 
	if(isset($_REQUEST['action'])){
    	if($_REQUEST['action'] == 'belep' || $_REQUEST['action'] == 'regist'){
    	    echo'<link rel="stylesheet" type="text/css" href="style/style.css">'; 
    	}
    	if($_REQUEST['action'] == 'etlap_rendeles' || $_REQUEST['action'] == 'kosar'){
    	    echo'<link rel="stylesheet" type="text/css" href="style/etlapok.css">';
    	}
	}
	if(isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1){
	    echo'<link rel="stylesheet" type="text/css" href="style/admin.css">';
	}
	?>
	<link rel="stylesheet" type="text/css" href="style/tooltip.css">
	<link rel="stylesheet" type="text/css" href="style/kosarRend.css">
	<title>Mezenga</title>
    </head>
	
	<?php 
	//-------------ACTION---------------
	$action = 'start';
	$adminact = array('hozza','delhozz','hozzavaloAdd', 'updHozz', 'etelhozzr', 'etlapCRUD', 'etelCRUD');
	
	if(!empty($_REQUEST['action'])) {
	    if(in_array($_REQUEST['action'], $adminact)){
	        if(isset($_SESSION['user'])){
    	        if($_SESSION['user']['admin']==1){
    	            if(file_exists('controller/'.$_REQUEST['action'].'.php')) {
    	                $action = $_REQUEST['action'];
    	            }
    	        }
	        }
	        else{
	            $action = 'start';
	        }
	    }
	    elseif(file_exists('controller/'.$_REQUEST['action'].'.php')) {
	        $action = $_REQUEST['action'];
	    }
	}
	//-------------ACTION---------------
	//-------------NAVBAR---------------
	    if(!($action == 'belep' || $action == 'regist')){
    	echo '<body>';
            echo '<nav class="navbar navbar-expand-xl navbar-dark bg-dark align-bottom">
          <a class="navbar-brand" href="index.php?action=start"><img src="img/mezenga.png" alt="" width="60" height="60"> <span class="szep">Mezenga</span></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse" id="navbarsExample06">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=etlap_rendeles">Étlapok</a>
            </li>';
        if(isset($_SESSION['kosar']['isset']) && $_SESSION['kosar']['isset']){
    	    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=kosar">Kosár</a>
                    </li>';
    	}
              
        	if (!isset($_SESSION['user'])) {
                  echo '
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=belep">Belépés</a>
                    </li>';
                  
        	}
        	else {
        	    
        	    if($_SESSION['user']['admin']==1){
        	        
        	        echo '<li class="nav-item dropdown">
        	           <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
        	           <div class="dropdown-menu" aria-labelledby="dropdown06">
        	           <a class="dropdown-item" href="index.php?action=hozza">Hozzávalók-Ételek</a>
        	           <a class="dropdown-item" href="index.php?action=etlap">Étlap készít/módosít</a>
        	           
        	           </div>
        	               </li>';
        	        echo '
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=rendelesMegtekint&act=kif">Rendelések</a>
                    </li>';
        	        
        	    }
        	    else{
        	        echo '
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=rendelesMegtekint">Rendeléseim</a>
                    </li>';
        	    }
        	    echo '<li class="nav-item">
                    <a class="nav-link" href="index.php?action=logout">Kilépés</a>
                    </li>';
        	}
    
    
             echo '
              
            </ul>
          </div>
        </nav>';
             
             //-------------NAVBAR---------------
    	}
    	else{
    	    echo '<body class="text-center">';
    	}
        
    	require 'controller/'.$action.'.php';//action meghívása

    ?>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>