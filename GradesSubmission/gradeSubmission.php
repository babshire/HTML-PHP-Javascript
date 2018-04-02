<?php
    require_once("Student.php");
    session_start();
    $_SESSION["course"] = $_POST["coursename"];
    $_SESSION["section"] = $_POST["section"];
    $course = $_SESSION['course'].$_SESSION['section'];


    echo "<h1>Grade Submission Form</h1>";
    echo "<h2>Course: {$_SESSION['course']}, Section: {$_SESSION['section']}</h2>";
        
    if (file_exists($course.".txt")) {
        $arrayOfLines = file($course.".txt");
        foreach ($arrayOfLines as $line) {
            $line = trim($line);
        }

        echo "<form action='confirmGrades.php' method='post'>";
        echo "<table border=\"1\">";


        for ($i = 0; $i < count($arrayOfLines); $i++) {
            $studentList[$i] = new Student($arrayOfLines[$i], 0);
        }
        
        $_SESSION["listOfStudents"] = $studentList;


        $row = 0;
        foreach ($arrayOfLines as $line) {
            echo "<tr>";
                echo "<td>$line</td>";
                echo "<td><input type='radio' name='grade$row' value='A'>A<br></td>";
                echo "<td><input type='radio' name='grade$row' value='B'>B<br></td>";
                echo "<td><input type='radio' name='grade$row' value='C'>C<br></td>";
                echo "<td><input type='radio' name='grade$row' value='D'>D<br></td>";
                echo "<td><input type='radio' name='grade$row' value='F'>F<br></td>";
            echo "</tr>";
            $row++;
        }
        echo "</table><br />";
        
        echo "<input type='submit' name='continueGrades' value='Continue'/>";
        echo "</form>";

    }
    else {
        echo "<strong>File $filename does not exist.</strong>";
    }
    
    


?>