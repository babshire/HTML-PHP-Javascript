<?php
session_start();
require_once("sql.php");

if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: index.html");
}

$db = connectToDB();

$user = $_SESSION["username"];

$numberOfIngredients = $_POST["numberOfIngredients"];
$numberOfInstructions = $_POST["numberOfInstructions"];
$id = bin2hex(openssl_random_pseudo_bytes(16));

$recipe = $_POST["dishName"];
$details = $_POST["details"];

$imagetmp = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
$check = getimagesize($_FILES['picture']["tmp_name"]);

for ($i = 1; $i <= $numberOfIngredients; $i++) {
    $query = "INSERT INTO `ingredients` (`ID`, `POSITION`, `INGREDIENTS`) VALUES (UNHEX('{$id}'), '{$i}', '{$_POST["dishIngredient" . $i]}');";
    if ($db->query($query) === FALSE) {
        header("Location: error.php?=" . $db->query($query));
    }
}
for ($i = 1; $i <= $numberOfInstructions; $i++) {
    $query = "INSERT INTO `instructions` (`ID`, `POSITION`, `INSTRUCTIONS`) VALUES (UNHEX('{$id}'), '{$i}', '{$_POST["dishInstruction" . $i]}');";
    if ($db->query($query) === FALSE) {
        header("Location: error.php");
    }
}

$date = date('Y-m-d H:i:s', time());
$query = "INSERT INTO `recipes` (`ID`, `RECIPE_NAME`, `USERNAME`, `DETAILS`, `RECIPE_PICTURE`, `DATE`) VALUES (UNHEX('{$id}'), '{$recipe}', '{$user}', '{$details}', '{$imagetmp}', '{$date}');";
if ($db->query($query) === FALSE) {
    header("Location: error.php");
}


?>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
            crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
        <link rel="favicon" src="favicon.ico">

        <title>FoodHub</title>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
            crossorigin="anonymous"></script>
        <script src="validate.js"></script>

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
                <a class="nav-item nav-link active" href="uploadDish.php">Upload</a>
            </div>    
        </div>
        <span class="navbar-nav">
            <a class="nav-item nav-link" href="changeName.php">Edit Name</a>
            <a class="nav-item nav-link" href="signOutPage.php">Sign Out</a>
        </span>
    </nav>

        <div class="jumbotron text-center text-white">
            <h1>FoodHub</h1>
            <p class="pb-5">Welcome to the one stop food sharing website!</p>
        </div>


        <div class="container">
            <form class="row">
                <div class="col-xl">
                    <div class="form-group form-inline" ; <label for="Submitted">Entry submitted!</label>
                        
                </div>
            </form>
        </div>


    </body>

    </html>
