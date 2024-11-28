<!-- ----------------REGISZTRÁCIÓS FELÜLET---------------------- -->
    <form class="form-signin" method="post" action="index.php?action=regist">
    <a href="index.php?action=start"><img class="mb-4" src="img/mezenga.png" alt="" width="120" height="120"></a>
    
    
    
    <?php 
    if(isset($reg)){
        if($reg === FALSE And isset($mess)) echo '<div class="alert alert-danger" role="alert">'.$mess.'</div>';
    }
    
    ?>
    	<h1 class="h3 mb-3 font-weight-normal">Regisztráció:</h1>
    			<label for="inputEmail" class="sr-only">E-mail cím</label>
    			<input type="email" name="email" id="inputEmail" class="form-control" placeholder="E-mail cím" value="<?php if(isset($_POST['email'])){echo $_POST["email"];} ?>" required autofocus>
    			
    			<label for="iunev" class="sr-only">Név</label>
    			<input type="text" name="unev" id="iunev" class="form-control" placeholder="Név" value="<?php if(isset($_POST['unev'])){echo $_POST["unev"];} ?>" required>
    			
    			<label for="inputPassword" class="sr-only">Jelszó</label>
    			<input type="password" name="jelszo" id="inputPassword" class="form-control" placeholder="Jelszó" value="<?php if(isset($_POST['jelszo'])){echo $_POST["jelszo"];} ?>"  required>
    			
    			
    			<label for="inputPassword2" class="sr-only">Jelszó mégegyszer</label>
    			<input type="password" name="jelszo2" id="inputPassword2" class="form-control" placeholder="Jelszó mégegyszer" value="<?php if(isset($_POST['jelszo2'])){echo $_POST["jelszo2"];} ?>" required>
    			
    			
    			
    			
    			Település: <select name="uTelep" class="select">
    			
    			<?php 
    			$lista->telepulesLista($Db);
    			?>
    			</select><br>
    			
    			<label for="iutca_hsz" class="sr-only">Cím második fele</label>
    			<input type="text" name="utca_hsz" id="iutca_hsz" class="form-control" placeholder="Cím második sora" value="<?php if(isset($_POST['utca_hsz'])){echo $_POST["utca_hsz"];} ?>" required>
    			
    			
    			
    			
    			<div class="container">
                  <div class="row align-items-center">
                    <div class="col-2 center-block">
                      +36
                    </div>
                    <div class="col-3">
                      <input type="tel" class="form-control"  name="phone" pattern="[0-9]{2}" placeholder="xx" size="2" value="<?php if(isset($_POST['phone'])){echo $_POST["phone"];} ?>" required>
                    </div>
                    <div class="col-7">
                     <input type="tel" class="form-control"  name="phone2" pattern="[0-9]{3}-[0-9]{4}" placeholder="xxx-xxxx" value="<?php if(isset($_POST['phone2'])){echo $_POST["phone2"];} ?>" required>
                    </div>
                  </div>
                </div>
    			<label id="felt">
    				<input type="checkbox" name="felt"> Elfogadom...<a href="index.php" target="_blank">testest</a>
    			</label>
    			 
				
    		<button class="btn btn-lg btn-primary btn-block button" type="submit">Regisztráció</button>

    </form>