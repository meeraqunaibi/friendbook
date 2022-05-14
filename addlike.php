<?php
require 'myDB.php';
$db = new MyDB();
$conn = $db->connect();
$postId = $_GET['id'];
$userId = 1;
$query = "select * from post where id=$postId ";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$numOfLikes = $row['numOfLikes'];

if(isset($_GET['liked'])){
    $updated = $numOfLikes + 1;
    $query = "UPDATE post SET numOfLikes=$updated where id=$postId ";
    $result = $conn->query($query);
    $query = "INSERT INTO likes VALUES($userId, $postId)";
    $result = $conn->query($query);
    echo $updated;
    unset($_GET['liked']);
    exit();
}

if(isset($_GET['unliked'])){
    $updated = $numOfLikes - 1;
    $query = "UPDATE post SET numOfLikes=$updated where id=$postId ";
    $result = $conn->query($query);
    $query = "DELETE FROM likes WHERE user_id = $userId && post_id = $postId";
    $result = $conn->query($query);
    echo $updated;
    unset($_GET['unliked']);
    exit();
}

?>