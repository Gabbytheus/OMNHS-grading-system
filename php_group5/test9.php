<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promote Students</title>
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
        <h1>Promote Students</h1><?php
        $hostName = "localhost";
        $dbUser = "root";
        $dbPassword = "";
        $dbName = "users";

        $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        if (isset($_POST['section_id']) && isset($_POST['grade_level_id'])) {
            $sectionId = $_POST['section_id'];
            $gradeLevelId = $_POST['grade_level_id'];

            // Update students' grade level in the selected section and grade level
            $sqlUpdate = "UPDATE students SET grade_level_id = grade_level_id + 1 
                          WHERE section_id = $sectionId AND grade_level_id = $gradeLevelId";

            // Check if Grade 10 is selected and update as graduated
            if ($gradeLevelId == 4) {
                $sqlUpdate = "UPDATE students SET grade_level_id = 1 
                              WHERE section_id = $sectionId AND grade_level_id = $gradeLevelId";
                echo "Students in Section ID $sectionId and Grade Level ID $gradeLevelId have been promoted to Senior High School.<br>";
            } else {
                // Fetch section name and grade level year for output message
                $sqlInfo = "SELECT section_name FROM sections WHERE id = $sectionId";
                $resultInfo = mysqli_query($conn, $sqlInfo);
                $rowInfo = mysqli_fetch_assoc($resultInfo);
                $sectionName = $rowInfo['section_name'];

                $sqlGradeYear = "SELECT year FROM grade_level WHERE id = $gradeLevelId";
                $resultGradeYear = mysqli_query($conn, $sqlGradeYear);
                $rowGradeYear = mysqli_fetch_assoc($resultGradeYear);
                $gradeYear = $rowGradeYear['year'];

                echo "All students in $sectionName and Grade Level $gradeYear have been promoted.<br>";
            }

            if (mysqli_query($conn, $sqlUpdate)) {
                
            } else {
                echo "Error updating students' grade level: " . mysqli_error($conn);
            }
        }

        // Fetch all existing sections
        $sqlSections = "SELECT id, section_name FROM sections";
        $resultSections = mysqli_query($conn, $sqlSections);

        if (mysqli_num_rows($resultSections) > 0) {
            // Display the section selector
            echo "<form method='POST'>";
            echo "<select name='section_id'>";
            echo "<option value=''>Select Section</option>";

            while ($rowSection = mysqli_fetch_assoc($resultSections)) {
                $sectionId = $rowSection['id'];
                $sectionName = $rowSection['section_name'];

                echo "<option value='$sectionId'>$sectionName</option>";
            }

            echo "</select>";

            // Display grade level selector
            echo "<select name='grade_level_id'>";
            echo "<option value=''>Select Grade Level</option>";

            // Fetch all grade levels
            $sqlGradeLevels = "SELECT id, year FROM grade_level";
            $resultGradeLevels = mysqli_query($conn, $sqlGradeLevels);

            while ($rowGradeLevel = mysqli_fetch_assoc($resultGradeLevels)) {
                $gradeLevelId = $rowGradeLevel['id'];
                $gradeLevelYear = $rowGradeLevel['year'];

                echo "<option value='$gradeLevelId'>$gradeLevelYear</option>";
            }

            echo "</select>";

            // Promote button
            echo "<input type='submit' value='Promote'>";
            echo "</form>";
        } else {
            echo "No sections found.";
        }

        mysqli_close($conn);
        ?>
        <!-- Back Button -->
        <a href="javascript:history.go(-1)" class="back-button">Go Back</a>
    </div>
</body>

</html>
