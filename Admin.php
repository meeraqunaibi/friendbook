<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="assests/Style/AuthStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Admin panel</title>
</head>
<body>
    <center>
        <header class="top">
<h1> Welcome to the Admin panle </h1>
<?php 

// require_once "DBconf.php";
include ('Security.php');
require_once "dbCon.php";

$idUser = $_SESSION['idUser'] ;
if(! $idUser){
    
}
   

    $query = "Select * from user where idUser = $idUser";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    echo "<h4> Hello Admin : " . $row['firstName'] . " ".$row['lastName']."</h4>";


?>

</header>
<form action = "Advert.php">
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Add a new Advertisment : </label>
    <textarea id = "advertTextArea" class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
  </div>

  <div class="form-group">
    <label for="exampleFormControlFile1">Add a picture : </label><br>
    <input type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>


  <button type="submit" value="Add">Add</button>

</form>

<p> log out :</p>


<form action="logout.php" method="post">
    <button type="Log Out" value="logout">Log Out</button>
</form>
</center>
</body>
</html>