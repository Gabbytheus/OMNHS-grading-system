<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "users";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch sections from the database
$sqlSections = "SELECT * FROM sections";
$resultSections = mysqli_query($conn, $sqlSections);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = isset($_POST['year']) ? $_POST['year'] : '';
    $section = isset($_POST['section']) ? $_POST['section'] : '';

    // Fetch the top student for each subject in the specified grade level and section
    $sql = "SELECT subjects.subject_name, students.student_name
            FROM students
            INNER JOIN student_grades ON students.student_id = student_grades.student_id
            INNER JOIN subjects ON student_grades.subject_id = subjects.id
            WHERE students.grade_level = '$year' 
            AND students.section_id = '$section'
            AND student_grades.total_grade = (
                SELECT MAX(total_grade) 
                FROM student_grades AS sg 
                WHERE sg.subject_id = student_grades.subject_id 
                AND sg.student_id = students.student_id
            )
            ORDER BY subjects.subject_name";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Display the top student for each subject
        echo "<h2>Top Student in Each Subject - Year $year, Section $section</h2>";
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>{$row['subject_name']}: {$row['student_name']}</li>";
        }
        echo "</ul>";
    } else {
        echo "No top students found for the selected criteria.";
    }
}

mysqli_close($conn);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-color: rgba(255, 255, 255, 0.0);
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Student Grades</h1>

        <!-- Grade Selection Form -->
        <form method="POST" action="view_grades.php">
            <label for="year">Year:</label>
            <select id="year" name="year" required>
                <option value="">Select Year</option>
                <option value="7">Grade 7</option>
                <option value="8">Grade 8</option>
                <option value="9">Grade 9</option>
                <option value="10">Grade 10</option>
            </select>

            <label for="section">Section:</label>
            <select id="section" name="section" required>
                <option value="">Select Section</option>
                <?php while ($row = mysqli_fetch_assoc($resultSections)) : ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['section_name']; ?></option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="Show Student Grades">
        </form>

        <!-- Display Student Grades -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (mysqli_num_rows($result) > 0) {
                echo "<h2>Student Grades - Year $year, Section $section</h2>";
                echo "<table>";
                echo "<tr><th>Student ID</th><th>Student Name</th><th>Total Grade</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['student_id'] . "</td>";
                    echo "<td>" . $row['student_name'] . "</td>";
                    echo "<td>" . $row['total_grade'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='error-message'>No student grades found for the selected criteria.</p>";
            }
        }
        ?>
        
        <!-- View All Students Button -->
        <form method="POST" action="view_all_students.php">
            <input type="submit" value="View All Students">
        </form>
    </div>
</body>

</html>
