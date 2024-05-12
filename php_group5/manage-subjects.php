<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "users";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch subjects from the database
$sqlSubjects = "SELECT * FROM subjects ORDER BY subject_name ASC";
$resultSubjects = mysqli_query($conn, $sqlSubjects);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_subject'])) {
        $subjectName = $_POST['subject_name'];
        
        // Add new subject to the database
        $sqlAddSubject = "INSERT INTO subjects (subject_name) VALUES ('$subjectName')";
        if (mysqli_query($conn, $sqlAddSubject)) {
            echo "<script>alert('Subject added successfully');</script>";
            // Refresh the page to reflect changes
            echo "<script>window.location.href = 'course-management.php';</script>";
        } else {
            echo "Error adding subject: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['delete_subject'])) {
        $subjectId = $_POST['delete_subject'];
        
        // Delete subject from the database
        $sqlDeleteSubject = "DELETE FROM subjects WHERE id = '$subjectId'";
        if (mysqli_query($conn, $sqlDeleteSubject)) {
            echo "<script>alert('Subject deleted successfully');</script>";
            // Refresh the page to reflect changes
            echo "<script>window.location.href = 'manage-subjects.php';</script>";
        } else {
            echo "Error deleting subject: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        label {
            margin-right: 10px;
        }

        input[type="text"] {
            width: 300px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 5px 0;
        }

        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <h1>Course Management</h1>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="subject_name">Subject Name:</label>
        <input type="text" id="subject_name" name="subject_name" required>
        <button type="submit" name="add_subject">Add Subject</button>
    </form>

    <h2>Existing Subjects:</h2>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($resultSubjects)) : ?>
            <li>
                <?php echo $row['subject_name']; ?>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="delete_subject" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
</body>

</html>
