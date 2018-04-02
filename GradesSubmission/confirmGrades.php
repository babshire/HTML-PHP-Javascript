<?php
require_once("Student.php");
session_start();

$studentList = $_SESSION["listOfStudents"];

    echo "<h2>Grades To Submit</h2> <br />";


    echo "<table border='1'>";
    echo "<tr><td>Name</td><td>Grade</td>";

    $count=0;
    foreach ($studentList as $s) {
        $gradeName="grade".$count;
        $studentName = $s->getName();
        $s->setGrade($_POST[$gradeName]);
        $studentGrade = $s->getGrade();
        echo "<tr>";
        echo "<td>$studentName</td>";
        echo "<td>$studentGrade</td>";
        echo "</tr>";
        $count++;
    }
    echo "</table><br />";

    echo "<form action='gradesSubmitted.php' method='post'>";
    echo "<input type='submit' name='submitGrades' value='Submit Grades'>";
    echo "</form>";

    echo "<form action='gradeSubmissionBack.php' method='post'>";
    echo "<input type='submit' name='goBack' value='Back'>";
    echo "</form>";



?>