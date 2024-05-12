<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
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

        h1,
        h2,
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            display: block;
            width: 120px;
            text-align: center;
            margin: 20px auto;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .passed {
            color: green;
            font-weight: bold;
        }

        .failed {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Student Report Card</h1>

        <?php
// Initialize database connection
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "users";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Initialize a variable to store the total grade
$totalGradeAllSubjects = 0;
$subjectCount = 0; // Initialize subject count

// Check if student_id is provided in the URL
if (isset($_GET['student_id']) && !empty($_GET['student_id'])) {
    $studentId = $_GET['student_id'];

    // Fetch student details
    $sqlStudent = "SELECT * FROM students WHERE student_id = ?";
    $stmtStudent = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmtStudent, $sqlStudent)) {
        mysqli_stmt_bind_param($stmtStudent, "i", $studentId);
        mysqli_stmt_execute($stmtStudent);
        $resultStudent = mysqli_stmt_get_result($stmtStudent);

        if (mysqli_num_rows($resultStudent) > 0) {
            $studentData = mysqli_fetch_assoc($resultStudent);
            $studentName = $studentData['student_name'];
            $gradeLevel = $studentData['grade_level'];
            $sectionName = $studentData['section_name'];
            $isScience = $studentData['is_science'] == 1 ? 'Science' : 'Regular';

            // Display student information
            echo "<h2>Student Information</h2>";
            echo "<p><strong>Student Name:</strong> $studentName</p>";
            echo "<p><strong>Grade Level:</strong> $gradeLevel</p>";
            echo "<p><strong>Section:</strong> $sectionName</p>";
            echo "<p><strong>Student Type:</strong> $isScience</p>";

            // Prepare and execute the query for fetching student grades
            $sqlGrades = "SELECT subjects.subject_name, student_grades.written_work, 
            student_grades.performance_task, student_grades.quarterly_assessment, 
            student_grades.total_grade
            FROM student_grades
            INNER JOIN subjects ON student_grades.subject_id = subjects.id
            WHERE student_grades.student_id = ?";
            $stmtGrades = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmtGrades, $sqlGrades)) {
                mysqli_stmt_bind_param($stmtGrades, "i", $studentId);
                mysqli_stmt_execute($stmtGrades);
                $resultGrades = mysqli_stmt_get_result($stmtGrades);

                if (mysqli_num_rows($resultGrades) > 0) {
                    echo "<h2>Grades</h2>";
                    echo "<table>";
                    echo "<tr><th>Subject</th><th>Written Work</th><th>Performance Task</th><th>Quarterly Assessment</th><th>Total Grade</th><th>Status</th></tr>";

                    while ($row = mysqli_fetch_assoc($resultGrades)) {
                        $subjectCount++; // Increment subject count
                        $subjectName = $row['subject_name'];
                        $writtenWork = $row['written_work'];
                        $performanceTask = $row['performance_task'];
                        $quarterlyAssessment = $row['quarterly_assessment'];
                        $totalGrade = $row['total_grade'];

                        // Calculate pass/fail status
                        $status = $totalGrade >= 75 ? 'Passed' : 'Failed';

                        echo "<tr>";
                        echo "<td>$subjectName</td>";
                        echo "<td>$writtenWork</td>";
                        echo "<td>$performanceTask</td>";
                        echo "<td>$quarterlyAssessment</td>";
                        echo "<td>$totalGrade</td>";
                        echo "<td class='" . ($status == 'Passed' ? 'passed' : 'failed') . "'>$status</td>";
                        echo "</tr>";

                        // Accumulate total grades for all subjects
                        $totalGradeAllSubjects += $totalGrade;
                    }

                    // Display the total grade for all subjects
                    $averageGrade = $totalGradeAllSubjects / $subjectCount;
                    $overallStatus = $averageGrade >= 75 ? 'Passed' : 'Failed';
                    echo "<tr><td colspan='4'><strong>Total Grade:</strong></td><td>$averageGrade</td><td>$overallStatus</td></tr>";

                    echo "</table>";
                } else {
                    echo "No grades found for this student.";
                }
            } else {
                echo "Error preparing grades statement.";
            }
        } else {
            echo "Student not found.";
        }
    } else {
        echo "Error preparing student statement.";
    }

    mysqli_stmt_close($stmtGrades);
    mysqli_stmt_close($stmtStudent);
} else {
    echo "Student ID is missing or invalid.";
}

mysqli_close($conn);
?>






        <!-- Back Button -->
        <a href="javascript:history.go(-1)" class="back-button">Go Back</a>
    </div>
</body>



</html>