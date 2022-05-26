<?php

require_once "dbCon.php";
include ('Security.php');

$idUser = $_SESSION['idUser'] ;

$content =""; 

if($_SERVER["REQUEST_METHOD"] == "POST"){


if(!empty(trim($_POST["content"]))){
    $content = trim($_POST["content"]);
    echo $content;
}

$sql = "INSERT INTO advertisement (content,idUser) VALUES (?,?)";
            
            if($stmt = mysqli_prepare($con, $sql)){
                mysqli_stmt_bind_param($stmt, "ss",$param_content,$param_idUser);
                
                $param_content = $content;
                $param_idUser = $idUser;

                
                if(mysqli_stmt_execute($stmt)){
                    echo "added succesfully";
                    header("location: Admin.php");
                }else{
                    echo "Oops! Something went wrong. Please try again later.";
                    header("location: Admin.php");
                }

                mysqli_stmt_close($stmt);
            }
        }
       
        mysqli_close($con);
?>