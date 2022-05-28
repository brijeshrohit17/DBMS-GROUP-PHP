<?php


class User{
    public function get_data($uname){

        $query = "SELECT * FROM USERS WHERE USER_NAME='$uname' LIMIT 1";
        $DB =new DataBase();
        $result  = $DB->read($query);
        if($result){
            $row=$result[0];
            return $row;
        }
        else{
            return false;
        }
    }
    public function get_user($id){
        $query="SELECT * FROM users WHERE USER_ID = '$id'";
        $DB =new DataBase();
        $result  = $DB->read($query);
        if($result){
            return $result[0];
        }
        else{
            return false;
        }
    }
    public function get_publisher($id){
        $query="SELECT * FROM publisher WHERE USER_ID = '$id'";
        $DB =new DataBase();
        $result  = $DB->read($query);
        if($result){
            return $result[0];
        }
        else{
            return false;
        }
    }
    public function isPublisher($uname){
        $query="SELECT * FROM publisher WHERE LOGIN_ID = '$uname'";
        $DB =new DataBase();
        $result  = $DB->read($query);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }
}