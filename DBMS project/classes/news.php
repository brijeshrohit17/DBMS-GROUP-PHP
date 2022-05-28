<?php

class News{
    private $error;
    public function create_post($id,$data){
        if(!empty($data['news'])){
            $news = $data['news'];
            $tag_info = $this->get_tag_id($id);
            $tag_id = $tag_info['TAG_ID'];
            $query = "INSERT INTO news (CONTENT,USER_ID,TAG_ID) values ('$news','$id','$tag_id')";
            $DB = new DataBase();
            $DB->save($query);
        }
        else{
           $this->error="error" ;      
        }
        return $this->error;
    }
    public function get_posts($id){
        $query= "SELECT * FROM news WHERE USER_ID='$id' ORDER BY PUBLISH_DATE DESC";
        $DB = new DataBase();
        $result=$DB->read($query);
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }
    public function get_tag_id($id){
        $query = "SELECT * FROM tag WHERE PUBLISHER_ID = (SELECT PUBLISHER_ID FROM publisher WHERE USER_ID = '$id')";
        $DB = new DataBase();
        $result=$DB->read($query);
        return $result[0];
    }
    public function follow_tag($id,$userid){
        $sql = "SELECT * FROM follow WHERE TAG_ID='$id' && USER_ID='$userid'";
        $DB = new DataBase();
        $result = $DB->read($sql);
        if(!$result){
            $sql = "UPDATE tag SET FOLLOWERS = FOLLOWERS + 1 WHERE TAG_ID = '$id' LIMIT 1";
            $DB = new DataBase();
            $DB->save($sql);
            $sql = "INSERT INTO follow (TAG_ID,USER_ID) VALUES ('$id','$userid')";
            $DB = new DataBase();
            $DB->save($sql);
        }
    }
    public function unfollow_tag($id,$userid){
            $sql = "UPDATE tag SET FOLLOWERS = FOLLOWERS - 1 WHERE TAG_ID = '$id' LIMIT 1";
            $DB = new DataBase();
            $DB->save($sql);
            $sql = "DELETE FROM follow WHERE TAG_ID='$id' && USER_ID='$userid'";
            $DB = new DataBase();
            $DB->save($sql);
    }
    public function isFollower($id){
        $sql = "SELECT * FROM follow WHERE USER_ID='$id' LIMIT 1";
        $DB = new DataBase();
        $result = $DB->read($sql);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }
    public function isTagFollowed($id,$user_id){
        $sql = "SELECT * FROM follow WHERE USER_ID='$user_id' AND TAG_ID='$id'";
        $DB = new DataBase();
        $result = $DB->read($sql);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }
}