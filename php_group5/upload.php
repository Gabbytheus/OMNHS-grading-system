<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file_upload"]) && isset($_POST["student_id"])) {
    $studentId = $_POST["student_id"];
    $file = $_FILES["file_upload"];

    // Specify the directory to upload files
    $uploadDir = 'uploads/';

    // Generate a unique filename
    $fileName = $uploadDir . basename($file["name"]);

    // Move uploaded file to the specified directory
    if (move_uploaded_file($file["tmp_name"], $fileName)) {
        echo "File uploaded successfully for student ID: $studentId.";
        // Save student ID and file details to a database or file
        // You can store $studentId and $fileName in a database for record keeping
    } else {
        echo "Error uploading file.";
    }
} else {
    // Redirect back to the form page if accessed directly
    header("Location: upload.html");
    exit();
}
?>
