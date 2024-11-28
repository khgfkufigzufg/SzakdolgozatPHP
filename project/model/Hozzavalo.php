<?php
class Hozzavalo{
    
    private $hid;
    private $megys;
    private $hnev;
    private $allergen;
    
    public function setHozzavalo($megys, $hnev, $allergen){
        $this->megys = $megys;
        $this->hnev = $hnev;
        $this->allergen = $allergen;
    }
    
    public function addHozzavalo($Db){
        $sql = "INSERT INTO `hozzavalo` (`megys`, `hnev`, `allergen`) VALUES ('".$this->megys."', '".$this->hnev."', '".$this->allergen."');";
        $this->hid = $Db->insertSQL($sql);
    }
    
    public function delHozzavalo($Db, $hid){
        $sql = "DELETE FROM `hozzavalo` WHERE hid =".$hid;
        return $result = $Db->execSQL($sql);
    }
    
    public function getHozzavalo($hid, $Db) {
        $this->getHozzavaloFromDB($hid, $Db);
        return $this->hnev;
    }
    
    private function getHozzavaloFromDB($hid, $Db) {
        
        $sql = "SELECT * FROM hozzavalo WHERE hid = ".$hid;
        $result = $Db->execSQL($sql);
        
        if($row = $result->fetch_assoc()) {
            $this->hid = $row['hid'];
            $this->megys = $row['megys'];
            $this->hnev = $row['hnev'];
            $this->allergen = $row['allergen'];
        }
    }
    
    public function hlista($Db, $type, $eid=NULL){//hozzávaló lista az ételhez gomb aktív, ha van kiválasztott étel
        $sql = "SELECT * FROM hozzavalo";
        $result = $Db->execSQL($sql);
        if($type=='list'){
            while($row = $result->fetch_assoc()){
                echo'<option value="'.$row["hid"].'">'.$row["hnev"].' ('.$row["megys"].')</option>';
            }
        }
        else{
            while($row = $result->fetch_assoc()){
                echo '<form method ="post" action="index.php?action=updHozz&updID='.$row["hid"].'" class="modositok">Megnevezés:<input type="text" name="hnev'.$row["hid"].'" value="'.$row["hnev"].'">';
                echo 'Mértékegység:<input type="text" name="megys'.$row['hid'].'" class="megys" value="'.$row["megys"].'">';
                echo '<label for="allergen'.$row["hid"].'">Allergén:</label>';
                if($row['allergen']==1){
                    echo '<input type="checkbox" id="allergen'.$row["hid"].'" name="allergen'.$row["hid"].'" checked>';
                }
                else{
                    echo '<input type="checkbox" id="allergen'.$row["hid"].'" name="allergen'.$row["hid"].'">';
                }
                echo '<a href="index.php?action=delhozz&delID='.$row["hid"].'"><input type="button" name="del" value="Töröl"></a>';
                echo '<input type="submit" name="mod" value="Módosít">';
                
                
                echo '<a href="index.php?action=etelhozzr&eid='.$eid.'&hid='.$row["hid"].'"><button type="button" name="eh" ';
                if(is_null($eid)){
                    echo 'disabled>Ételhez</button></a>';
                }
                else{
                    echo '>Ételhez</button></a>';
                }
                
                
                echo '</form>';
            }
        }
    }
    
    public function updHozzavalo($hid, $Db){
        $sql = "UPDATE hozzavalo SET megys='".$this->megys."', hnev='".$this->hnev."', allergen='".$this->allergen."' WHERE hid=".$hid;
        $Db->execSQL($sql);
    }
    
    
}
$kiHOZZ = new Hozzavalo();



?>