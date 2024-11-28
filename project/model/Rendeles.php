<?php

class Rendeles{
    
    private $rendId;
    private $userId;
    private $renddatum;
    private $kartyase;
    private $fizetette;
    
    public function __construct(){
        $this->renddatum = date("Y-m-d H:i:s");
        $this->fizetette = 0;
    }
    
    public function getRendID(){
        return $this->rendId;
    }
    
    public function setRendeles($userId, $kartyase){
        $this->userId = $userId;
        $this->kartyase = $kartyase;
    }
    
    public function delRendeles($Db, $rendId){
        $sql = "DELETE FROM `rendeles` WHERE rendId =".$rendId;
        return $result = $Db->execSQL($sql);
    }
    
    public function addRendeles($Db){
        $sql = "INSERT INTO `rendeles` (`rendId`, `userId`, `renddatum`, `kartyase`, `fizetette`) VALUES (NULL, '".$this->userId."', '".$this->renddatum."', '".$this->kartyase."', '".$this->fizetette."');";
        $this->rendId = $Db->insertSQL($sql);
    }
    
    public function getRendeles($rendId, $Db) {
        $this->getRendelesFromDB($rendId, $Db);
        return array("rendId" => $this->rendId, "userId" => $this->userId, "renddatum" => $this->renddatum, "kartyase" => $this->kartyase, "fizetette" => $this->fizetette);
    }
    
    public function fizetes($Db, $rendId){
        $sql = "UPDATE rendeles SET fizetette = 1 WHERE rendId=".$rendId;
        return $result = $Db->execSQL($sql);
    }
    
    private function getRendelesFromDB($rendId, $Db) {
        
        $sql = "SELECT * FROM rendeles WHERE rendId = ".$rendId;
        $result = $Db->execSQL($sql);
        
        if($row = $result->fetch_assoc()) {
            $this->rendId = $row['rendId'];
            $this->userId = $row['userId'];
            $this->renddatum = $row['renddatum'];
            $this->kartyase = $row['kartyase'];
            $this->fizetette = $row['fizetette'];
        }
    }
    
    
}
$Rendeles = new Rendeles();
?>