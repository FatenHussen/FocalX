<?php
function deleteStudent(&$students, $id) {
    foreach ($students as $key => $student) {
        if ($student['id'] == $id) {
            unset($students[$key]);
            echo "Student with ID $id deleted.";
            return;
        }
    }
    echo "Student with ID $id not found.";
}
