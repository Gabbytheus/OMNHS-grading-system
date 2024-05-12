<!-- PAST PROCESS GRADES PHP CODES -->
<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "users";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Retrieve sections and subjects from the database
$sqlSections = "SELECT * FROM sections";
$resultSections = mysqli_query($conn, $sqlSections);

$sqlSubjects = "SELECT * FROM subjects";
$resultSubjects = mysqli_query($conn, $sqlSubjects);

// Initialize variables for total grade and selected subject
$totalGrade = "";
$selectedSubject = "";

// Define $stmtInsertGrades initially
$stmtInsertGrades = null;

// Handle form submission for selecting students
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['section'], $_POST['grade'])) {
    $sectionId = $_POST['section'];
    $gradeLevel = $_POST['grade'];

    // Retrieve students based on selected section and grade level
    $sqlStudents = "SELECT * FROM students WHERE grade_level = '$gradeLevel' AND section_id = '$sectionId'";
    $resultStudents = mysqli_query($conn, $sqlStudents);
}

// Handle form submission for submitting grades
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student'], $_POST['written_work'], $_POST['performance_task'], $_POST['quarterly_assessment'], $_POST['subject'])) {
    $studentId = $_POST['student'];
    $writtenWork = $_POST['written_work'];
    $performanceTask = $_POST['performance_task'];
    $quarterlyAssessment = $_POST['quarterly_assessment'];
    $subjectId = $_POST['subject'];

    // Calculate total grade based on weights
    $totalGrade = ($writtenWork * 0.3) + ($performanceTask * 0.5) + ($quarterlyAssessment * 0.2);

    // Insert into student_grades table
    $sqlInsertGrades = "INSERT INTO student_grades (student_id, written_work, performance_task, quarterly_assessment, total_grade, subject_id) 
                        VALUES (?, ?, ?, ?, ?, ?)";
    $stmtInsertGrades = $conn->prepare($sqlInsertGrades);

    if ($stmtInsertGrades) { // Check if preparation was successful
        $stmtInsertGrades->bind_param('iddddi', $studentId, $writtenWork, $performanceTask, $quarterlyAssessment, $totalGrade, $subjectId);

        if ($stmtInsertGrades->execute()) {
            // Fetch the selected subject name from the database
            $sqlSelectedSubject = "SELECT subject_name FROM subjects WHERE id = ?";
            $stmtSelectedSubject = $conn->prepare($sqlSelectedSubject);
            $stmtSelectedSubject->bind_param('i', $subjectId);
            $stmtSelectedSubject->execute();
            $stmtSelectedSubject->bind_result($selectedSubject);
            $stmtSelectedSubject->fetch();
            $stmtSelectedSubject->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grading Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select,
        input[type='number'],
        input[type='submit'] {
            margin-bottom: 10px;
            padding: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        .success-message,
        .error-message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }

        .error-message {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }
    </style>
</head>

<body>
    <div class="container">
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($totalGrade, $selectedSubject)) {
            // Check if $stmtInsertGrades is not null before using it
            if ($stmtInsertGrades) {
                if ($stmtInsertGrades->execute()) {
                    echo "<div class='success-message'>Grade added successfully. Total grade: $totalGrade in $selectedSubject</div>";
                } else {
                    echo "<div class='error-message'>Error: " . $conn->error . "</div>";
                }
            } else {
                
            }
        }
        ?>

        <h2>Select Section, Grade Level, Student, and Subject</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="section">Section:</label>
            <select id="section" name="section" required>
                <option value="">Select Section</option>
                <?php while ($row = mysqli_fetch_assoc($resultSections)) : ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['section_name']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="grade">Grade Level:</label>
            <select id="grade" name="grade" required>
                <option value="">Select Grade Level</option>
                <option value="7">Grade 7</option>
                <option value="8">Grade 8</option>
                <option value="9">Grade 9</option>
                <option value="10">Grade 10</option>
            </select>

            <input type="submit" value="Show Students for Grading">
        </form>

        <?php if (isset($resultStudents)) : ?>
            <h2>Select Student and Grade</h2>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="section" value="<?php echo $sectionId; ?>">
                <input type="hidden" name="grade" value="<?php echo $gradeLevel; ?>">

                <label for="student">Select Student:</label>
                <select id="student" name="student" required>
                    <option value="">Select Student</option>
                    <?php while ($student = mysqli_fetch_assoc($resultStudents)) : ?>
                        <option value="<?php echo $student['student_id']; ?>"><?php echo $student['student_name']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="subject">Subject:</label>
                <select id="subject" name="subject" required>
                    <option value="">Select Subject</option>
                    <?php while ($subject = mysqli_fetch_assoc($resultSubjects)) : ?>
                        <option value="<?php echo $subject['id']; ?>"><?php echo $subject['subject_name']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="written_work">Written Work:</label>
                <input type="number" step="0.01" id="written_work" name="written_work" required>

                <label for="performance_task">Performance Task:</label>
                <input type="number" step="0.01" id="performance_task" name="performance_task" required>

                <label for="quarterly_assessment">Quarterly Assessment:</label>
                <input type="number" step="0.01" id="quarterly_assessment" name="quarterly_assessment" required>

                <input type="submit" value="Submit Grades">
            </form>
        <?php endif; ?>
    </div>
</body>

</html>
