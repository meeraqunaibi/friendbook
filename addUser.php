<?php
require 'myDB.php';
include ('Security.php');
$db = new MyDB();
$conn = $db->connect();
$friendId = $_GET['id'];
$userid =  $_SESSION['idUser'];
$data = date("y-m-d");
$query = "INSERT INTO friendship VALUES ($userid, $friendId, '$data'), ($friendId, $userid, '$data')";
$result = mysqli_query($conn, $query);

if($result)
{
    echo 'user added';
    header('location:home.php');
}
else{
    echo mysqli_error($conn);
}
?>