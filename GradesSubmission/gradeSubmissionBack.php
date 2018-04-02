<?php
    require_once("Student.php");
    session_start();


    echo "<h1>Grade Submission Form</h1>";
    echo "<h2>Course: {$_SESSION["course"]}, Section: {$_SESSION["section"]}</h2>";
        


        echo "<form action='confirmGrades.php' method='post'>";
        echo "<table border=\"1\">";

        $listOfStudents = $_SESSION["listOfStudents"];
        $row = 0;
        foreach ($listOfStudents as $student) {
            echo "<tr>";
                echo "<td>" . $student->getName() . "</td>";
                if ($student->getGrade() === 'A') 
                    echo "<td><input type='radio' name='grade$row' value='A' checked='checked'>A<br></td>";
                else 
                    echo "<td><input type='radio' name='grade$row' value='A'>A<br></td>";
                if ($student->getGrade() === 'B') 
                    echo "<td><input type='radio' name='grade$row' value='B' checked='checked'>B<br></td>";
                else 
                    echo "<td><input type='radio' name='grade$row' value='B'>B<br></td>";
                if ($student->getGrade() === 'C') 
                    echo "<td><input type='radio' name='grade$row' value='C' checked='checked'>C<br></td>";
                else 
                    echo "<td><input type='radio' name='grade$row' value='C'>C<br></td>";
                if ($student->getGrade() === 'D') 
                    echo "<td><input type='radio' name='grade$row' value='D' checked='checked'>D<br></td>";
                else 
                    echo "<td><input type='radio' name='grade$row' value='D'>D<br></td>";
                if ($student->getGrade() === 'F') 
                    echo "<td><input type='radio' name='grade$row' value='F' checked='checked'>F<br></td>";
                else 
                    echo "<td><input type='radio' name='grade$row' value='F'>F<br></td>";
            echo "</tr>";
            $row++;
        }
        echo "</table><br />";
        
        echo "<input type='submit' name='continueGrades' value='Continue'/>";
        echo "</form>";


    


?>