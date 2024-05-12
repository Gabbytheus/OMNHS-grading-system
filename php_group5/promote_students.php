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

        form {
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .form-group label {
            flex: 1;
            margin-right: 10px;
        }

        select, input[type="submit"] {
            flex: 2;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .form-group {
                flex-direction: column;
            }

            select, input[type="submit"] {
                flex: unset;
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Promote Students</h1>
        <?php
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
            $sqlUpdate = "UPDATE students SET grade_level = grade_level + 1 
                          WHERE section_id = $sectionId AND grade_level = $gradeLevelId";

            // Check if Grade 10 is selected and update as graduated
            if ($gradeLevelId == 4) {
                $sqlUpdate = "UPDATE students SET grade_level = 1 
                              WHERE section_id = $sectionId AND grade_level = $gradeLevelId";
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
                // Success message or additional actions can be added here
            } else {
                echo "Error updating students' grade level: " . mysqli_error($conn);
            }
        }

        // Fetch all existing sections and grade levels for the form
        $sqlSections = "SELECT id, section_name FROM sections";
        $resultSections = mysqli_query($conn, $sqlSections);

        $sqlGradeLevels = "SELECT id, year FROM grade_level";
        $resultGradeLevels = mysqli_query($conn, $sqlGradeLevels);

        if (mysqli_num_rows($resultSections) > 0 && mysqli_num_rows($resultGradeLevels) > 0) {
            // Display the section and grade level selectors in a form
            echo "<form method='POST'>";
            echo "<div class='form-group'>";
            echo "<label for='section_id'>Select Section:</label>";
            echo "<select name='section_id' id='section_id'>";
            echo "<option value=''>Select Section</option>";
            while ($rowSection = mysqli_fetch_assoc($resultSections)) {
                $sectionId = $rowSection['id'];
                $sectionName = $rowSection['section_name'];
                echo "<option value='$sectionId'>$sectionName</option>";
            }
            echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='grade_level_id'>Select Grade Level:</label>";
            echo "<select name='grade_level_id' id='grade_level_id'>";
            echo "<option value=''>Select Grade Level</option>";
            while ($rowGradeLevel = mysqli_fetch_assoc($resultGradeLevels)) {
                $gradeLevelId = $rowGradeLevel['id'];
                $gradeLevelYear = $rowGradeLevel['year'];
                echo "<option value='$gradeLevelId'>$gradeLevelYear</option>";
            }
            echo "</select>";
            echo "</div>";

            echo "<input type='submit' value='Promote'>";
            echo "</form>";
        } else {
            echo "No sections or grade levels found.";
        }

        mysqli_close($conn);
        ?>
        <!-- Refresh button to reload the page -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <input type="submit" value="Refresh">
        </form>
        <!-- Back Button -->
        <a href="javascript:history.go(-1)" class="back-button">Go Back</a>
    </div>
</body>

</html>
