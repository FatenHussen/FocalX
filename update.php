<?php
function updateStudent(&$students, $id, $name, $age, $grade) {
    foreach ($students as &$student) {
        if ($student['id'] == $id) {
            $student['name'] = $name;
            $student['age'] = $age;
            $student['grade'] = $grade;
            return;
        }
    }
    echo "Student with ID $id not found.";
}
