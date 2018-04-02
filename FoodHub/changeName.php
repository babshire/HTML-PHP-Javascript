<?php

session_start();

if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
  header("Location: index.html");
}

require_once("sql.php");

$db = connectToDB();

$username = trim($_SESSION["username"]);
$getDisplayName = "SELECT * FROM displaynames WHERE USERNAME LIKE '{$username}'";
$displayNames = $db->query($getDisplayName); 
$displayName = "";
if ($getDisplayName = $displayNames->fetch_assoc()) {
   $displayName = $getDisplayName["DISPLAY_NAME"];
} else {
  $displayName = $username;
}

?>


<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

    <title>FoodHub</title>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    
</head>

<body>
  <nav class="navbar navbar-expand navbar-dark fixed-top bg-primary">
      <a class="navbar-brand" href="main.php">FoodHub</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="main.php">Home <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link" href="uploadDish.php">Upload</a>
        </div>    
      </div>
      <span class="navbar-nav">
        <a class="nav-item nav-link active" href="changeName.php">Edit Name</a>
        <a class="nav-item nav-link" href="signOutPage.php">Sign Out</a>
      </span>
    </nav>
  <div class="jumbotron text-center text-white">
    <h1>FoodHub</h1>
    <p class="pb-5">Feel free to change your display name</p>
  </div>

  <div class="container">
    <div class="row content">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
      </div>
      <div class="col-sm-4">
        <form action="uploadDisplayName.php" method="POST" role="form">
          <legend>Change your display name</legend>
          <div class="form-group">
            <label for="displayname">Display Name:</label>
            <input type="text" class="form-control" id="" placeholder="Display Name" value='<?php echo $displayName;?>' name="displayName">
          </div>
          <button type="reset" class="btn btn-secondary btn-block">Reset</button>
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
      </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    </div>
  </div>
</body>
</html>