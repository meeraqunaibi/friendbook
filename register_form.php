<?php
require "register.php";
require_once "dbCon.php";
// require_once "DBconf.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <!-- <link rel="stylesheet" type="text/css" href="Styles/AuthStyle.css"> -->
    <link rel="stylesheet" href="./assests/style/AuthStyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
        span{width:200px; height: 100px; }
    </style>
</head>
<body>
    <center>
        <div class="wrapper">
            <h2>Sign Up</h2>
            <p>Please fill the form to create an account.</p>
            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" class="form-control " value="<?php echo $firstName; ?>">
                    <span class="validationSpan"><?php echo isset($_SESSION['firstName_err']) ? $_SESSION['firstName_err'] : '' ?></span>
                    <span class="error"><?php echo $firstName_err;?></span>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" class="form-control " value="<?php echo $lastName; ?>">
                    <span class="validationSpan"><?php echo isset($_SESSION['lastName_err']) ? $_SESSION['lastName_err'] : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                    <span class="validationSpan"><?php echo isset($_SESSION['email_err']) ? $_SESSION['email_err'] : '' ?></span>
                </div> 
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <span class="validationSpan"><?php echo isset($_SESSION['password_err']) ? $_SESSION['password_err'] : ''  ?></span>
                </div>
                <div class="form-group">
                    <label >Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control " value="<?php echo $confirm_password; ?>">
                    <span class="validationSpan"><?php echo isset($_SESSION['confirm_password_err']) ? $_SESSION['confirm_password_err'] : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="teleNo">Phone Number</label>
                    <input type="tel" name="teleNo" class="form-control " value="<?php echo $teleNo; ?>">
                    <span class="validationSpan"><?php echo isset($_SESSION['teleNo_err']) ? $_SESSION['teleNo_err'] : ''  ?></span>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control " value="<?php echo $address; ?>">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" class="form-control " value="<?php echo $gender; ?>">
                        <option value="none" selected disabled hidden>Select an Option</option>
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" id="signButton" value="Submit" name = "submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                <p>Already have an account? <a class="linkToOtherPage" href="login_form.php">Login here</a>.</p>
            </form>
        </div>
    </center>    
</body>
</html>