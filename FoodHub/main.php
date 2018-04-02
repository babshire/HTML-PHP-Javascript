<?php
require_once("sql.php");
session_start();

if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
  header("Location: index.html");
}

$user = $_SESSION["username"];

$conn = connectToDB();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$getCurrDisplayNames = "SELECT * FROM displaynames WHERE USERNAME LIKE '{$user}'";
$currDisplayNames = $conn->query($getCurrDisplayNames); 
$currentUserDisplayName = "";
if ($getCurrDisplayName = $currDisplayNames->fetch_assoc()) {
   $currentUserDisplayName = $getCurrDisplayName["DISPLAY_NAME"];
} else {
  $currentUserDisplayName = $user;
}

$map = array();

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

    <script src="main.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand navbar-dark fixed-top bg-primary">
      <a class="navbar-brand" href="main.php">FoodHub</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link active" href="main.php">Home <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link" href="uploadDish.php">Upload</a>
        </div>    
      </div>
      <span class="navbar-nav">
        <a class="nav-item nav-link" href="changeName.php">Edit Name</a>
        <a class="nav-item nav-link" href="signOutPage.php">Sign Out</a>
      </span>
    </nav>

    <div class="jumbotron text-center text-white">
        <h1>FoodHub</h1>
        <p>Welcome <strong><?php echo $currentUserDisplayName ?></strong> to the one stop food sharing website!</p>
        <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='uploadDish.php'">Upload</button>
    </div>

    <div class="container">
        <form class="search-box mx-auto">
            <input class="form-control mr-sm-2" type="text" id="search" name="search" placeholder="Search recipes" onkeyup="unnecessarysearch()" onkeypress="return event.keyCode != 13;"/>
        </form>

        <hr class="ml-5 mr-5">

        <div class="card-columns">

      <?php

 
$getRecipes = "SELECT * FROM recipes ORDER BY `DATE` DESC";
$allRecipes = $conn->query($getRecipes);

$body = "";
if ($allRecipes->num_rows > 0) {
    // output data of each row
    while($row = $allRecipes->fetch_assoc()) {
        $id = "0x" . strtoupper(bin2hex($row["ID"]));
        $recipe = trim($row["RECIPE_NAME"]);
        $userName = $row["USERNAME"];
        $details = $row["DETAILS"];
        $image_data = $row["RECIPE_PICTURE"];
        $date = date("M jS, Y", strtotime(($row["DATE"])));
        $encoded_image = base64_encode($image_data);
        $image = "<img class='card-img-top' src='data:image/jpeg;base64,{$encoded_image}' alt=\"Card image cap\">";

        $getDisplayName = "SELECT * FROM displaynames WHERE USERNAME LIKE '{$userName}'";
        $displayNames = $conn->query($getDisplayName); 
        $displayName = "";
        if ($getDisplayName = $displayNames->fetch_assoc()) {
           $displayName = $getDisplayName["DISPLAY_NAME"];
        } else {
          $displayName = $userName;
        }
        $temp = "<div class=\"card\" onclick=\"window.location.href = 'viewRecipe.php?id={$id}';\">";
        $temp .= $image;
        $temp .= "<div class=\"card-body\">";
        $temp .= "<h4 class=\"card-title\">{$recipe}</h4>";
        $temp .= "<p class=\"card-text\">{$details}</p>";
        $temp .= "<footer>";
        $temp .= "<small class=\"text-muted\">";
        $temp .= "- {$displayName} <cite class=\"text-right\" title=\"Author\">{$date}</cite>"; // TODO get date
        $temp .= "</small>";
        $temp .= "</footer>";
        $temp .= "</div>";
        $temp .= "</div>";
        $map[$recipe." ".$details] = $temp;
        $body .= $temp;
    }
} else {
    $body .= "No results";
}
$conn->close();
echo $body;

      ?>

        
    </div>
  </div>
  <div id="DEBUG"></div>


<script type="text/javascript">
function search() {
    let jArray= <?php echo json_encode($map); ?>;
    let text = document.getElementById("search").value.toLowerCase();
    let count = 0;
    let toRet = "";
    for (key in jArray) {
    if (key.toLowerCase().indexOf(text) !== -1) {
        toRet += jArray[key];
    }
    }
    if (toRet === "") {
    document.getElementsByClassName("card-columns")[0].innerHTML = "<b>No Results Found!</b>";            
    } else {
    document.getElementsByClassName("card-columns")[0].innerHTML = toRet;            
    }
}

function unnecessarysearch() {
    search();
}
</script>

</body>

</html>

