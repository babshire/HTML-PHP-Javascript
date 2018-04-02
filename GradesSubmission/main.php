<?php
require_once("support.php");
require_once("Student.php");
session_start();

$topPart = <<<EOBODY
    <form action="{$_SERVER['PHP_SELF']}" method="post">
        <h1> Grades Submission Server </h1>
        <strong>LoginId: </strong><input type="text" name="username" /><br><br>
        <strong>Password: </strong><input type="password" name="password"/><br><br>
        
        <!--We need the submit button-->
        <input type="submit" name="submitLogin" value="Submit" /><br>
    </form>		
EOBODY;

$bottomPart = "";	
if (isset($_POST["submitLogin"])) {
    $usernameValue = trim($_POST["username"]);
    $passwordValue = trim($_POST["password"]);
    
    if (($passwordValue === "" || ($passwordValue !== "terps")) && (($usernameValue !== "cmsc298s") || ($usernameValue === ""))) {   
        $bottomPart .= "<h2>Invalid Login Information Provided</h2><br />";
    } 
    else {
        header("Location: sectioninfo.php");
    }
}



$body = $topPart.$bottomPart;	
$page = generatePage($body);
echo $page;
?>