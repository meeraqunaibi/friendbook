<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assests/style/home.css">
    <link rel="stylesheet" href="./assests/style/AuthStyle.css">
    <title>Document</title>
</head>
<body>
</body>
</html>
<?php
// include ('Security.php');

$idUser = $_SESSION['idUser'] ;
require_once "DBcon.php";

$query = " SELECT * FROM advertisement ";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

echo'<div class="live-chat">' . "<br><br><h3 class='advert'>Advertisements</h3><br>";

foreach($result as $row)
{
    echo '<a href="#" style="text-decoration: none; color:rgb(227, 135, 187) "> '.$row['content'] .'</a><br>' ;
    // echo '<p> <a href="#"> '.$row['content'] .'<a> </p>' ;
}

echo'</div>';

?>

