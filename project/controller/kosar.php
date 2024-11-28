<?php

//--------------------KOSÁR----------------------majd vissza kerülünk arra a felütre amelyikről érkeztünk étlap/kosár(ha kosár üres=>étlapra jutunk)
if(isset($_GET['lead'])){ //RENDELÉS MENTÉS
    if(isset($_SESSION['user'])){
        if(isset($_POST['kartyase'])){
            $Rendeles->setRendeles($_SESSION["user"]['userId'], 1);
            $Rendeles->addRendeles($Db);
        }
        else{
            $Rendeles->setRendeles($_SESSION["user"]['userId'], 0);
            $Rendeles->addRendeles($Db);
        }
        for($i=0;$i<$_SESSION['dbtetel'];$i++){
            
           
            $j=$i;
            $NapiRendeles->setNapi($Rendeles->getRendID(), $_POST['datum'.$i]);
            $NapiRendeles->addNapi($Db);
            while($j<$_SESSION['dbtetel'] && $_POST['datum'.$i] == $_POST['datum'.$j]){
                
                $Tetel->setTetel($NapiRendeles->getNapiID(), $_POST['etel'.$j], $_POST['menny'.$j]);
                $Tetel->addTetel($Db);
                $j++;   
            }
            $i=$j-1;
        }
        
        unset($_SESSION['kosar']);
        header('Location:index.php?action=etlap_rendeles');
        exit;
    }
    else{
        header('Location:index.php?action=belep&vasarlas=TRUE');
        exit;
    }
}
elseif(!empty($_GET['datum']) && !empty($_GET['eid']) && !empty($_GET['act'])){
    if(isset($_SESSION['kosar'][$_GET['datum']][$_GET['eid']])){
        if($_GET['act'] == 'del'){//GETbe mentett datum eid alapján töröljük a kosár elemet
            $_SESSION['kosar'][$_GET['datum']][$_GET['eid']] = 0;
            header('Location:index.php?action=kosar');
            exit;
        }
        elseif($_GET['act'] == 'minus'){//GETbe mentett datum eid alapján csökkentjük a kosár elem mennyiségét
            if($_SESSION['kosar'][$_GET['datum']][$_GET['eid']]>0){
                $_SESSION['kosar'][$_GET['datum']][$_GET['eid']]--;

                if(isset($_GET['kosar'])){
                    header('Location:index.php?action=kosar');
                    exit;
                }
                else{
                    if(isset($_GET['tabla'])){
                        header('Location:index.php?action=etlap_rendeles#'.$_GET['datum'].''.$_GET['eid']);
                        exit;
                    }
                    else{
                        header('Location:index.php?action=etlap_rendeles');
                        exit;
                    }
                }
            }
            else{
                if(isset($_GET['kosar'])){
                    header('Location:index.php?action=kosar');
                    exit;
                }
                elseif(isset($_GET['tabla'])){
                    header('Location:index.php?action=etlap_rendeles#'.$_GET['datum'].''.$_GET['eid']);
                    exit;
                }
                else{
                    header('Location:index.php?action=etlap_rendeles');
                    exit;
                }
            }
        }
        elseif($_SESSION['kosar'][$_GET['datum']][$_GET['eid']]<127){//GETbe mentett datum eid alapján csökkentjük a kosár elem mennyiségét
            $_SESSION['kosar'][$_GET['datum']][$_GET['eid']]++;
            $_SESSION['kosar']['isset'] = TRUE;
            if(isset($_GET['kosar'])){
                header('Location:index.php?action=kosar');
                exit;
            }
            elseif(isset($_GET['tabla'])){
                header('Location:index.php?action=etlap_rendeles#'.$_GET['datum'].''.$_GET['eid']);
                exit;
            }
            else{
                header('Location:index.php?action=etlap_rendeles');
                exit;
            }
        }
    }
    else{
        if(isset($_GET['kosar'])){
            header('Location:index.php?action=kosar');
            exit;
        }
        elseif(isset($_GET['tabla'])){
            header('Location:index.php?action=etlap_rendeles#'.$_GET['datum'].''.$_GET['eid']);
            exit;
        }
        else{
            header('Location:index.php?action=etlap_rendeles');
            exit;
        }
    }
    
}



    


    require 'view/etelek/kosar.php';


?>