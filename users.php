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
    $id = 1;
    $db = new MyDB();
    echo '<div class="users">';
    $users = $db->getUsers($id);
    foreach ($users as $user){
        echo "<div class='user'>";
        if($user['gender']=='male'){
            echo '<img class="prof-img" src="./assests/images/male.png">';
        }
        else{
            echo '<img class="prof-img" src="./assests/images/female.png">';
        }
        echo '<h6 class="username">' . $user['firstName'] . '&nbsp;' . $user['lastName'] . "</h6>";
        echo "<a href='addUser.php?id=". $user['id'] ."'><i class='fa fa-plus fa-lg'></i></div></a>";
    }
    echo '</div>';
    ?>
</body>
</html>