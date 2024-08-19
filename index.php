<?php
session_start(); // Start the session

// Initialize the students array in the session if it doesn't already exist
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

$students = &$_SESSION['students']; // Reference the students array from the session

// Include the CRUD operations
include 'create.php';
include 'read.php';
include 'update.php';
include 'delete.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'create':
            createStudent($students, $_POST['name'], $_POST['age'], $_POST['grade']);
            echo "<p style='color: green;'>Student added successfully.</p>";
            break;

        case 'read':
            echo "<h2>Student Data:</h2>";
            readStudents($students);
            break;

        case 'update':
            updateStudent($students, $_POST['id'], $_POST['name'], $_POST['age'], $_POST['grade']);
            echo "<p style='color: blue;'>Student updated successfully.</p>";
            break;

        case 'delete':
            deleteStudent($students, $_POST['id']);
            echo "<p style='color: red;'>Student deleted successfully.</p>";
            break;

        default:
            echo "<p style='color: red;'>Invalid action.</p>";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student CRUD Operations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            margin: 0 auto;
            width: 400px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        select, input[type="text"], input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
        }

        .student-list {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .student-list h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .student-list p {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            border-left: 4px solid #5cb85c;
        }
    </style>
</head>
<body>

<h1>Student CRUD Operations</h1>

<form method="post" action="">
    <label>Operation:</label>
    <select name="action">
        <option value="create">Create</option>
        <option value="read">Read</option>
        <option value="update">Update</option>
        <option value="delete">Delete</option>
    </select><br><br>

    <label for="id">ID (for Update/Delete):</label>
    <input type="number" name="id" id="id"><br><br>

    <label for="name">Name:</label>
    <input type="text" name="name" id="name"><br><br>

    <label for="age">Age:</label>
    <input type="number" name="age" id="age"><br><br>

    <label for="grade">Grade:</label>
    <input type="text" name="grade" id="grade"><br><br>

    <input type="submit" value="Execute">
</form>

<div class="student-list">
    <h2>Current Student List:</h2>
    <?php readStudents($students); ?>
</div>

</body>
</html>
