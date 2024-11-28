<?php
//-----------------------Rendelés megtekintés user/admin---------------------------

if(isset($_SESSION['user'])){
    if($_SESSION['user']['admin'] == 1){ //Admin
        
        if(isset($_GET['act']) && $_GET['act'] == 'kif'){ //kifizetendő vagy futó megrendelések
            $sql = "SELECT DISTINCT rendeles.rendId FROM `rendeles` 
                    INNER JOIN napirendeles ON rendeles.rendId = napirendeles.rendId";
            $sql .= " INNER JOIN user ON rendeles.userId=user.userId
                    WHERE fizetette = 0 OR napirendeles.datum>=CURDATE()";
            if(isset($_POST['knev'])){
                $sql .= " AND unev LIKE '%".$_POST['knev']."%'";
            }
            
            $result = $Db->execSQL($sql);
            
            while($row = $result->fetch_assoc()){
                $rendelesek[$row['rendId']] = $Rendeles->getRendeles($row['rendId'], $Db); 
            }
        }
        elseif(isset($_GET['act'])){ //mai tételek
            $sql = "SELECT  rendeles.rendId, eid, SUM(menny) as db, rendeles.userId FROM tetelesrend 
                    INNER JOIN napirendeles ON tetelesrend.napId=napirendeles.napId
                    INNER JOIN rendeles ON rendeles.rendId=napirendeles.rendId
                    WHERE napirendeles.datum=CURDATE()
                    GROUP BY rendeles.rendId, eid";
            $result = $Db->execSQL($sql);
            while($row = $result->fetch_assoc()){
                $maitetelek[$row['rendId']]['userId'] = $row['userId'];
                $maitetelek[$row['rendId']][$row['eid']] = $row['db'];
                
            }
        }
        //háromheti szükségletek
        $sql = "SELECT eid, SUM(menny) as db FROM tetelesrend 
                INNER JOIN napirendeles ON tetelesrend.napId=napirendeles.napId
                WHERE napirendeles.datum>=CURDATE()
                GROUP BY eid";
        $result = $Db->execSQL($sql);
        
        if($result->num_rows>0){ 
            while($szukseglet = $result->fetch_assoc()){
                $sql2 = "SELECT hozzavalo.hid, mennyi, megys FROM hozzavalo 
                         INNER JOIN etelhozzav ON hozzavalo.hid=etelhozzav.hid WHERE eid = ".$szukseglet['eid'];
                $rs = $Db->execSQL($sql2);
                if($rs->num_rows>0){
                    while($hozz = $rs->fetch_assoc()){
                        if(!isset($haromheti[$hozz['hid']][$hozz['megys']])){
                            $haromheti[$hozz['hid']][$hozz['megys']] = ($hozz['mennyi']*$szukseglet['db']);
                        }
                        else{
                            $haromheti[$hozz['hid']][$hozz['megys']] += ($hozz['mennyi']*$szukseglet['db']);
                        }
                    }
                }
            }
        } 
        //kereső alapján napi teendők
        if(isset($_POST['kivdatum'])){
            $napiEteleksql = "SELECT eid, SUM(menny) as db FROM tetelesrend 
                              INNER JOIN napirendeles ON tetelesrend.napId=napirendeles.napId
                          WHERE napirendeles.datum='".$_POST['kivdatum']."'
                          GROUP BY eid";
            $napiEtelek = $Db->execSQL($napiEteleksql);
            if($napiEtelek->num_rows>0){
                while($napiEtel = $napiEtelek->fetch_assoc()){
                    $nap[$napiEtel['eid']] = $napiEtel['db'];
                }
            }
        } 
    }
    
    else{ //user saját rendelési adatai/
        $sql = "SELECT rendeles.rendId, napirendeles.datum, tetelesrend.eid, tetelesrend.menny FROM `rendeles` 
                INNER JOIN napirendeles ON rendeles.rendId = napirendeles.rendId
                INNER JOIN tetelesrend ON napirendeles.napId=tetelesrend.napId
                WHERE (napirendeles.datum >= CURDATE() OR rendeles.fizetette=0)
                AND userId=".$_SESSION['user']['userId'];
        
        $result = $Db->execSQL($sql);
        while($row = $result->fetch_assoc()){
            $rendeleseim[$row['rendId']][$row['datum']][$row['eid']] = $row['menny'];
        }
        
        if(isset($_GET['delId'])){
            $Rendeles->delRendeles($Db, $_GET['delId']);
            header("Refresh:0 url=index.php?action=rendelesMegtekint");
        }
        
        require 'view/user/rendelesek.php';
    }
    
    
    if(!empty($_GET['kif'])){
        $Rendeles->fizetes($Db, $_GET['kif']);
        header("Refresh:0 url=index.php?action=rendelesMegtekint&act=kif");
    }
}
else{
    header('Location:index.php?action=belep');
    exit;
}


if(isset($_GET['act']) && $_GET['act']== 'kif'){
    require 'view/user/rendelesek.php';
}
elseif(isset($_GET['act'])){
    require 'view/rendelesMegtekint/maiTetelek.php';
}







?>