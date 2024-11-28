<?php

class User{
    
    private $userId;
    private $unev;
    private $tel;
    private $tid;
    private $utca_hsz;
    private $email;
    private $jeszo;
    private $admin;
    
    public function setUser($unev, $tel, $tid, $utca_hsz, $email, $jeszo){
        $this->unev = $unev;
        $this->tel = $tel;
        $this->tid = $tid;
        $this->utca_hsz = $utca_hsz;
        $this->email = $email;
        $this->jelszo = md5($jeszo);
    }
    
    public function addUser($Db){
        $s = TRUE;
        $foglalt = "SELECT * FROM user WHERE email LIKE '".$this->email."'";
        $result = $Db->execSQL($foglalt);
        
        if($result->num_rows>0){
            $s = FALSE;
        }
        else{
            $sql = "INSERT INTO `user` (`userId`, `unev`, `tel`, `tid`, `utca_hsz`, `email`, `jelszo`) VALUES (NULL, '".$this->unev."', '".$this->tel."', '".$this->tid."', '".$this->utca_hsz."', '".$this->email."', '".$this->jelszo."');";
            $this->userId = $Db->insertSQL($sql);
            $s = TRUE;
        }
        return $s;
    }
    
    public function getUserInfo(){
        return array("ID" => $this->userId, "EMAIL"=>$this->email, "tel" => $this->tel, "tid" => $this->tid, "utca_hsz" => $this->utca_hsz, "unev" => $this->unev);
    }
    
    public function deleteUser($Db) {
        if($this->userId) {
            $sql = "DELETE FROM user WHERE userId = ".$this->userId;
            return $result = $Db->execSQL($sql);
        }
    }
    
    public function updateUser($Db){
        $sql = "UPDATE `user` SET `unev` = '".$this->unev."', `tel` = '".$this->tel."' `tid` = '".$this->tid."' `utca_hsz` = '".$this->utca_hsz."', `email` = '".$this->email."'  WHERE `user`.`userId` = ".$this->userId;
    }
    public function updateJelszo($Db, $ujjelszo){
        $sql = "UPDATE `user` SET  `jelszo` = '".md5($ujjelszo)."'  WHERE `user`.`userId` = ".$this->userId;
    }
    
    public function getUser($userId, $Db) {
        $this->getUserFromDB($userId, $Db);
        return array("unev" => $this->unev, "tel" => $this->tel, "tid" => $this->tid, "utca_hsz" => $this->utca_hsz );
    }
    
    private function getUserFromDB($userId, $Db) {
        
        $sql = "SELECT * FROM user WHERE userId = ".$userId;
        $result = $Db->execSQL($sql);
        if($result) {
            $row = $result->fetch_assoc();
            $this->userId = $row['userId'];
            $this->unev = $row['unev'];
            $this->tel = $row['tel'];
            $this->tid = $row['tid'];
            $this->utca_hsz = $row['utca_hsz'];
            $this->email = $row['email'];
            $this->jelszo = $row['jelszo'];
            $this->admin = $row['admin'];
        }
    }
    
    public function userLista($Db){
        //SELECT DISTINCT rendeles.userId, user.unev FROM rendeles INNER JOIN user ON rendeles.userId=user.userId
        
        $sql="SELECT * from user";
        $result = $Db->execSQL($sql);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $tomb[$row['userId']] = $row['unev'];
            }
            return $tomb;
        }
        else{
            return FALSE;
        }
    }
    
}
$User = new User();
?>