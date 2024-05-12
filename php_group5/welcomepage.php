<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OMNHS Grading System</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: url("omnhs.jpg") no-repeat fixed;
  }
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
        .login{
          border:none;
          text-align:center;
          background:maroon;
          color:white;
          margin-top:-20px;
        }
        .container-login {
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
            background-color: whitesmoke;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
            margin-left: 50px;
            margin-top:20px;
            
        }
        .form-control{
          width:300px;
          height:30px;
        }
        .btn{
          background:blue;
          color:white;
          width:310px;
          margin-left:50px;
          height:30px;
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
            <b style="color:white;font-size:28px;">OMNHS Grade System</b><br>
        
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
          <div class="login">
            <h2>Log in</h2>
          </div>
                
                <div class="form-group">
                  <label for="text"><strong>Email</strong> </label>
                <input type="email" placeholder="Enter Email:" name="email" class="form-control" required>
            </div>
            <div class="form-group">
            <label for="text"><strong>Password</strong> </label>
                <input type="password" placeholder="Enter Password:" name="password" class="form-control" required>
            </div>

                <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
    </div>

</body>
</html>
