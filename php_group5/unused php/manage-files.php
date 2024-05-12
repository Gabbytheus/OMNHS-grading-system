<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Upload File</h1>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="student_id">Select Student:</label>
                <select id="student_id" name="student_id" class="form-control" required>
                    <option value="">Select a student</option>
                    <!-- PHP code to populate dropdown options -->
                    <?php
                    $hostName = "localhost";
                    $dbUser = "root";
                    $dbPassword = "";
                    $dbName = "users";

                    $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

                    if (!$conn) {
                        die("Database connection failed: " . mysqli_connect_error());
                    }

                    $sqlStudents = "SELECT student_id, student_name FROM students";
                    $resultStudents = mysqli_query($conn, $sqlStudents);

                    if (mysqli_num_rows($resultStudents) > 0) {
                        while ($row = mysqli_fetch_assoc($resultStudents)) {
                            echo "<option value='" . $row['student_id'] . "'>" . $row['student_name'] . "</option>";
                        }
                    }

                    mysqli_close($conn);
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="file_upload">Choose File:</label>
                <input type="file" id="file_upload" name="file_upload" class="form-control-file" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
