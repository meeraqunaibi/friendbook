<?php
require 'myDB.php';
$db = new MyDB();
$conn = $db->connect();
$date = date("y-m-d");
$content = "";
$id = "";
$content = isset($_POST['content']) ? $_POST['content'] : '';
$id = !empty($_POST['id']) ? $_POST['id'] : '';
$query = "UPDATE post SET content='$content', datePost='$date' where idPost=$id";
$result = $conn->query($query);

if($result)
{
    echo 'post updated';
    header('location:profile.php');
}
else{
    echo mysqli_error($conn);
}
?>