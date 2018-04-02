<?php
require_once("sql.php");

$idFromQueryString = $_GET["id"];
$recipe = getData("recipes", "ID=" . $idFromQueryString . "");
$recipeName = $recipe["RECIPE_NAME"];
$details = $recipe["DETAILS"];
$recipeImage = $recipe["RECIPE_PICTURE"];

$userDisplayNameResult = getData("displaynames", "USERNAME='" . $recipe["USERNAME"] . "'");
$userDisplayName = $userDisplayNameResult["DISPLAY_NAME"];

$ingredients = getAllData("ingredients", "ID=" . $idFromQueryString . "");
$instructions = getAllData("instructions", "ID=" . $idFromQueryString . "");
$comments = getAllData("comments", "ID=" . $idFromQueryString . " ORDER BY `DATE` ASC");

session_start();
$_SESSION["ID"] = $idFromQueryString . "";
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
    <a class="nav-item nav-link" href="uploadDish.php">Upload</a>
  </div>    
</div>
<span class="navbar-nav">
    <a class="nav-item nav-link" href="changeName.php">Edit Name</a>
    <a class="nav-item nav-link" href="signOutPage.php">Sign Out</a>
</span>
</nav>


    <div class="container view-recipe-margin">
        <div class="row content">

            <div class="col">
                
<?php
                echo '<img src="data:image/jpeg;base64,' . base64_encode($recipeImage) . '" class=\'img-fluid\'>';
?>

                <h1 class="text-center pt-2"><?php echo $recipeName; ?></h1>
                <p class="text-center pt-1">Recipe by: <?php echo $userDisplayName; ?></p>
                <p class="text-center pt-2"><?php echo $details; ?></p>

            </div>

            <div class="col">

                <h1>Ingredients</h1>

<?php

$i = 1;
while ($ingredientRow = $ingredients->fetch_assoc()) {
    echo "<p>" . $i . "). " . $ingredientRow["INGREDIENTS"] . "</p>";
    $i++;
}

$ingredients->close();

?>

                <h1>Instructions</h1>


<?php

$i = 1;
while ($instructionRow = $instructions->fetch_assoc()) {
    echo "<p>" . $i . "). " . $instructionRow["INSTRUCTIONS"] . "</p>";
    $i++;
}

$instructions->close();

?>            

            </div>
            
        </div>

        <br><br><br>

        <hr class="ml-5 mr-5">

        <div class="row">
                <h1>Comments</h1><br><br>

                <br>

                <?php

                $break = "<hr>";

                while ($commentRow = $comments->fetch_assoc()) {
                    $comment = $commentRow["COMMENT"];
                    $username = $commentRow["USERNAME"];
                    $time = strtotime($commentRow["DATE"]);

                    $userDisplayNameResult = getData("displaynames", "USERNAME='" . $username . "'");
                    $displayName = $userDisplayNameResult["DISPLAY_NAME"];

                    echo "<div class='col-12'><b class='float-sm-left'>" . $displayName . "&nbsp;</b>";
                    echo "<i class='float-sm-right'><em class='text-right'>" . date('l F, jS Y', $time). "</em></i><br><div class='pb-2'></div>";
                    echo $commentRow["COMMENT"] . "\n" . $break . "\n</div>";
                }

                ?>

        </div>
        

        <div class="comment-box col-lg-12">
            <form action="uploadComment.php" method="post">
                <textarea class="form-control" rows="4" cols="50" name="comment" id="viewRecipeComment"></textarea>
                <br>
                <div class="float-right">
                    <input type="hidden" value="<?php echo $_GET["id"]; ?>" name="id"/>
                    <input class="btn btn-secondary" type="reset" value="Reset"/>
                    <input class="btn btn-primary" type="submit" value="Submit Comment"/>
                </div>
            </form>
        </div>

        <br><br><br><br><br>

</body>

</html>