<?php

class Tetel{
    
    private $napId;
    private $eid;
    private $menny;
    
    public function setTetel($napId, $eid, $menny){
        $this->napId=$napId;
        $this->eid = $eid;
        $this->menny = $menny;
    }
    
    public function addTetel($Db){
        $sql = "INSERT INTO `tetelesrend` (`napId`, `eid`, `menny`) VALUES ('".$this->napId."', '".$this->eid."', '".$this->menny."');";
        $this->napId = $Db->insertSQL($sql);
    }
    
    public function getTetel($napId, $eid, $Db) {
        $this->getTetelFromDB($napId, $eid, $Db);
    }
    
    public function delTetel($Db, $napId, $eid){
        $sql = "DELETE FROM `tetelesrend` WHERE napId =".$napId." AND eid=".$eid;
        return $result = $Db->execSQL($sql);
    }
    
    private function getTetelFromDB($napId, $eid, $Db) {
        
        $sql = "SELECT * FROM tetelesrend WHERE napId = ".$napId." AND eid=".$eid;
        $result = $Db->execSQL($sql);
        
        if($row = $result->fetch_assoc()) {
            $this->napId = $row['napId'];
            $this->eid = $row['eid'];
            $this->menny = $row['menny'];
        }
    }
}
$Tetel = new Tetel();
?>