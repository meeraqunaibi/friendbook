<?php
require 'myDB.php';
$db = new MyDB();
$conn = $db->connect();
$content =  $_POST['content'];
$userid = 1;
$data = date("y-m-d");
echo $data. "  ";
$query = "INSERT INTO post (userid, content, date) VALUES ($userid, '$content', '$data')";
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