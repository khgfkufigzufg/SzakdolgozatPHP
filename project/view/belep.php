<!-- ----------------BELÉPÉS FELÜLET---------------------- -->
	
    <form class="form-signin" method="post" action="index.php?action=belep">
    <a href="index.php?action=start"><img class="mb-4" src="img/mezenga.png" alt="" width="120" height="120"></a>	
    <?php
    if(isset($login)){
        if($login === FALSE){
            echo '<div class="alert alert-danger" role="alert">HIBÁS FELHASZNÁLÓNÉV VAGY JELSZÓ</div>';
        }
    }
    if(!empty($_GET['vasarlas'])){
        echo '<div class="alert alert-danger" role="alert">Vásárláshoz bejelentkezés szükséges!</div>';
    }
    
    if(!empty($_REQUEST['reg'])){
        echo'<div class="alert alert-success" role="alert">
            Sikeres regisztráció!
            </div>';
    }
    ?>
    
    	<h1 class="h3 mb-3 font-weight-normal">Adja meg bejelentkezési adatait:</h1>
    	
    			
    			<label for="inputEmail" class="sr-only">E-mail cím</label>
    			<input type="email" name="email" id="inputEmail" class="form-control" 
    			<?php if(isset($_REQUEST['reg'])){
    			    $user = new User();
    			    $user->getUser($_REQUEST['reg'], $Db);
    			    echo'value="'.$user->getUserInfo()['EMAIL'].'"';}?> placeholder="E-mail cím" required autofocus>
    			
    			
    			<label for="inputPassword" class="sr-only">Jelszó</label>
    			<input type="password" name="jelszo" id="inputPassword" class="form-control" placeholder="Jelszó" required>
    			
    			<div class="checkbox mb-3">
    			<label>
    				<input type="checkbox" name="suti" value="Emlékezz rám"> Emlékezz rám
    			</label>
    		</div>
    		<button class="btn btn-lg btn-primary btn-block button" name="reg" type="submit">Belépés</button>
    		<a href="index.php?action=regist"><button class="btn btn-lg btn-primary btn-block button" type="button">Regisztráció itt</button></a>
    </form>
	