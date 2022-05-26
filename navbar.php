<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assests/style/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ee4d50fc89.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<div class="navbar">
        <div class="logo">
            <img src="./assests/images/infinity-logo1.jpg" width="100px" height="45px">
            <span class="logo-name">Friendbook</span>
        </div>
        <div class="icons">
            <a href="home.php"><i class="fa fa-home"></i></a>
            <i class="fa fa-user"></i>
            <i class="fa fa-bell"></i>
                <?php
                require "logout_form.php";
                    $id = $_SESSION['idUser'];
                    $db = new MyDB();
                    $user = $db->getUserInfo($id);
                    if($user['gender']=='male'){
                        echo '<img class="prof-img" src="./assests/images/male.png">';
                    }
                    else{
                        echo '<img class="prof-img" src="./assests/images/female.png">';
                    }
                    echo "<a href='profile.php'><h6 class='username'>" . $user['firstName'] ." ". $user['lastName'] . "</h6></a>";
                ?>
            
        </div>
    </div>
</body>
</html>