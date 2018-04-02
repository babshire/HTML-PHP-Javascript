<?php
session_start();

if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
    header("Location: index.html");
}

$user = $_SESSION["username"];

?>

    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
            crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <title>FoodHub</title>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
            crossorigin="anonymous"></script>
        <script src="uploadDish.js"></script>
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
            <form class="row" action="uploadDishConfirmation.php" method="post" enctype="multipart/form-data" name="uploadDish" id="uploadDish">
                <input type="hidden" id ="ingredients" name="numberOfIngredients" value="5">
                <input type="hidden" id ="instructions" name="numberOfInstructions" value="5">
                <div class="col-sm-12">
                    <div class="form-group form-inline">
                        <div class="col-sm-6">
                            <label class="justify-left" for="picture">Picture of Recipe&nbsp;</label>
                            <input type="file" class="form-control-file mb-2" id="picture" name="picture" required>
                        </div>

                        <div class="float-right col-sm-6 justify-right">
                            <label class="justify-right" for="dishName">Dish name&nbsp;</label>
                            <input class="form-control mb-2 dish-name" name="dishName" id="dishName" placeholder="Enter dish name" required>
                        </div>
                    </div>
                    <div id="ingredientContainer" class="form-group">
                        <label for="dishIngredients">List of ingredients</label>
                        <button class="btn btn-secondary btn-sm float-right mb-2" onclick="addIngredient()">
                            <strong>+</strong>
                        </button>
                        <input class="form-control mb-2" id="dishIngredient1" name="dishIngredient1" placeholder="Ingredient 1">
                        </textarea>
                        <input class="form-control mb-2" id="dishIngredient2" name="dishIngredient2" placeholder="Ingredient 2">
                        </textarea>
                        <input class="form-control mb-2" id="dishIngredient3" name="dishIngredient3" placeholder="Ingredient 3">
                        </textarea>
                        <input class="form-control mb-2" id="dishIngredient4" name="dishIngredient4" placeholder="Ingredient 4">
                        </textarea>
                        <input class="form-control mb-2" id="dishIngredient5" name="dishIngredient5" placeholder="Ingredient 5">
                        </textarea>
                    </div>
                    <div id="instructionContainer" class="form-group">
                        <label for="dishInstructions">Instructions</label>
                        <button class="btn btn-secondary btn-sm float-right mb-2" onclick="addInstruction()">
                            <strong>+</strong>
                        </button>
                        <input class="form-control mb-2" id="dishInstruction1" name="dishInstruction1" placeholder="Instruction 1">
                        </textarea>
                        <input class="form-control mb-2" id="dishInstruction2" name="dishInstruction2" placeholder="Instruction 2">
                        </textarea>
                        <input class="form-control mb-2" id="dishInstruction3" name="dishInstruction3" placeholder="Instruction 3">
                        </textarea>
                        <input class="form-control mb-2" id="dishInstruction4" name="dishInstruction4" placeholder="Instruction 4">
                        </textarea>
                        <input class="form-control mb-2" id="dishInstruction5" name="dishInstruction5" placeholder="Instruction 5">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="dishAdditionalComments">Additional Comments</label>
                        <textarea class="form-control" name="details" id="dishAdditionalComments" rows="3"></textarea>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" onclick="<?php header("Location: main.php"); ?>">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="validate()">Submit</button>
                    </div>
                </div>
            </form>
        </div>


    </body>

    </html>