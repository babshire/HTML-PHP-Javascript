<?php
    require_once("sql.php");
    session_start();
    $db = connectToDB();
    $username = $_SESSION["username"];
    $displayName = $_POST["displayName"];
    $query = "UPDATE `displaynames` SET `DISPLAY_NAME`='{$displayName}' WHERE `USERNAME`='{$username}';";
    if ($db->query($query) === TRUE) {
        header("Location: main.php");
    } else {
        header("Location: error.php");
    }
    
?>