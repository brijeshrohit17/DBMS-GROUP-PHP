<?php

class Signup{ 

    public function userexist($data){
        $USER_NAME = $data['username'];
        $EMAIL = $data['mail'];
        $query = "SELECT * FROM USERS WHERE USER_NAME='$USER_NAME' LIMIT 1";
        
        $DB = new DataBase();
        $result = $DB->read($query);
        if($result){
            $row = $result[0];
            if($EMAIL == $row['EMAIL']){
                echo '<script type="text/javascript">',
		        'alert("Already a user, please Log in")',
		        '</script>';
            }
            else{
                echo '<script type="text/javascript">',
		        'alert("Username taken")',
		        '</script>';
            }
        }
        else{
            $this->create_user($data);
            header("Location: login.php");
        }

    }

    public function create_user($data){
        $USER_NAME = $data['username'];
        $EMAIL = $data['mail'];
        $PASSWORD = $data['password'];
        $query = "insert into users(USER_NAME, EMAIL, PASSWORD) values ('$USER_NAME','$EMAIL', '$PASSWORD')";
        
        $DB = new DataBase();
        $DB->save($query);
    }

}