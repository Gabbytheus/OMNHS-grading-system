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

        h1, h2, h3 {
            text-align: center;
            margin-bottom: 20px;
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

        .back-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .student-list {
            list-style-type: none;
            padding-left: 20px;
        }

        .top-students {
            margin-top: 30px;
        }

        .top-students h2 {
            text-align: center;
        }

        .top-students ol {
            padding-left: 20px;
        }

        .top-students li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Student Grades</h1>

<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "users";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch all grade levels, sections, and their students
$sql = "SELECT grade_level.year, sections.section_name, students.student_name
        FROM students
        INNER JOIN grade_level ON students.grade_level_id = grade_level.id
        INNER JOIN sections ON students.section_id = sections.id
        ORDER BY grade_level.year, sections.section_name, students.student_name";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Display the list of students by grade level and section
    echo "<h2>All Students by Grade Level and Section</h2>";
    $currentYear = '';
    $currentSection = '';

    while ($row = mysqli_fetch_assoc($result)) {
        $year = $row['year'];
        $sectionName = $row['section_name'];
        $studentName = $row['student_name'];

        if ($year !== $currentYear || $sectionName !== $currentSection) {
            if ($currentYear !== '') {
                echo "</ul>";
            }
            echo "<h3>Grade $year - Section $sectionName</h3>";
            echo "<ul>";
            $currentYear = $year;
            $currentSection = $sectionName;
        }

        echo "<li>$studentName</li>";
    }

    echo "</ul>";
} else {
    echo "No student records found.";
}

// Fetch top 3 students per section
$sqlTopStudents = "SELECT students.student_id, students.student_name, 
    sections.section_name, AVG(student_grades.total_grade) AS avg_grade
    FROM students
    INNER JOIN student_grades ON students.student_id = student_grades.student_id
    INNER JOIN sections ON students.section_id = sections.id
    GROUP BY students.student_id, students.student_name, sections.section_name";
$resultTopStudents = mysqli_query($conn, $sqlTopStudents);

if (mysqli_num_rows($resultTopStudents) > 0) {
    // Initialize top students per section array
    $topStudentsPerSection = [];

    // Loop through the students to identify top students per section
    while ($row = mysqli_fetch_assoc($resultTopStudents)) {
        $sectionName = $row['section_name'];
        $studentName = $row['student_name'];
        $avgGrade = $row['avg_grade'];

        // Check if the section exists in the topStudentsPerSection array
        if (!isset($topStudentsPerSection[$sectionName])) {
            $topStudentsPerSection[$sectionName] = [];
        }

        // Add the student to the section's top students array
        $topStudentsPerSection[$sectionName][] = ['student_name' => $studentName, 'avg_grade' => $avgGrade];
    }

    // Sort each section's top students by average grade in descending order
    foreach ($topStudentsPerSection as &$sectionStudents) {
        usort($sectionStudents, function ($a, $b) {
            return $b['avg_grade'] <=> $a['avg_grade'];
        });
    }

    // Output top 3 students per section
    echo "<h2>Top Students per Section</h2>";
    foreach ($topStudentsPerSection as $sectionName => $topStudents) {
        echo "<strong>Section Name: $sectionName</strong><br>";
        echo "<ol>";
        $topThree = array_slice($topStudents, 0, 3); // Get the top 3 students
        foreach ($topThree as $student) {
            echo "<li>" . $student['student_name'] . " - Avg. Grade: " . $student['avg_grade'] . "</li>";
        }
        echo "</ol>";
    }
} else {
    echo "No top students found.";
}

mysqli_close($conn);
?>


        <!-- Back Button -->
        <a href="javascript:history.go(-1)" class="back-button">Go Back</a>
    </div>
</body>

</html>
