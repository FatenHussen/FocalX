<?php
function createStudent(&$students, $name, $age, $grade) {
    $id = count($students) + 1; // Generate a simple incremental ID
    $student = [
        'id' => $id,
        'name' => $name,
        'age' => $age,
        'grade' => $grade
    ];
    $students[] = $student;
}
