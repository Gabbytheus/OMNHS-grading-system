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
    </style>
</head>

<body>
    <div class="container">
        <h1>Student Report Card</h1>

        <form method="GET" action="show_reportC.php">
            <label for="student_id">Select Student ID:</label>
            <select id="student_id" name="student_id" required>
                <option value="">Select Student</option>
                <?php
                // Initialize database connection
                $hostName = "localhost";
                $dbUser = "root";
                $dbPassword = "";
                $dbName = "users"; // Replace 'your_database_name' with your actual database name

                $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

                if (!$conn) {
                    die("Database connection failed: " . mysqli_connect_error());
                }

                // Fetch student IDs and names from the database
                $sqlStudents = "SELECT student_id, student_name FROM students";
                $resultStudents = mysqli_query($conn, $sqlStudents);

                while ($row = mysqli_fetch_assoc($resultStudents)) {
                    $studentId = $row['student_id'];
                    $studentName = $row['student_name'];
                    echo "<option value='$studentId'>$studentId - $studentName</option>";
                }
                ?>
            </select>
            <input type="submit" value="Show Report Card">
        </form>

        <?php

        
        // Check if student_id is provided in the URL
        if (isset($_GET['student_id']) && !empty($_GET['student_id'])) {
            $studentId = $_GET['student_id'];

            // Fetch student details
            $sqlStudent = "SELECT * FROM students WHERE student_id = $studentId";
            $resultStudent = mysqli_query($conn, $sqlStudent);

            if (mysqli_num_rows($resultStudent) > 0) {
                // Student ID exists, proceed with fetching and displaying data
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

                if (!empty($sectionName)) {
                    echo "<p><strong>Section:</strong> $sectionName</p>";
                } else {
                    echo "<p><strong>Section:</strong> Not assigned</p>";
                }
                
                echo "<p><strong>Student Type:</strong> $isScience</p>";

                // Fetch and display student grades
                // Make sure to replace subject_id with the actual column name from your database
                $sqlGrades = "SELECT subjects.subject_name, student_grades.written_work, 
                    student_grades.performance_task, student_grades.quarterly_assessment, 
                    student_grades.total_grade
                    FROM student_grades
                    INNER JOIN subjects ON student_grades.subject_id = subjects.id
                    WHERE student_grades.student_id = $studentId";
                $resultGrades = mysqli_query($conn, $sqlGrades);

                if (mysqli_num_rows($resultGrades) > 0) {
                    echo "<h2>Grades</h2>";
                    echo "<table>";
                    echo "<tr><th>Subject</th><th>Written Work</th><th>Performance Task</th><th>Quarterly Assessment</th><th>Total Grade</th></tr>";

                    while ($row = mysqli_fetch_assoc($resultGrades)) {
                        $subjectName = $row['subject_name'];
                        $writtenWork = $row['written_work'];
                        $performanceTask = $row['performance_task'];
                        $quarterlyAssessment = $row['quarterly_assessment'];
                        $totalGrade = $row['total_grade'];

                        echo "<tr>";
                        echo "<td>$subjectName</td>";
                        echo "<td>$writtenWork</td>";
                        echo "<td>$performanceTask</td>";
                        echo "<td>$quarterlyAssessment</td>";
                        echo "<td>$totalGrade</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "No grades found for this student.";
                }
            } else {
                echo "Student not found.";
            }
        } else {
            echo "Please select a student to view the report card.";
        }
        

        mysqli_close($conn);
        ?>


        <!-- Back Button -->
        <a href="javascript:history.go(-1)" class="back-button">Go Back</a>
    </div>
</body>

</html>
