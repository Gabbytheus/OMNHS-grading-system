<?php


?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: grey;
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
            margin-top: 100px;
            background-color: whitesmoke;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-top:30px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-btn {
            text-align: center;
        }

        .register-link {
            text-align: center;
            margin-top: 30px;
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
        
        <form action="login.php" method="post">
                <h3 style="text-decoration: underline overline;">Create Account</h3>
                <div class="form-group">
                <a href="register.php" class="login-button"><strong>Student</strong></a> <br><br>
            <a href="register.php" class="login-button"><strong>Teacher</strong></a>
                    </div>
            
            <div class="form-group">
            
                
            </div>
            <div class="form-btn">
            </div>
        </form>
    </div>

</body>

</html>
