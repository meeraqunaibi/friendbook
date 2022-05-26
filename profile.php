<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assests/style/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 
    <title>Document</title>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
</head>
<body>
<?php
require "myDB.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include ('Security.php');
require "navbar.php";
echo "<div class='content'>";
require "liveChat.php";
echo "<div class='posts'>";
$db = new MyDB();
$id =  $_SESSION['idUser'];
$posts = $db->getMyPosts($id);
foreach ($posts as $row){
    echo "<div class='post'>";
    echo "<div class='post-owner'>";
    echo "<img class='prof-img' src='./assests/images/flower.jpg'>";
    echo "<div>";
    echo "<h6 class='username1'>" . $row['firstName']. " " . $row['lastName'] . "</h6>";
    echo "<p >" . $row['datePost'] . "</p>";
    echo "</div>";
    echo "<div class='dropdown show'>
            <a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'></a>
            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
              <button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#exampleModalCenter'>Edit</button>
              <a class='dropdown-item' href='delete.php?id=" . $row['idPost'] . "'>Delete</a>
            </div>
          </div>
          <!-- Modal -->
          <div class='modal fade' id='exampleModalCenter' tab-index='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalCenterTitle'>Update Post</h5>
                  <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
                <div class='modal-body'>
                  <form method='post' action='updatePost.php'>
                    <div class='mb-3'>
                      <label for='postContent' class='form-label'>Post Content</label>
                      <input type='text' class='form-control' id='postContent' name='content' aria-describedby='emailHelp'>
                    </div>
                    <input type='hidden' name='id' value='" . $row['idPost'] . "'>
                    <input type='submit' class='btn btn-primary'>
                  </form>
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                </div>
              </div>
          </div>
        </div>
          ";
    echo "</div>";
    echo "<p class='post-content'>" . $row['content'] . "</p><br/>";
    echo '<hr>';
    echo '<div class="interactions">';
    echo '<button onclick="loadXMLDoc(' . $row['idPost'] . "," . $row['numOfLikes'] . ')"><i class="fa fa-thumbs-up fa-lg"></i></button>';
    echo '<p id="likes">' . $row['numOfLikes'] .'</p> &nbsp like';
    echo '<i class="fa fa-comments fa-lg"></i>';
    echo '<p>comments</p>';
    echo '</div>';
    $comments = $db->getComment($row['idPost']);
    echo '<div class="comments">';
    foreach ($comments as $rowc){           
    echo '<div class="comment">';
    echo '<img class="prof-img" src="./assests/images/flower.jpg">';
    echo '<div class="comment-content">';
    echo '<h6 class="username1">' . $rowc['firstName']. " " . $rowc['lastName'] . '</h6>';
    echo '<p class="comment-text">'. $rowc['content'] .'</p>';
    echo '</div>';
    echo '</div>';
    }
    echo '</div>';
    echo '<form method="post" action="addComment.php?id='. $row['idPost'] .'">';
    echo '<textarea name="commentContent" class="new-comment-text" placeholder="Enter your comment ....."></textarea>';
    echo '<input type="submit" class="add-photo">';
    echo '</form>';
    echo '</div>';
}
echo '</div>';
require "myFriends.php";
echo "</div>";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
