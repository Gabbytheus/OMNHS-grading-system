<!-- <?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background-color: #CCCCCC;
            margin: 0; 
            transition: background-color 0.5s ease;
        }

        body.dark-mode {
            background-color: #333; 
            color: #fff; 
        }

        .new-header-bar {
    background-color: #1E1E1E;
    padding: 10px;
    display: flex;
    align-items: center;
    width: 100%;
}

        .title-header-bar {
            white-space: nowrap;
            line-height: 1.2;
            margin-top: 5px;
            max-width: 600px;
            
        }

        .container-dashboard {
            display: flex;
            min-height: 100vh; 
        }

        .dashboard-menu {
    width: 20%;
    padding: 20px;
    background-color: #f8f9fa; 
    transition: background-color 0.5s ease; 
}
body.dark-mode .dashboard-menu {
    background-color: #000; 
    color: #fff; 
}

        .dashboard-content {
            flex: 1;
            margin: 20px;
            text-align: center;
        }

        .dashboard-buttons {
            margin-bottom: 20px;
        }

        .dashboard-buttons a {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #007bff; 
            color: #ffffff; 
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .dashboard-buttons a:hover {
            background-color: #0056b3; 
        }

        .logout-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            margin-top: auto; 
            
        }
        .dark-mode-btn {
            position: fixed;
            top: 20px;
            right: 20px;
        }
        
    </style>

</head>

<body>

    <div class="new-header-bar">
        <div class="title-header-bar tahoma32">
            <b style="color:#CCCCCC;">Occidental Mindoro State College</b><br>
            <p class="tahoma14">
                <font style="font-size:20px;color:#CCCCCC;">OMSC College Grading System</font><br>
            </p>
        </div>
        
    </div>
    

    <div class="container-dashboard">
        <div class="dashboard-menu">
            <div class="dashboard-buttons">
                <a href="#" class="btn btn-primary">Subject</a>
                <a href="#" class="btn btn-primary">Student List</a>
                <a href="#" class="btn btn-primary">Account</a>
                    
    <button onclick="toggleDarkMode()">Toggle Dark Mode</button>

<script>
    
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
    }
</script>
            </div>
        </div>
        <div class="dashboard-content">
            <h1>ONLINE GRADING</h1>
            <div class="overview-text">
                <p>Welcome to the OMSC College Grading System!</p>
                <p>Our online grading system provides students with easy access to their academic information, including subject grades, student lists, and account details. Navigate through the menu to explore different features and manage your academic journey efficiently.</p>
            </div>
            
        </div>
    </div>
    </div>

    <a href="logout.php" class="btn btn-warning logout-btn">Logout</a>
    



</body>

</html> -->
