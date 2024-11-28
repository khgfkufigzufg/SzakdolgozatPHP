<?php

class NapiRendeles{
    
    private $napId;
    private $rendId;
    private $datum;
    
    public function setNapi($rendId, $datum){
        $this->rendId = $rendId;
        $this->datum = $datum;
    }
    
    public function addNapi($Db){
        $sql = "INSERT INTO `napirendeles` (`napId`, `rendId`, `datum`) VALUES (NULL, '".$this->rendId."', '".$this->datum."');";
        $this->napId = $Db->insertSQL($sql);
    }
    
    public function getNapi($napId, $Db) {
        $this->getNapiFromDB($napId, $Db);
    }
    
    public function getNapiID() {
        return $this->napId;
    }
    
    private function getNapiFromDB($napId, $Db) {
        
        $sql = "SELECT * FROM napirendeles WHERE napId = ".$napId;
        $result = $Db->execSQL($sql);
        
        if($row = $result->fetch_assoc()) {
            $this->napId = $row['napId'];
            $this->rendId = $row['rendId'];
            $this->datum = $row['datum'];
        }
    }
    
}
$NapiRendeles = new NapiRendeles();
?>