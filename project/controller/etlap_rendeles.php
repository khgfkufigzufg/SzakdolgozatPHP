<?php

//Etlapok megjelenítéséhez szükséges adatok létrehozatala
//$tester = strtotime('2021-04-01');

$elore = date("N")-1;

$heteleje  = mktime(0, 0, 0, date("m")  , date("d")-$elore, date("Y"));//hételeji dátum
$date = date("Y-m-d", $heteleje);
$atomd = explode("-", date("Y-m-d",strtotime($date)));

$etlapok = $beEtlapSor->keszEtlap($Db, $kiad=FALSE, $date); //EtlapSor osztály egyedének használata keszEtlap függvény ezeknél a bemenő paramétereknél A lekezelt dátumokat tartalmazó tömbbel tér vissza
//print_r($etlapok);

require 'view/etelek/etlapok.php';
?>