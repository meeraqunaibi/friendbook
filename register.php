<?php
session_start();

// require_once "DBconf.php";
require "myDB.php";
// require "register_form.php";
    
    $password = $confirm_password =$firstName=$lastName=$teleNo=$address=$email=$gender=$image= "";
    $firstName_err=$lastName_err=$email_err =$teleNo_err=$password_err = $confirm_password_err = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Validations :
        // Validate email
        if(empty(trim($_POST["email"]))){
            $_SESSION['email_err'] = $email_err = " This field can't be empty , Please enter an email.";
            header("location: register_form.php");
            exit();
        // }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     $_SESSION['email_err'] = "Invalid email format";
        //     header("location: register_form.php");
        //     exit();
        }else{
            echo "hh";
            $sql = "SELECT idUser FROM user WHERE email = ?";
            
            if($stmt = mysqli_prepare($con, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                
                $param_email = trim($_POST["email"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $email_err= $_SESSION["email_err"] = "This email already has an account , try loging in instead !";
                        header("location: register_form.php");
                        exit();
                    } else{
                        $email = trim($_POST["email"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                mysqli_stmt_close($stmt);
            }
        }

         // Validate first name 
         if(empty(trim($_POST["firstName"]))){
            $_SESSION['firstName_err'] = $firstName_err = "Please enter a First Name."; 
            header("location: register_form.php");
            exit();    
        } elseif(strlen(trim($_POST["firstName"])) < 3){
            $_SESSION['firstName_err'] = $firstName_err= "First Name must be at least 3 characters length.";
            header("location: register_form.php");
            exit();
        } else{
            $firstName = trim($_POST["firstName"]);
            echo $firstName ;
        }
        // Validate Last Name :
        if(empty(trim($_POST["lastName"]))){
            $_SESSION['lastName_err'] = $lastName_err = "Please enter a Last Name.";    
            header("location: register_form.php");
            exit(); 
        } elseif(strlen(trim($_POST["lastName"])) < 3){
            $_SESSION['lastName_err'] = $lastName_err ="Last Name must be at least 3 characters length.";
            header("location: register_form.php");
            echo "hhhhhhhhhhhf";
            exit();
        } else{
            $lastName = trim($_POST["lastName"]);
            echo $lastName;
        }
        // Validate password
        if(empty(trim($_POST["password"]))){
            $_SESSION['password_err'] = $password_err = "Please enter a password.";    
            echo "hold on !!"; 
            header("location: register_form.php");
            exit();
        } elseif(strlen(trim($_POST["password"])) < 6){
            $_SESSION['password_err'] = $password_err = "Password must be at least 6 characters length.";
            header("location: register_form.php");
            exit();
        } else{
            $password = trim($_POST["password"]);
            echo $password;
        }
        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $_SESSION['confirm_password_err'] = $confirm_password_err = "Please confirm password.";
            echo "hold on !!";
            header("location: register_form.php");
            exit();
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(!isset($_SESSION['password_err']) && ($password != $confirm_password)){
                $_SESSION['confirm_password_err'] = $confirm_password_err= "Password did not match.";
            }
            echo $confirm_password;
        }
        // Validate phone Number 
        if(empty(trim($_POST["teleNo"]))){
            $_SESSION['teleNo_err'] = $teleNo_err = "Please enter a phone number.";  
            header("location: register_form.php");
            exit();   
        // } elseif(!preg_match('/^[0-9]+$/', trim($_POST["teleNo"])){
        //     $teleNo_err = "Phone number can not contain any type of characters except for numbers.";
        } else{
            $teleNo = trim($_POST["teleNo"]);
            echo $teleNo ;
        }

        //Did not use them because it's not necessary : 
        //validate address 
        if(empty(trim($_POST["address"]))){
            $address_err = "Please enter an address.";    
        } else{
            $address = trim($_POST["address"]);
            echo $address;
        }
        //validate gender  
        if(empty(trim($_POST["gender"]))){
            $gender_err = "Please enter your gender.";
        } else{
            $gender = trim($_POST["gender"]);
            echo $gender ;
        }



        if(empty($firstName_err) && empty($lastName_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($teleNo_err)){

            $sql = "INSERT INTO user (firstName,lastName,email,password,teleNo,address,gender) VALUES (?,?,?,?,?,?,?)";
            
            if($stmt = mysqli_prepare($con, $sql)){
                mysqli_stmt_bind_param($stmt, "sssssss",$param_firstName,$param_lastName, $param_email, $param_password,$param_teleNo,$param_address,$param_gender);
                
                $param_firstName = $firstName;
                $param_lastName = $lastName;
                $param_email = $email;
                $param_password = $password;
                // $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $param_teleNo = $teleNo;
                $param_address = $address;
                $param_gender = $gender;

                
                if(mysqli_stmt_execute($stmt)){
                    header("location: login_form.php");
                }else{
                    echo "Oops! Something went wrong. Please try again later.";
                    header("location: register_form.php");
                }

                mysqli_stmt_close($stmt);
            }
        }
       
        mysqli_close($con);
    }
?>