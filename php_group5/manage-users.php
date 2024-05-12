<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "users";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch users from the database
$sqlUsers = "SELECT * FROM users";
$resultUsers = mysqli_query($conn, $sqlUsers);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    $userId = $_POST['delete_user'];
    
    // Delete user from the database
    $sqlDelete = "DELETE FROM users WHERE id = '$userId'";
    if (mysqli_query($conn, $sqlDelete)) {
        echo "<script>alert('User deleted successfully');</script>";
        // Refresh the page to reflect changes
        echo "<script>window.location.href = 'manage-users.php';</script>";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .add-user-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .add-user-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .btn-container {
            margin-bottom: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Manage Teachers</h1>

        <div class="btn-container">
            <a href="register2.php" class="add-user-btn" target="_blank">Add User</a>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($resultUsers)) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td>
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="delete_user" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>

</html>
