<?php

class Tags{
    public function get_name($id){
        $query="SELECT * FROM tag WHERE PUBLISHER_ID = '$id'";
        $DB =new DataBase();
        $result  = $DB->read($query);
        if($result){
            return $result[0];
        }
        else{
            return false;
        }
    }
}