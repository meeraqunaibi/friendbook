<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assests/style/home.css">
    <title>Document</title>
</head>
<body>
    <?php
    include ('Security.php');
    $id =  $_SESSION['idUser'] ;
    $db = new MyDB();
    echo '<div class="users">';
    echo '<h4>My Friends</h4>';
    $users = $db->getMyFriends($id);
    foreach ($users as $user){
        echo "<div class='user'>";
        if($user['gender']=='male'){
            echo '<img class="prof-img" src="./assests/images/male.png">';
        }
        else{
            echo '<img class="prof-img" src="./assests/images/female.png">';
        }
        echo '<h6 class="username">' . $user['firstName'] . '&nbsp;' . $user['lastName'] . "</h6>";
        echo '</div>';
    }
    echo '</div>';
    ?>
</body>
</html>