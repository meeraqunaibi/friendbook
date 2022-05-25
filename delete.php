<?php
require 'myDB.php';
$db = new MyDB();
$conn = $db->connect();
$postId = $_GET['id'];
$query = "delete from post where idPost = $postId";
$result = mysqli_query($conn, $query);

if($result)
{
    echo 'deleted succesfully';
    header('location:profile.php');
}
else{
    echo mysqli_error($conn);
}
?>