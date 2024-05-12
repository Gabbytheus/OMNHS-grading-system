<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "users";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch students with section information from the database
$sqlStudents = "SELECT students.student_id, students.student_name, students.grade_level, students.is_science, sections.section_name 
                FROM students 
                LEFT JOIN sections ON students.section_id = sections.id 
                ORDER BY students.student_name ASC";
$resultStudents = mysqli_query($conn, $sqlStudents);

if (!$resultStudents) {
    echo "Error fetching students: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <h1>Student List</h1>

    <table>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Grade Level</th>
            <th>Is Science</th>
            <th>Section</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($resultStudents)) : ?>
            <tr>
                <td><?php echo $row['student_id']; ?></td>
                <td><?php echo $row['student_name']; ?></td>
                <td><?php echo $row['grade_level']; ?></td>
                <td><?php echo $row['is_science'] ? 'Yes' : 'No'; ?></td>
                <td><?php echo $row['section_name'] ?? 'N/A'; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>
