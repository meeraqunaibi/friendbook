<?php
require 'myDB.php';
$db = new MyDB();
$conn = $db->connect();
$content =  $_POST['content'];
$userid = 1;
$date = date("y-m-d");
$query = "INSERT INTO post (content, datePost, idUser) VALUES ('$content', '$date', $userid)";
$result = mysqli_query($conn, $query);

if($result)
{
    echo 'post added';
    header('location:home.php');
}
else{
    echo mysqli_error($conn);
}
?>