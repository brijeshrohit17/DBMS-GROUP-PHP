<?php

class Login{

    private $error = "";
    public function evaluate($data){
        $USER_NAME = $data['username'];
        $PASSWORD = $data['password'];
        $query = "SELECT * FROM USERS WHERE USER_NAME='$USER_NAME' AND PASSWORD='$PASSWORD' LIMIT 1";
        
        $DB = new DataBase();
        $result = $DB->read($query);

        if($result){
            $row=$result[0];
            $_SESSION['USER_NAME']=$row['USER_NAME'];
            $_SESSION['USER_ID']=$row['USER_ID'];
        }
        else{
            $this->error = "1";
        }
        return $this->error;
    }
    public function check_login($uname){
        $query = "SELECT USER_NAME FROM USERS WHERE USER_NAME='$uname' LIMIT 1";
        
        $DB = new DataBase();
        $result = $DB->read($query);

        if($result){
            return true;
        }
        return false;
    }
}