<?php
require 'myDB.php';
$db = new MyDB();
$conn = $db->connect();
$commentContent =  $_POST['commentContent'];
$postId = $_GET['id'];
$userid = 1;
$data = date("y-m-d");
$query = "INSERT INTO comment (userid, postId, commentContent, datePosted) VALUES ($userid, $postId, '$commentContent', '$data')";
$result = mysqli_query($conn, $query);

if($result)
{
    echo 'comment added';
    header('location:home.php');
}
else{
    echo mysqli_error($conn);
}
?>