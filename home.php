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
    <title>friendbook</title>
    <script src="https://kit.fontawesome.com/ee4d50fc89.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type='text/javascript'>
        $(document).ready(function(){
            $('.like').click(function(){
                var $this = $(this);
                let postId = $(this).attr('id');
                $.ajax({
                    url:'addlike.php',
                    type: 'get',
                    async: true,
                    data:{
                        'liked':1,
                        'id':postId
                    },
                    dataType: "text",
                    success:function(msg){
                        $this.addClass('unlike');
                        $('.unlike').removeClass('like');
                        $('#likes').text(msg);

                        window.location.reload();
                    }
                })
            });

            $('.unlike').click(function(){
                var $this = $(this);
                let postId = $(this).attr('id');
                $.ajax({
                    url:'addlike.php',
                    type: 'get',
                    async: true,
                    data:{
                        'unliked':1,
                        'id':postId
                    },
                    dataType: "text",
                    success:function(msg){
                        $this.addClass('like');
                        $('.like').removeClass('unlike');
                        $('#likes').text(msg);
                        window.location.reload();
                    }
                })
            });
        });

    </script>
</head>
<body>
    <?php
    require "myDB.php";
    require "navbar.php";
    ?>
    <div class="content">
        <?php 
        require "liveChat.php"
        ?>
        <div class="posts">
            <div class="new-post">
                <span class="create-post">Create Post</span>
                <hr>
                <form method="post" action="addPost.php"> 
                    <div class="post-text">
                        <img class="prof-img" src="./assests/images/flower.jpg">
                        <textarea name="content" class="new-post-text" placeholder="write something here ....."></textarea>
                    </div>
                    <div class="addButtons">
                        <button class="add-photo"><i class="fa fa-file-image  fa-2x"></i>&nbsp&nbsp&nbsp<span>add photo</span> </button>
                        <input type="submit" class="add-photo">
                    </div>
                </form>
            </div>
            <?php
            $db = new MyDB();
            $posts = $db->getPosts();
            $userid = 1;//will deleted
            foreach ($posts as $row){
                echo "<div class='post'>";
                echo "<div class='post-owner'>";//post owner
                echo "<img class='prof-img' src='./assests/images/flower.jpg'>";
                echo "<div>";
                echo "<h6 class='username1'>" . $row['firstName']. " " . $row['lastName'] . "</h6>";
                echo "<p >" . $row['date'] . "</p>";
                echo "</div>";
                echo "</div>";//post owner
                echo "<p class='post-content'>" . $row['content'] . "</p><br/>";
                echo '<hr>';
                echo '<div class="interactions">';
                $isLiked = $db->isLiked($userid, $row['id']);
                if($isLiked){
                    echo '<i id="' . $row['id'] . '"class="fa fa-thumbs-up fa-lg unlike " ></i>';
                }
                else{
                    echo '<i id="' . $row['id'] . '" class="fa fa-thumbs-up fa-lg like " ></i>';
                }
                echo '<p id="likes">' . $row['numOfLikes'] .'</p> &nbsp like';
                echo '<i class="fa fa-comments fa-lg"></i>';
                echo '<p>comments</p>';
                echo '</div>';
                $comments = $db->getComment($row['id']);
                echo '<div class="comments">';
                foreach ($comments as $rowc){         
                echo '<div class="comment">';
                echo '<img class="prof-img" src="./assests/images/flower.jpg">';
                echo '<div class="comment-content">';
                echo '<h6 class="username1">Meera Qunaibe</h6>';
                echo '<p class="comment-text">'. $rowc['commentContent'] .'</p>';
                echo '</div>';
                echo '</div>';
                }
                echo '</div>';
                echo '<form method="post" action="addComment.php?id='. $row['id'] .'">';
                echo '<textarea name="commentContent" class="new-comment-text" placeholder="Enter your comment ....."></textarea>';
                echo '<input type="submit" class="add-photo">';
                echo '</form>';
                echo '</div>';
            }
        echo '</div>';
        require "users.php";
        ?>
    </div>
</body>
</html>