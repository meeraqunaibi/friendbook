<?php
include ('Security.php');
require 'myDB.php';
$db = new MyDB();
$conn = $db->connect();
$commentContent =  $_POST['commentContent'];
$postId = $_GET['id'];
$userid =  $_SESSION['idUser'];
$data = date("y-m-d");
$query = "INSERT INTO comment (content, dateComment,idUser, idPost) VALUES ('$commentContent', '$data', $userid, $postId)";
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