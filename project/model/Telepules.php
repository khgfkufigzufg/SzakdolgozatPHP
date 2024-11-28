<?php

class Telepules{
    
    private $tid;
    private $irsz;
    private $telepulesNev;
    
    public function setTelepules($irsz, $telepulesNev){
        $this->irsz = $irsz;
        $this->telepulesNev = $telepulesNev;
    }
    
    public function addTelepules($Db){
        $sql = "INSERT INTO `telepules` (`tid`, `irsz`, `telepulesNev`) VALUES (NULL, '".$this->irsz."', '".$this->telepulesNev."');";
        $this->tid = $Db->insertSQL($sql);
    }
    
    public function delTelepules($Db, $tid){
        $sql = "DELETE FROM `telepules` WHERE tid =".$tid;
        return $result = $Db->execSQL($sql);
    }
    
    public function getTelepules($tid, $Db) {
        $this->getTelepulesFromDB($tid, $Db);
        return $this->telepulesNev;
    }
    
    private function getTelepulesFromDB($tid, $Db) {
        
        $sql = "SELECT * FROM telepules WHERE tid = ".$tid;
        $result = $Db->execSQL($sql);
        
        if($row = $result->fetch_assoc()) {
            $this->tid = $row['tid'];
            $this->irsz = $row['irsz'];
            $this->telepulesNev = $row['telepulesNev'];
        }
    }
    
    public function telepulesLista($Db, $type=NULL){//form/legördülő
        $sql = "SELECT * FROM telepules";
        $result = $Db->execSQL($sql);
        
        if(is_null($type)){
            while($row = $result->fetch_assoc()){
                echo'<option value="'.$row["tid"].'" class="option">'.$row["telepulesNev"].'</option>';
            }
        }
        else{
            while($row = $result->fetch_assoc()){
                echo '<div class="modositok"><span id="szeles">'.$row["telepulesNev"].' - '.$row["irsz"].'</span>';
                echo '<a href="index.php?action=telepules&delID='.$row['tid'].'"><input type="button" name="deltelep" value="Töröl"></a></div>';
            }
            
        }
        
    }
    
}
$lista = new Telepules();

?>