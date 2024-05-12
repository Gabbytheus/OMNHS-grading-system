<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
$host = "localhost";
$username = "root";
$password = "";
$database = "users";



$connection = mysqli_connect($host, $username, $password, $database);


if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$passwordMessage = ""; 
$profileMessage = ""; 
$pictureMessage = ""; 
$userFullName = ""; 

if (isset($_SESSION["user"]["id"])) {
    $userId = $_SESSION["user"]["id"];
    
    
    $sql = "SELECT full_name FROM users WHERE id = $userId";
    $result = mysqli_query($connection, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userFullName = $row['full_name'];
    }
}

if (isset($_POST["change_password"])) {
    
}

if (isset($_POST["change_profile"])) {
    
}

if (isset($_POST["upload_picture"])) {
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMNHS Grading System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .header-bar {
        background-color: maroon;
        color: #fff;
        display: flex;
        align-items: center;
        padding: 10px;
    }

    .logo img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .title h1 {
        margin: 0;
    }

    .container {
        display: flex;
    }

    .sidebar {
        width: 200px;
        height: 674px;
        background-color: #f8f9fa;
        border-right: 1px solid #ccc;
        position: relative;
    }

    .profile-info {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid #ccc;
    }

    .tabs {
        padding: 10px;
    }

    .tab {
        display: block;
        width: 100%;
        padding: 10px;
        border: none;
        background-color: transparent;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .tab:hover {
        background-color: #e9ecef;
    }

    .tab.active {
        background-color: black;
        color: #fff;
    }

.main-content {
    flex: 1;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.1);
    background-image: url("omnhs.jpg"); 
    background-size: cover; 
    background-repeat: no-repeat; 
    background-attachment: fixed; 
    color: white; 

}


    .logout-btn {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        padding: 10px 20px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #tab7-content {
        padding: 20px;
        

    }

    #tab7-content h3 {
        margin-bottom: 15px;
        color: white;
    }

    #tab7-content form {
        margin-bottom: 20px;
    }

    #tab7-content form input[type="text"],
    #tab7-content form input[type="email"],
    #tab7-content form input[type="password"],
    #tab7-content form input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    #tab7-content form button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    #tab7-content form button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .message {
        margin-top: 10px;
        color: green;
        font-weight: bold;
    }
</style>

<body>
    <div class="header-bar">
        <div class="logo">

        </div>
        <div class="title">
            <h1>OMNHS Grading System</h1>
        </div>
    </div>
    <div class="container">
        <div class="sidebar">

            <div class="tabs">
                <img src="" alt="Profile Picture" id="profilepic">
                <div class="profile-info">
               <strong><?php echo $userFullName; ?></strong>
                </div>
                <button class="tab active" onclick="openTab(event, 'tab1')">Home</button>
                <button class="tab" onclick="openTab(event, 'tab2')">Student List</button>
                <button class="tab" onclick="openTab(event, 'tab3')">Grading</button>
                <button class="tab" onclick="openTab(event, 'tab4')">Reports</button>
                <button class="tab" onclick="openTab(event, 'tab5')">Promote Students</button>
                <button class="tab" onclick="openTab(event, 'tab6')">Add Student</button>
                <button class="tab" onclick="openTab(event, 'tab7')">Settings</button>
                <!-- <button class="tab" onclick="openTab(event, 'tab8')">Settings</button> -->

            </div>
            <form action="logout.php" method="post">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        <div class="main-content" id="main-content">
            <h1>Welcome to OMNHS Grading System</h1>

            <div id="tab1-content" class="tabcontent">

            <iframe src="home.php" frameborder="0" style="width: 100%; height: 100vh; overflow: hidden;"></iframe>

            </div>
            
            <div id="tab2-content" class="tabcontent" style="display: none;">
            <iframe src="student_list.php" frameborder="0" style="width: 100%; height: 100vh; overflow: hidden;"></iframe>

            </div>
            <div id="tab3-content" class="tabcontent" style="display: none;">
            <iframe src="process_grades.php" frameborder="0" style="width: 100%; height: 100vh; overflow: hidden;"></iframe>

            </div>
            <div id="tab4-content" class="tabcontent" style="display: none;">
            <iframe src="report_card.php" frameborder="0" style="width: 100%; height: 100vh; overflow: hidden;"></iframe>

            </div>
            <div id="tab5-content" class="tabcontent" style="display: none;">
            <iframe src="promote_students.php" frameborder="0" style="width: 100%; height: 100vh; overflow: hidden;"></iframe>

            <</div>
            <div id="tab6-content" class="tabcontent" style="display: none;">
            <iframe src="process_student.php" frameborder="0" style="width: 100%; height: 100vh; overflow: hidden;"></iframe>

            </div>
            <div id="tab7-content" class="tabcontent" style="display: none;">
                <h3>Change Password</h3>
                <form action="change_password.php" method="post">
                    <input type="password" name="old_password" placeholder="Old Password"><br>
                    <input type="password" name="new_password" placeholder="New Password"><br>
                    <input type="password" name="confirm_password" placeholder="Confirm New Password"><br>
                    <button type="submit" name="change_password">Change Password</button>
                </form>

                <h3>Change Name and Email</h3>
                <form action="change_profile.php" method="post">
                    <input type="text" name="new_name" placeholder="New Name"><br>
                    <input type="email" name="new_email" placeholder="New Email"><br>
                    <button type="submit" name="change_profile">Change Profile</button>
                </form>

                <h3>Set Profile Picture</h3>
                <form action="upload_picture.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="profile_picture"><br>
                    <button type="submit" name="upload_picture">Upload Picture</button>
                </form>

                
                <div class="message"><?php echo $passwordMessage; ?></div>
                <div class="message"><?php echo $profileMessage; ?></div>
                <div class="message"><?php echo $pictureMessage; ?></div>
            </div>

        <!-- <div id="tab8-content" class="tabcontent" style="display: none;">
            
        </div> -->
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName + "-content").style.display = "block";
            evt.currentTarget.className += " active";
        }


        document.getElementsByClassName("tab")[0].click();

        //for account tab
        function createForm(containerId, formId, fields, buttonText, action) {
            const container = document.getElementById(containerId);
            const form = document.createElement('form');
            form.id = formId;
            form.action = action;
            form.method = 'post';

            fields.forEach(field => {
                const input = document.createElement('input');
                input.type = field.type || 'text'; 
                input.name = field.name;
                input.placeholder = field.placeholder;
                form.appendChild(input);
            });

            const submitBtn = document.createElement('button');
            submitBtn.type = 'submit';
            submitBtn.innerText = buttonText;
            form.appendChild(submitBtn);

            container.appendChild(form);
        }

        document.addEventListener('DOMContentLoaded', () => {
           
            createForm('changePasswordForm', 'changePasswordForm', [{
                    name: 'old_password',
                    placeholder: 'Old Password',
                    type: 'password'
                },
                {
                    name: 'new_password',
                    placeholder: 'New Password',
                    type: 'password'
                },
                {
                    name: 'confirm_password',
                    placeholder: 'Confirm New Password',
                    type: 'password'
                }
            ], 'Change Password', 'change_password.php');

            createForm('changeProfileForm', 'changeProfileForm', [{
                    name: 'new_name',
                    placeholder: 'New Name'
                },
                {
                    name: 'new_email',
                    placeholder: 'New Email'
                }
            ], 'Change Profile', 'change_profile.php');

            createForm('uploadPictureForm', 'uploadPictureForm', [{
                name: 'profile_picture',
                placeholder: 'Choose Profile Picture',
                type: 'file'
            }], 'Upload Picture', 'upload_picture.php');
        });
    </script>
</body>

</html>