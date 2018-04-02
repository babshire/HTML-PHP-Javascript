<?php
require_once("support.php");
require_once("Student.php");
session_start();

$topPart = <<<EOBODY
<h1>Section Information</h1>

        <form action="gradeSubmission.php" method="post">
            <b>Course Name(e.g., cmsc128): </b><input id="name" type="text" name="coursename" />
            <br /><br />
            <b>Section (e.g., 0101): </b><input id="name" type="text" name="section" />
            <br /><br />


            <input type="submit" name="SubmitSectionInfo" value="Submit"/>
        </form>	
EOBODY;

$body = $topPart;	
$page = generatePage($body);
echo $page;

?>

