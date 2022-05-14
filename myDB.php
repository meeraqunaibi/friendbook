<?php
class MyDB{
    private static $connection;
    public function connect(){
        if(!isset(self::$connecttion)){
            self::$connection = new mysqli("localhost", "friendbook-user", "F2022!!!", "friendship");
        }
        if(self::$connection == false){
            echo self::$connection->connect_error;
        }

        return self::$connection;
    }

    public function getUserInfo($id){
        $query = "select *
                from user
                where id = $id";
        $conn = $this->connect();
        $result = $conn->query($query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function getUsers($id){
        $query = "select u.firstName, u.lastName, u.gender, u.id
                from (select userid, friendid from friendship where userid!=$id && userid not in (select friendid from friendship where userid=$id)) as f, user u 
                where u.id=f.userid";
        $conn = $this->connect();
        $result = $conn->query($query);
        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }

    public function getMyFriends($id){
        $query = "select u.firstName, u.lastName, u.gender 
                from friendship f, user u
                where f.userid=$id && u.id=f.friendid";
        $conn = $this->connect();
        $result = $conn->query($query);
        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }

    public function isLiked($userid, $postid){
        $query = "select * from likes where user_id=$userid && post_id = $postid";
        $conn = $this->connect();
        $result = $conn->query($query);
        if(mysqli_num_rows($result) == 1){
            return true;
        }
        else{
            return false;
        }
        
    }


    public function getPosts(){
        $query = "select p.id, firstName, lastName, content, date, numOfLikes
                from post p, user u
                where u.id = p.userid
                order by date desc";
        $conn = $this->connect();
        $result = $conn->query($query);
        $rows = array();
        while($row = $result-> fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }
    public function getMyPosts($id){
        $query = "select p.id , firstName, lastName, content, date, numOfLikes
                from post p, user u
                where u.id = p.userid and u.id=$id
                order by date desc";
        $conn = $this->connect();
        $result = $conn->query($query);
        $rows = array();
        while($row = $result-> fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function getComment($id){
        $query = "select commentContent
        from comment
        where postId=$id";
        $conn = $this->connect();
        $result = $conn->query($query);
        $rows = array();
        while($row = $result-> fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }


}

?>