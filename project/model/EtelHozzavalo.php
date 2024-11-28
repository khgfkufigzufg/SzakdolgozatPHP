<?php

class EtelHozzav{
    
    private $hid;
    private $eid;
    private $mennyi;
    
    public function setEtelHozzav($hid, $eid, $mennyi){
        $this->hid = $hid;
        $this->eid = $eid;
        $this->mennyi = $mennyi;
    }
    
    public function addEtelHozzav($Db){
        $ism = "SELECT * FROM etelhozzav WHERE hid='".$this->hid."' AND eid ='".$this->eid."'";
        $rs = $Db->execSQL($ism);
        
        if($rs->num_rows==0){
            $sql = "INSERT INTO `etelhozzav` (`hid`, `eid`, `mennyi`) VALUES ('".$this->hid."', '".$this->eid."', '".$this->mennyi."');";
            return $result = $Db->execSQL($sql);
        }
    }
    
    public function updateEtelHozzav($hid, $eid, $mennyi, $Db){
        $sql ="UPDATE etelhozzav SET mennyi='".$mennyi."' WHERE hid='".$hid."' AND eid='".$eid."'";
        $res = $Db->execSQL($sql);
    }
    
    public function updForm($eid, $Db){
        $sql = "SELECT eid, etelhozzav.hid, hnev, mennyi, megys FROM `etelhozzav` INNER JOIN hozzavalo ON etelhozzav.hid=hozzavalo.hid WHERE eid='".$eid."'";
        $rs = $Db->execSQL($sql);
        if($rs->num_rows==0){
            echo '<div class="mess">Még nincs az ételhez hozzávaló rendelve!</div>';
        }
        else{
            while($row = $rs->fetch_assoc()){
                echo '<form method="post" action="index.php?action=etelhozzr&upde='.$row["eid"].'&updh='.$row["hid"].'" class="modositok">';
                echo '<div class="hozzavalo">'.$row['hnev'].' ('.$row["megys"].'): </div>';
                echo '<input type="number" name="eh'.$row["hid"].''.$row["eid"].'" placeholder="max 32000" value="'.$row["mennyi"].'" required>';
                echo '<a href="index.php?action=etelhozzr&torole='.$row["eid"].'&torolh='.$row["hid"].'"><input type="button" name="deleth" value="Töröl"></a>';
                echo '<input type="submit" name="submit" value="Módosít" >';
                echo '</form>';
            }
        }
    }
    
    public function delEtelHozzav($Db, $eid, $hid){
        $sql = "DELETE FROM `etelhozzav` WHERE eid ='".$eid."' AND hid='".$hid."'";
        return $result = $Db->execSQL($sql);
    }
    
    public function getEtelHozzav($hid, $eid, $Db) {
        $this->getEtelFromDB($hid, $eid, $Db);
    }
    
    private function getEtelFromDB($hid, $eid, $Db) {
        
        $sql = "SELECT * FROM `etelhozzav` WHERE eid ='".$eid."' AND hid='".$hid."'";
        $result = $Db->execSQL($sql);
        if($row = $result->fetch_assoc()) {
            $this->hid = $row['hid'];
            $this->eid = $row['eid'];
            $this->mennyi = $row['mennyi'];
        }
    }
    
    public function osszetetel($Db, $eid){//Étel összetétele
        
        $sql ="SELECT * FROM hozzavalo INNER JOIN etelhozzav ON hozzavalo.hid = etelhozzav.hid WHERE etelhozzav.eid=".$eid;
        $result = $Db->execSQL($sql);
        $sv='';
        if($result->num_rows>0){
            $sv ="Az étel összetevői (az allergének félkövérrel szedve): ";
            $hozzdb = 1;
            while($row = $result->fetch_assoc()){
                if($row["allergen"]==1){
                    $sv.='<b>'.$row["hnev"]."</b>, ";
                }
                elseif($hozzdb<$result->num_rows){
                    $sv.=$row["hnev"].", ";
                }
                else{
                    $sv.=$row["hnev"];
                }
                $hozzdb++;
            }
        }
        return $sv;
    }
    
}
$EtelHozzav = new EtelHozzav();
?>