<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            background-color: rgba(255, 255, 255, 0.0);

            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="submit"],
        select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        #subjects {
            margin-top: 10px;
        }

        #subjects p {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
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
    if (isset($_POST['new_section'])) {
        $newSection = $_POST['new_section'];
        $sectionType = isset($_POST['section_type']) ? $_POST['section_type'] : ''; 

        
        $sqlInsertSection = "INSERT INTO sections (section_name, section_type) VALUES ('$newSection', '$sectionType')";
        if (mysqli_query($conn, $sqlInsertSection)) {
            echo "<script>alert('New section added successfully');</script>";
        } else {
            echo "Error: " . $sqlInsertSection . "<br>" . mysqli_error($conn);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $grade = isset($_POST['grade']) ? $_POST['grade'] : '';
    $studentType = isset($_POST['student_type']) ? $_POST['student_type'] : '';
    $sectionId = isset($_POST['section']) ? $_POST['section'] : '';

    
    $isScience = ($studentType === 'Science') ? 1 : 0;

    
    $sqlGradeLevel = "SELECT id FROM grade_level WHERE year = '$grade'";
    $resultGradeLevel = mysqli_query($conn, $sqlGradeLevel);

    if ($resultGradeLevel && mysqli_num_rows($resultGradeLevel) > 0) {
        $row = mysqli_fetch_assoc($resultGradeLevel);
        $gradeLevelId = $row['id'];

        $sqlStudent = "INSERT INTO students (student_name, grade_level, grade_level_id, is_science, section_id) 
            VALUES ('$name', '$grade', '$gradeLevelId', '$isScience', '$sectionId')";

        if (mysqli_query($conn, $sqlStudent)) {
            
            echo "<script>alert('Student added successfully');</script>";
        } else {
            echo "Error: " . $sqlStudent . "<br>" . mysqli_error($conn);
        }
    } else {
        
    }
    $sqlSections = "SELECT * FROM sections";
    $resultSections = mysqli_query($conn, $sqlSections);
}

mysqli_close($conn);
?>

<div class="container">
    <h2>Add New Section</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="new_section">New Section:</label>
        <input type="text" id="new_section" name="new_section" required>

        <label for="section_type">Section Type:</label>
        <input type="radio" id="regular" name="section_type" value="Regular" required>
        <label for="regular">Regular</label>
        <input type="radio" id="science" name="section_type" value="Science" required>
        <label for="science">Science</label>

        <input type="submit" value="Add Section">
    </form>
</div>



<div class="container">
    <h2>Add Student</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="grade">Grade Level:</label>
        <select id="grade" name="grade" onchange="showSubjects(this.value)" required>
            <option value="">Select Grade Level</option>
            <option value="7">Grade 7</option>
            <option value="8">Grade 8</option>
            <option value="9">Grade 9</option>
            <option value="10">Grade 10</option>
        </select>

        <label for="student_type">Student Type:</label>
        <input type="radio" id="regular" name="student_type" value="Regular" required>
        <label for="regular">Regular</label>
        <input type="radio" id="science" name="student_type" value="Science" required>
        <label for="science">Science</label>

        <label for="section">Section:</label>
        <select id="section" name="section" required>
            <option value="">Select Section</option>
            <?php
            while ($row = mysqli_fetch_assoc($resultSections)) {
                echo "<option value='{$row['id']}'>{$row['section_name']}</option>";
            }
            ?>
        </select>

        <div id="subjects"></div>

        <input type="submit" value="Add Student">
    </form>
</div>


<script>
    function showSubjects(grade) {
        let subjects = 'Subjects: <br>';
        if (grade === '7' || grade === '8') {
            subjects += 'Mapeh<br>Science<br>TLE<br>Math<br>English<br>Filipino<br>ESP<br>AP';
        } else if (grade === '9' || grade === '10') {
            subjects += 'Math<br>Science<br>English<br>ESP<br>Filipino<br>TLE (Research for SSC)<br>AP<br>Mapeh';
        }
        document.getElementById('subjects').innerHTML = subjects;
    }
</script>
</body>
</html>
