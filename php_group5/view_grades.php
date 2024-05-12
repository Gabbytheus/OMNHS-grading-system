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
            background-color: rgba(255, 255, 255, 0.0);
            padding: 0;
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $year = isset($_POST['year']) ? $_POST['year'] : '';
            $section = isset($_POST['section']) ? $_POST['section'] : '';

            // Validate year and section inputs
            if ($year !== '' && $section !== '') {
                // Fetch students and their grades based on the selected criteria
                $sqlGrades = "SELECT students.student_id, students.student_name, 
                    SUM(student_grades.total_grade) AS total_grade
                    FROM students
                    INNER JOIN student_grades ON students.student_id = student_grades.student_id
                    WHERE students.grade_level = '$year' 
                    AND students.section_id = '$section'
                    GROUP BY students.student_id, students.student_name";
                $resultGrades = mysqli_query($conn, $sqlGrades);

                if (mysqli_num_rows($resultGrades) > 0) {
                    // Display the student grades
                    echo "<h2>Student Grades - Year $year, Section $section</h2>";
                    echo "<table border='1'>";
                    echo "<tr><th>Student ID</th><th>Student Name</th><th>Total Grade</th></tr>";
                    while ($row = mysqli_fetch_assoc($resultGrades)) {
                        echo "<tr>";
                        echo "<td>" . $row['student_id'] . "</td>";
                        echo "<td>" . $row['student_name'] . "</td>";
                        echo "<td>" . $row['total_grade'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";

                    // Add a back button
                    echo "<br>";
                    echo "<a href='javascript:history.go(-1)' class='back-button'>Go Back</a>";
                } else {
                    echo "No student grades found for the selected criteria.";
                    echo "<a href='javascript:history.go(-1)' class='back-button'>Go Back</a>";
                }

                // Fetch top students per section
                $sqlTopStudents = "SELECT students.student_id, students.student_name, 
                    students.section_id, AVG(student_grades.total_grade) AS avg_grade
                    FROM students
                    INNER JOIN student_grades ON students.student_id = student_grades.student_id
                    WHERE students.grade_level = '$year' 
                    AND students.section_id = '$section'
                    GROUP BY students.student_id, students.student_name, students.section_id";
                $resultTopStudents = mysqli_query($conn, $sqlTopStudents);

                if (mysqli_num_rows($resultTopStudents) > 0) {
                    // Initialize top students per section array
                    $topStudentsPerSection = [];

                    // Loop through the students to identify top students per section
                    while ($row = mysqli_fetch_assoc($resultTopStudents)) {
                        $sectionId = $row['section_id'];
                        $studentName = $row['student_name'];
                        $avgGrade = $row['avg_grade'];

                        // Check if the section exists in the topStudentsPerSection array
                        if (!isset($topStudentsPerSection[$sectionId])) {
                            $topStudentsPerSection[$sectionId] = [];
                        }

                        // Add the student to the section's top students array
                        $topStudentsPerSection[$sectionId][] = ['student_name' => $studentName, 'avg_grade' => $avgGrade];
                    }

                    // Sort each section's top students by average grade in descending order
                    foreach ($topStudentsPerSection as &$sectionStudents) {
                        usort($sectionStudents, function ($a, $b) {
                            return $b['avg_grade'] <=> $a['avg_grade'];
                        });
                    }

                    // Output top 3 students per section
                    echo "<h2>Top Students per Section</h2>";
                    foreach ($topStudentsPerSection as $sectionId => $topStudents) {
                        echo "<strong>Section ID: $sectionId</strong><br>";
                        echo "<ol>";
                        $topThree = array_slice($topStudents, 0, 3); // Get the top 3 students
                        foreach ($topThree as $student) {
                            echo "<li>" . $student['student_name'] . " - Avg. Grade: " . $student['avg_grade'] . "</li>";
                        }
                        echo "</ol>";
                    }
                } else {
                    echo "No top students found for the selected criteria.";
                }
            } else {
                echo "Please select a valid year and section.";
            }
        }

        mysqli_close($conn);
        ?>
    </div>
</body>

</html>
