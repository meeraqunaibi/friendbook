<?php 
$servername = "localhost"; 
$username= "friendbook-user"; 
$password= "F2022!!!"; 
$databaes= "friendship"; 

$con = mysqli_connect($servername , $username , $password , $databaes); 

if(!$con){
    die(" there is no connection with db " . mysql_connect_error($con)); 
}


        // define('user', 'root');
        // define('pass', 'root');
        // define('db', 'php');

        // $con=mysqli_connect('localhost',user, pass, db) or die("can not connect". mysqli_connect_error());

?>