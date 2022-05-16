<?php

session_start();
require_once "DBconf.php";


$email = $password = "";
$email_err = $password_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    //Validate Email : 

    if(empty(trim($_POST["email"]))){
        $_SESSION['email_err'] = $email_err = " This field can't be empty , Please enter an email.";
        header("location: login_form.php");
        exit();
    }else{
        $sql = "SELECT idUser FROM user WHERE email = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            $param_email = trim($_POST["email"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email = trim($_POST["email"]);
                } else{
                    $email_err= $_SESSION["email_err"] = "This email does not have an account , try signing up instead !";
                    header("location: login_form.php");
                    exit();

                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    

    // Validate password
    if(empty(trim($_POST["password"]))){
        $_SESSION['password_err'] = $password_err = "Please enter a password.";    
        header("location: login_form.php");
        exit();
    }else{
        $password = trim($_POST["password"]);
        echo $password;
    }


    //////////////////////////////////////////////////////////////////////////////////////
    // Validations :
    if(empty($email_err) && empty($password_err)){
        echo "(1 !)";
        $sql = "SELECT idUser, email, password FROM user WHERE email = ?";
        echo "( 2 !)";

        if($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            echo "( 3 !)";
            $param_email = $email;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                echo "( 4 !)";
                if(mysqli_stmt_num_rows($stmt) == 1){          
                    echo "(5 !)";          
                    mysqli_stmt_bind_result($stmt, $idUser, $email, $password);
                    if(mysqli_stmt_fetch($stmt)){
                        echo "(6 !)";
                        if($password){
                        // if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            echo "(7 !)";
                            $_SESSION["loggedin"] = true;
                            $_SESSION["idUser"] = $idUser;
                            $_SESSION["email"] = $email;       
                            

                            $query = "Select * from user where idUser = $idUser";
                            $result = mysqli_query($con, $query);
                            $row = mysqli_fetch_array($result);

                            $_SESSION["userType"] =  $row['typeOfUser'] ;

                            if($_SESSION["userType"]  == 1)
                            {
                                header('Location: index.php');
                            }
                            else if($_SESSION["userType"] == 2 )
                            {
                                header('Location: Admin.php');
                            }
                            
                            

                        } else{
                            $login_err= $_SESSION["login_err"] = "Invalid email or password.";
                            echo "(8 !)";
                            header ("location : login_form.php");
                            exit();
                        }
                    }
                } else{
                    $login_err = $_SESSION["login_err"]= "Invalid email or password.";
                    header ("location : login_form.php");
                    exit();
                    echo "(9 !)";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($con);

        
    
}
        
?>