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
                where idUser = $id";
        $conn = $this->connect();
        $result = $conn->query($query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function getUsers($id){
        $query = "select u.firstName, u.lastName, u.gender, u.idUser
                from (select idUser, idFriend from friendship where idUser!=$id && idUser not in (select idFriend from friendship where idUser=$id)) as f, user u 
                where u.idUser=f.idUser";
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
                where f.idUser=$id && u.idUser=f.idFriend";
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
        $query = "select p.idPost, firstName, lastName, content, datePost, numOfLikes
                from post p, user u
                where u.idUser = p.idUser
                order by datePost desc";
        $conn = $this->connect();
        $result = $conn->query($query);
        $rows = array();
        while($row = $result-> fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }
    public function getMyPosts($id){
        $query = "select p.idPost , firstName, lastName, content, datePost, numOfLikes
                from post p, user u
                where u.idUser = p.idUser and u.idUser=$id
                order by datePost desc";
        $conn = $this->connect();
        $result = $conn->query($query);
        $rows = array();
        while($row = $result-> fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function getComment($id){
        $query = "select c.content, u.firstName, u.lastName, u.gender
        from comment c, user u
        where u.idUser=c.idUser and c.idPost=$id";
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