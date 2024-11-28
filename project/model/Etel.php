<?php

class Etel{
    
    private $eid;
    private $etelNev;
    private $tomeg;
    private $pic;
    
    public function setEtel($etelNev, $tomeg){
        $this->etelNev = $etelNev;
        $this->tomeg = $tomeg;
    }
    
    public function addEtel($Db){
        $sql = "INSERT INTO `etel` (`eid`, `etelNev`, `tomeg`) VALUES (NULL, '".$this->etelNev."', '".$this->tomeg."');";
        $this->eid = $Db->insertSQL($sql);
    }
    
    public function delEtel($Db, $eid){
        $sql = "DELETE FROM `etel` WHERE eid =".$eid;
        return $result = $Db->execSQL($sql);
    }
    
    public function updEtel($Db, $eid){
        $sql = "UPDATE etel SET etelNev ='".$this->etelNev."', tomeg ='".$this->tomeg."' WHERE eid=".$eid;
        $res = $Db->execSQL($sql);
    }
    
    public function getEtel($eid, $Db) {
        $this->getEtelFromDB($eid, $Db);
        
        return array("eid"=>$this->eid, "etelNev"=>$this->etelNev, "tomeg"=>$this->tomeg, "pic" => $this->pic);
    }
    
    private function getEtelFromDB($eid, $Db) {
        
        $sql = "SELECT * FROM etel WHERE eid = ".$eid;
        $result = $Db->execSQL($sql);
        
        if($result) {
            $row = $result->fetch_assoc();  
            $this->eid = $row['eid'];
            $this->etelNev = $row['etelNev'];
            $this->tomeg = $row['tomeg'];
            $this->pic = $this->getPic($this->eid);
        }
    }
    
    public function getPic($eid, $style=NULL){
            
        if($style == 'adminkep'){
            $img = 'nincs kép';
        }
        else{
            $img = '<br>';
        }
            // van profilképe?
            if(file_exists('img/info/'.$eid.'.jpg')) {
                $img = '<img src="img/info/'.$eid.'.jpg" class="'.$style.'">';
            }
            return $img;
    }
    
    public function etelLista($Db, $type, $selected = NULL, $eid=NULL){ //Etelek kilistázása lekördülő/formok
        $sql = "SELECT * FROM etel";
        $result = $Db->execSQL($sql);
        
        if($type=='list'){ //legördülő
            if(is_null($selected)){
                while($row = $result->fetch_assoc()){
                    echo '<option value="'.$row["eid"].'">'.$row["etelNev"].'</option>';
                }
            }
            else{
                while($row = $result->fetch_assoc()){
                    if($row["eid"] != $selected){
                        echo '<option value="'.$row["eid"].'">'.$row["etelNev"].'</option>';
                    }
                    else{
                        echo '<option value="'.$row["eid"].'" selected>'.$row["etelNev"].'</option>';
                    }
                }
            }
        }
        else{//formok
            while($row = $result->fetch_assoc()){
                echo '<form enctype="multipart/form-data" method ="post" action="index.php?action=etelCRUD&updID='.$row["eid"].'" class="modositok" id="center">Megnevezés:<input type="text" name="etelNev'.$row["eid"].'" value="'.$row["etelNev"].'">';
                echo 'Nettó tömeg:<input type="number" name="tomeg'.$row['eid'].'" value="'.$row["tomeg"].'">';
                if($type=='kepes'){
                    echo '<br>'.$this->getPic($row['eid'], 'adminkep').' <input type="file" id="info'.$row["eid"].'" name="info'.$row["eid"].'">';
                }
                echo '<a href="index.php?action=etelCRUD&delID='.$row["eid"].'"><input type="button" name="del" value="Töröl"></a>';
                echo '<input type="submit" name="mod" value="Módosít">';
                echo '</form><hr>';
            }
        }  
    }    
}

$kiETEL = new Etel();

?>