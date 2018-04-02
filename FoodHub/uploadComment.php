<?php
    require_once("sql.php");
    session_start();
    $db = connectToDB();
    $id = $_POST["id"];

    $username = $_SESSION["username"];
    $comment = $_POST["comment"];
    $date = date('Y-m-d H:i:s', time());
    $query = "INSERT INTO `comments` (`ID`, `USERNAME`, `COMMENT`, `DATE`) VALUES ({$id}, '{$username}', '{$comment}', '{$date}');"; //2017-12-03 15:53:02
    if ($db->query($query) === TRUE) {
        header("Location: viewRecipe.php?success=true&id={$id}");
    } else {
        header("Location: error.php");
    }
    
?>