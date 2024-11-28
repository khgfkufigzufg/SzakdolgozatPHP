<?php
class EtlapSor{
    
    private $datum;
    private $leves;
    private $aetel;
    private $betel;

    public function setEtlapSor($leves, $aetel, $betel, $datum){
        $this->leves = $leves;
        $this->aetel = $aetel;
        $this->betel = $betel;
        $this->datum = $datum;
    }
    
    public function addSor($Db){
        $sql = "INSERT INTO `etlap` (`datum`, `leves`, `aetel`, `betel`) VALUES ('".$this->datum."', '".$this->leves."', '".$this->aetel."', '".$this->betel."');";
        return $result = $Db->execSQL($sql);    
    }
    
    public function getSor($datum, $Db) {
        $this->getEtlapSorFromDB($datum, $Db);
        return array ("datum" => $this->datum, "leves" => $this->leves, "aetel" => $this->aetel, "betel" => $this->betel );
    }

    private function getEtlapSorFromDB($datum, $Db) {
        
        $sql = "SELECT * FROM etlap WHERE datum ='".$datum."'";
        $result = $Db->execSQL($sql);
        
        if($row = $result->fetch_assoc()) {
            $this->datum = $row['datum'];
            $this->leves = $row['leves'];
            $this->aetel = $row['aetel'];
            $this->betel = $row['betel'];
        }
    }
    
    public function keszEtlap($Db, $kiad, $date=NULL){//Étlapok kilistázása admin/user
        if($date==NULL){
            $date = date("Y-m-d");
        }
        $kiETEL = new Etel();
        
        $sql = "SELECT * FROM etlap WHERE datum >='".$date."' ORDER BY datum ASC";
        
        $result = $Db->execSQL($sql);
        
        if($result->num_rows>0 && $kiad == TRUE) {//admin
            echo '<div class="etlapcr"><h2>Kész dátumok a mai nap után:</h2>';
            while($row = $result->fetch_assoc()){
                $napsz = date("N", strtotime($row['datum']));

                switch ($napsz) {
                    case 1:
                        $nap = "H";
                        break;
                    case 2:
                        $nap = "Ke";
                        break;
                    case 3:
                        $nap = "Sze";
                        break;
                    case 4:
                        $nap = "Csü";
                        break;
                    case 5:
                        $nap = "P";
                        break;
                    case 6:
                        $nap = "Szo";
                        break;
                    case 7:
                        $nap = "Vas";
                        break;
                }

                echo '<div class="left-padd"><span class="koz">'.$row['datum'].' ('.$nap.') </span>';
                
                $sv = $kiETEL->getEtel($row['leves'], $Db);
                echo '<span class="koz">'.$sv['etelNev'].'</span>';
                
                $sv = $kiETEL->getEtel($row['aetel'], $Db);
                echo '<span class="koz">'.$sv['etelNev'].'</span>';
                
                $sv = $kiETEL->getEtel($row['betel'], $Db);
                echo '<span class="koz">'.$sv['etelNev'].'</span></div><hr>';
            }
            echo '</div>';
        }
        elseif($kiad==TRUE){
            echo '<div id="center" class="mess">Nincs létrehozott dátum</div';
        }
        
        if($result->num_rows>0 && $kiad == FALSE){//user
            $datum = $date;
            $atomd = explode("-", date("Y-m-d",strtotime($datum)));
            
            for($i=1;$i<22;$i++){
                if(date("N",strtotime($datum))<6){
                    $tomb[$datum] = 0;
                }
                else{
                    $tomb[$datum] = NULL;
                }
                $datum = date("Y-m-d",mktime(0,0,0,$atomd[1],$atomd[2]+$i,$atomd[0]));
            }
            //-----------------------------------------------------------
            
            while($row = $result->fetch_assoc()){

                foreach($tomb as $key => $adat){
                    if($key == $row['datum']){
                        $tomb[$row['datum']] = $row['datum'];
                    }
                }
            }
            
            
            
            return $tomb;
        }
    }   
}
$beEtlapSor = new EtlapSor(); 
?>