<?php
// Include config file
require_once "DBconf.php";
require "login.php";
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- <link rel="stylesheet" type="text/css" href="Styles/AuthStyle.css"> -->
    <link rel="stylesheet" href="./assests/style/AuthStyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <center>
        <div class="wrapper">
            <h2>Login</h2>
            <p>Please fill in your information to login.</p>

            <?php 
            if(!empty($login_err)){
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }        
            ?>

            <!-- <form action="login.php" method="post"> -->
            <form action="TestLogin.php" method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control " value="<?php echo $email; ?>">
                    <span class="validationSpan"><?php echo isset($_SESSION['email_err']) ? $_SESSION['email_err'] : '' ?></span>
                    <!-- <span class="invalid-feedback"><?php echo isset($_SESSION['email_err']) ? $_SESSION['email_err'] : '' ?></span> -->
                    <!-- <span class="invalid-feedback"><?php echo $_SESSION["email_err"]; ?></span> -->
                </div>    
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="validationSpan"><?php echo isset($_SESSION['password_err']) ? $_SESSION['password_err'] : ''  ?></span>
                    <!-- <span class="invalid-feedback"><?php echo $_SESSION["password_err"]; ?></span> -->
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" id="signButton" value="Login">
                </div>
                <p>Don't have an account? <a class="linkToOtherPage" href="register_form.php">Sign up now</a>.</p>
            </form>
        </div>
    </center>
</body>
</html>