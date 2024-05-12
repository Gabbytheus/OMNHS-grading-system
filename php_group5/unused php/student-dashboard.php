<?php
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
    <title>/ Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/70536da3dc.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: skyblue;
            margin: 0; 
            transition: background-color 0.5s ease;
        }
        .dash{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            height:130px;
            margin-top: -10px;
            text-align: center;
        }

        body.dark-mode {
            background-color: #333; 
            color: #fff; 
        }

        .new-header-bar {
    background-color: grey;
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
            min-height: 92vh; 
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
            margin-top:5px;
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
        .dark-mode-btn {
            position: fixed;
            top: 20px;
            right: 20px;
        }
        .dark{
            margin-top:80px
        }
        .searchbox{
    margin-left: 260px;
    margin-top:-480px;
  }
  
  .sbut{
    margin-left: -30px;
    width: 90px;
    height:25px;
    background: transparent;
    border: none;
  }
  .sbut .fa-solid{
  cursor: pointer;
  width: 10px;
  color: #555;
  font-size: 16px;
}
.box{
  display:flex;
  margin-top:-320px;
  margin-left:250px;
}
  #input{
    background: white;
    border-radius: 5px;
    border: 0;
    outline: 0;
    font-size: 14px;
    color: #333;
  }

.student{
  margin-top: 550px;
  color: white;
  border: 1px;
  background-color: orange;
  width: 350px;
  height: 150px;
  border-radius:8px ;
  margin-left: 50px;
}
.student .fa-solid{
  font-size: 72px;
  padding: 10px 5px;
}
p{
  margin-left: 15px;
  margin-top: -10px;
}
.view{
  border: 1px solid;
  border-color: orange;
  background-color: whitesmoke;
  color: #333;
  height: 45px;
}
.view .fa-solid{
  font-size: 16px;
  margin-left: 220px;
  color: #333; 
}
.view p{
  color: orange;
  margin-top: 5px;
}
.teacher{
  margin-top: 30px;
  color: white;
  border: 1px;
  background-color: grey;
  width: 350px;
  height: 150px;
  border-radius:8px ;
  margin-left: 50px;
}
.teacher .fa-solid{
  font-size: 72px;
  padding: 10px 5px;
}
.viewt{
  border: 1px solid;
  border-color: grey;
  background-color: whitesmoke;
  height: 45px;
}
.viewt .fa-solid{
  font-size: 16px;
  margin-left: 220px;
  color: grey;
}
.viewt p{
  color: grey;
  margin-top: 5px;
}
.details{
  display: -moz-grid;
}
.subject{
  margin-top: -330px;
  margin-left: 500px;
  color: white;
  border: 1px;
  background-color: green;
  width: 350px;
  height: 150px;
  border-radius:8px ;
}
.subject .fa-solid{
  font-size: 72px;
  padding: 10px 5px;
}
.views{
  border: 1px solid;
  border-color: green;
  background-color: whitesmoke;
  height: 45px;
}
.views .fa-solid{ 
  font-size: 16px;
  margin-left: 220px;
  color: #333;
}
.views p{
  color: green;
  margin-top: 5px;
}
        
    </style>

</head>

<body>

    <div class="new-header-bar">
        <div class="title-header-bar tahoma32">
            <b style="color:white;font-size:20px;">Grade Monitoring System</b><br>

        </div>
        
    </div>
    

    <div class="container-dashboard">
        <div class="dashboard-menu">
       <div class= "dash">
            <i class="fa-solid fa-user-tie"></i>
                <h1></h1>
            <p style="color:lightgrey;margin-top:80px;">Teacher</p>
        </div>
        
            <div class="dashboard-buttons">
                <a href="#" class="btn btn-primary">Subject</a>
                <a href="#" class="btn btn-primary">Student List</a>
                <a href="#" class="btn btn-primary">Account</a>
    </div>
    <div class="box">
                <input type="text" placeholder="Search" autocomplete="off">
                <button class="sbut"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            
    <div class="rect">
        <div class="searchbox">
                <div class="details">
                <div class="student">
                    <i class="fa-solid fa-user-large">0</i>
                    <p>Student!</p>
                <div class="view">
                     <p>View Details<i class="fa-solid fa-arrow-right"></i></p>
                </div>
                </div>
                <div class="teacher">
                    <i class="fa-solid fa-user-large">0</i>
                    <p>Teacher!</p>
                <div class="viewt">
                     <p>View Details<i class="fa-solid fa-arrow-right"></i></p>
                </div>
                </div>
                <div class="subject">
                    <i class="fa-solid fa-user-large">0</i>
                    <p>Subject!</p>
                <div class="views">
                     <p>View Details<i class="fa-solid fa-arrow-right"></i></p>
                </div>
            </div>
        </div>
    </div>       
    <button onclick="toggleDarkMode()" class="dark">Dark Mode</button><br>
    <br><br><br><br><br><br><br>
    <a href="logout.php" class="btn-logout">Logout</a>
<script>
    
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
    }
</script>
            </div>
        </div>
    </div>

    
    



</body>

</html>
