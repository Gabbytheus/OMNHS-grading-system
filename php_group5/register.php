<?php
session_start();

if (isset($_POST["submit"])) {
    $fullName = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];
    $selectedRole = $_POST["role"];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();

    if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat) OR empty($selectedRole)) {
        array_push($errors, "All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    if ($password !== $passwordRepeat) {
        array_push($errors, "Password does not match");
    }

    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);

    
    if ($rowCount > 0) {
        array_push($errors, "Email already exists!");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        echo "<div class='alert alert-success'>Registered successfully. <a href='register.php' class='btn btn-primary'>Register Again</a></div>";

        
        $sql = "INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $fullName, $email, $passwordHash, $selectedRole);
            mysqli_stmt_execute($stmt);
        } else {
            echo "<div class='alert alert-danger'>Something went wrong</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: grey;
            background-image: url('C:\xampp\htdocs\php_gproj\imagebg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
        }

        .new-header-bar {
            background-color: maroon;
            padding: 20px;
            display: flex;
            align-items: center;
            width: 100%;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .title-header-bar {
            line-height: 0.5;
            margin-top: 2px;
            max-width: 600px;
            box-shadow: rgba(100, 100, 111, 0.4) 0px 7px 29px 0px;
        }
        .btn{
            background-color:maroon;
            color:white;
        }
        .container{
            background-color:whitesmoke;
            padding: 20px;
        }
    </style>
</head>

<body>

<div class="new-header-bar">
        <div class="title-header-bar tahoma32">
            <b style="color:white;font-size:20px">OMNHS Grade Monitoring System</b><br>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Registration Form</h3>
            </div>
            <div class="card-body">
                <form action="register.php" method="post">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name:</label>
                        <input type="text" class="form-control" name="fullname" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="repeat_password" class="form-label">Repeat Password:</label>
                        <input type="password" class="form-control" name="repeat_password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="role" class="form-label">Select Role:</label>
                        <select name="role" class="form-control" required>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="submit">Create Account</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                
            </div>
        </div>
    </div>

</body>

</html>
