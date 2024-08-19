<?php
function readStudents($students) {
    if (empty($students)) {
        echo "No students available.";
    } else {
        foreach ($students as $student) {
            echo "ID: " . $student['id'] . " | ";
            echo "Name: " . $student['name'] . " | ";
            echo "Age: " . $student['age'] . " | ";
            echo "Grade: " . $student['grade'] . "<br>";
        }
    }
}
