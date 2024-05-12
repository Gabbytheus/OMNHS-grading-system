

<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$targetDirectory = "profile_pictures/";
$uploadOk = 1;
$pictureMessage = "";

if (isset($_FILES["profile_picture"])) {
    $targetFile = $targetDirectory . basename($_FILES["profile_picture"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
        $pictureMessage = "File is not an image.";
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        $uploadOk = 0;
        $pictureMessage = "Sorry, file already exists.";
    }

    // Check file size
    if ($_FILES["profile_picture"]["size"] > 500000) {
        $uploadOk = 0;
        $pictureMessage = "Sorry, your file is too large.";
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
        $pictureMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $pictureMessage = "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
            $pictureMessage = "The file " . basename($_FILES["profile_picture"]["name"]) . " has been uploaded.";
        } else {
            $pictureMessage = "Sorry, there was an error uploading your file.";
        }
    }
} else {
    
}

// Display message
echo $pictureMessage;
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
        background-color: black;
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
        bottom: 0;
        overflow-y: auto;
       
    }


    .profile-info {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid #ccc;
        margin-bottom: 20px;
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
    }

    .logout-btn {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        padding: 10px 20px;
        background-color: black;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
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
                <img src="" alt="Profile Picture">
                <div class="profile-info">
                    <h2>ADMIN</h2>
                </div>
                <button class="tab active" onclick="openTab(event, 'tab1')">Manage Users</button>
                <button class="tab" onclick="openTab(event, 'tab2')">Subject</button>
                <!-- <button class="tab" onclick="openTab(event, 'tab3')">Grade Management</button> -->
                <button class="tab" onclick="openTab(event, 'tab5')">Student</button>
                <!-- <button class="tab" onclick="openTab(event, 'tab7')">Files Management</button> -->
                <button class="tab" onclick="openTab(event, 'tab4')">Add Account</button>
                <!-- <button class="tab" onclick="openTab(event, 'tab5')">Account</button> -->
                <button class="tab" onclick="openTab(event, 'tab6')">Settings</button>

            </div>
            <form action="logout.php" method="post">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        <div class="main-content" id="main-content">
            <h1>Welcome to OMNHS Grading System</h1>

        <div id="tab1-content" class="tabcontent" style="display: none;">
        <iframe src="manage-users.php" frameborder="0" style="width: 100%; height: 100vh; overflow: hidden;"></iframe>



        </div>
        <!-- <div id="tab7-content" class="tabcontent" style="display: none;">
        <iframe src="manage-files.php" frameborder="0" style="width: 100%; height: 100vh; overflow: hidden;"></iframe>

        </div> -->
        <div id="tab2-content" class="tabcontent" style="display: none;">
        <iframe src="manage-subjects.php" frameborder="0" style="width: 100%; height: 100vh; overflow: hidden;"></iframe>

        </div>
        <!-- <div id="tab3-content" class="tabcontent" style="display: none;">
        <iframe src="manage-grades.php" frameborder="0" style="width: 100%; height: 100vh; overflow: hidden;"></iframe>

        </div> -->
        <div id="tab4-content" class="tabcontent" style="display: none;">
            <iframe src="register.php" frameborder="0" style="width: 100%; height: 100vh; overflow: hidden;"></iframe>
        </div>
        <!-- <div id="tab5-content" class="tabcontent" style="display: none;">
        
        <div class="container"> -->
        <!-- Change Password Form -->
        <!-- <h3>Change Password</h3> -->
        <!-- <?php echo $passwordMessage; ?> Display password change messages -->
        <!-- <form action="change_password.php" method="post"> -->
            <!-- Password input fields and submit button -->
        <!-- </form> -->

        <!-- Change Name and Email Form -->
        <!-- <h3>Change Name and Email</h3> -->
        <!-- <?php echo $profileMessage; ?>  -->
        <!-- <form action="change_profile.php" method="post"> -->
            <!-- Name, email input fields and submit button -->
        <!-- </form> -->

        <!-- Set Profile Picture Form -->
        <!-- <h3>Set Profile Picture</h3> -->
        <!-- <?php echo $pictureMessage; ?> Display picture upload messages -->
        <!-- <form action="upload_picture.php" method="post" enctype="multipart/form-data"> -->
            <!-- File input for picture and submit button -->
        <!-- </form> -->
        
        <!-- </div> -->
        <div id="tab6-content" class="tabcontent" style="display: none;">
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
                <!-- <div class="message"><?php echo $passwordMessage; ?></div>
                <div class="message"><?php echo $profileMessage; ?></div> -->
                <div class="message"><?php echo $pictureMessage; ?></div>
            </div>
        <div id="tab5-content" class="tabcontent" style="display: none;">
        <iframe src="manage-students.php" frameborder="0" style="width: 100%; height: 100vh; overflow: hidden;"></iframe>

        </div>

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


        // function createForm(containerId, formId, fields, buttonText, action) {
        //     const container = document.getElementById(containerId);
        //     const form = document.createElement('form');
        //     form.id = formId;
        //     form.action = action;
        //     form.method = 'post';

        //     fields.forEach(field => {
        //         const input = document.createElement('input');
        //         input.type = 'text'; // Change input type based on your requirements (password, text, file, etc.)
        //         input.name = field.name;
        //         input.placeholder = field.placeholder;
        //         form.appendChild(input);
        //     });

        //     const submitBtn = document.createElement('button');
        //     submitBtn.type = 'submit';
        //     submitBtn.innerText = buttonText;
        //     form.appendChild(submitBtn);

        //     container.appendChild(form);
        // }

        // document.addEventListener('DOMContentLoaded', () => {
        //     // Change Password Form
        //     createForm('changePasswordForm', 'changePasswordForm', [
        //         { name: 'old_password', placeholder: 'Old Password' },
        //         { name: 'new_password', placeholder: 'New Password' },
        //         { name: 'confirm_password', placeholder: 'Confirm New Password' }
        //     ], 'Change Password', 'change_password.php');

        //     // Change Name and Email Form
        //     createForm('changeProfileForm', 'changeProfileForm', [
        //         { name: 'new_name', placeholder: 'New Name' },
        //         { name: 'new_email', placeholder: 'New Email' }
        //     ], 'Change Profile', 'change_profile.php');

        //     // Set Profile Picture Form
        //     createForm('uploadPictureForm', 'uploadPictureForm', [
        //         { name: 'profile_picture', placeholder: 'Choose Profile Picture', type: 'file' }
        //     ], 'Upload Picture', 'upload_picture.php');
        // });

    </script>
</body>

</html>