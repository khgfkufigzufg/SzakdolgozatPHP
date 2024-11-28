<?php

require 'model/db.inc.php';
require 'model/Hozzavalo.php';
require 'model/Telepules.php';
require 'model/Rendeles.php';
require 'model/EtlapSor.php';
require 'model/EtelHozzavalo.php';
require 'model/Etel.php';
require 'model/NapiRendeles.php';
require 'model/User.php';
require 'model/Tetel.php';



$testerhozzav = new Hozzavalo();
$testtelep = new Telepules();
$testEtel = new Etel();
$testEtelHozzav = new EtelHozzav();

$etelNev = "Rántotta";
$tomeg = 400;

$testEtelHozzav->setEtelHozzav(12, 2, 200);
//$testEtelHozzav->addEtelHozzav($Db);
echo $testEtelHozzav->osszetetel($Db, 2).'<br>';
$testEtel->setEtel($etelNev, $tomeg);

//$testEtel->delEtel($Db, 1);
//$testEtel->addEtel($Db);
print_r($testEtelHozzav);
echo '<br>';

if(isset($_POST["datum"])){
    /*$sv = $_POST["toroltel"];
    $testtelep->delTelepules($Db, $sv);*/
    echo $ma = $_POST['datum'];
    echo '<br>';
    
    $atomd = explode("-", date("Y-m-d",strtotime($ma)));
    echo $atomd[0];
    echo '<br>';
    echo $atomd[1];
    echo '<br>';
    echo $atomd[2];
    echo '<br>';
    
    $sv = date("Y-m-d",mktime(0,0,0,$atomd[1],$atomd[2],$atomd[0]));
    $TEST = new EtlapSor();
    $TEST->setEtlapSor(5, 5, 5, $sv);
    //$TEST->addSor($Db);
}

    $megys = "g";
    $hnev = "bors";
    $allergen = "0";
    
$testerhozzav->setHozzavalo($megys, $hnev, $allergen);

//$testerhozzav->addHozzavalo($Db);


    $irsz = 2600;
    $telepulesNev = "Tatabánya";

$testtelep->setTelepules($irsz, $telepulesNev);
//$testtelep->addTelepules($Db);

$rendtest = new Rendeles();

$userId = 2;
$kartyase = 0;

$rendtest->setRendeles($userId, $kartyase);


//$rendtest->addRendeles($Db);
$napitest = new NapiRendeles();


$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
$napitest->setNapi(3, date("Y-m-d", $tomorrow));
//$napitest->addNapi($Db);
print_r($napitest);
echo '<br>';

//$etlaptest = new EtlapSor();
//print_r($etlaptest);

$user = new User();
$user->setUser("pogi", "123", 8, "asdsdasd 56.", "a@b.hu", "123456");
//$user->addUser($Db);
//$user->getUser(4, $Db);
//$user->deleteUser($Db);
//print_r($user);

?>




<form action="test.php" method ="post">
	<input type="date" name="datum">
    <select name = "torolhozz">
        <?php 
        $testerhozzav->hlista($Db, 'list');
                
        ?>
    </select>
    <select name="toroltel">
    	<?php 
    	$testtelep->telepulesLista($Db);
    	?>
    </select>
    <input type="submit" name="submit" value="Küld">

    
    
    
    
    
</form>
