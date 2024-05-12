<?php
session_start();

if (!isset($_SESSION["user"])) {

}

if (isset($_POST["login"])) {
   
    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once "database.php";

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    $role = '';
    
    $adminEmail = "admin123@gmail.com";
    $adminPassword = "admin123";

    if ($email === $adminEmail && $password === $adminPassword) {
        
        $_SESSION["user"] = array(
            "email" => $adminEmail,
            
        );
        header("Location: admin-dashboard.php");
        die();
    }

    require_once "database.php";
    
    
    // $sql = "SELECT * FROM users WHERE email = '$email' AND role = '$role'";
    // $result = mysqli_query($conn, $sql);
    // $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    

    if ($user) {
        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user; 
            $role = $user["role"];
            if ($role === 'teacher') {
                header("Location: teacher-dashboard.php");
                exit();
            } elseif ($role === 'admin') {
                header("Location: admin-dashboard.php");
                exit();
            }
        } else {
            echo "<div class='alert alert-danger'>Password incorrect.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Email not found.</div>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Monitoring System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: white;
        }

        .new-header-bar {
            background-color: maroon;
            padding: 10px;
            display: flex;
            align-items: center;
            width: 100%;
            box-shadow: rgba(100, 100, 111, 0.4) 0px 7px 29px 0px;
        }

        .title-header-bar {
            white-space: nowrap;
            line-height: 1.2;
            margin-top: 5px;
            max-width: 600px;
            box-shadow: rgba(100, 100, 111, 0.4) 0px 7px 29px 0px;
        }

        .container-login {
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
            background-color: whitesmoke;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-btn {
            text-align: center;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="new-header-bar">
        <div class="title-header-bar tahoma32">
            <b style="color:white;font-size:20px;">OMNHS Grade Monitoring System</b><br>
        
            </p>
        </div>
    </div>

    <div class="container container-login">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <h3>Log in</h3>
                <input type="email" placeholder="Enter Email:" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control" required>
            </div>

            <div class="form-btn">
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </div>
        </form>
    </div>

</body>

</html>
