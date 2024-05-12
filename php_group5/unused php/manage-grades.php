<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Management - Grading Percentages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type='number'] {
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }

        .error {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Grade Management - Grading Percentages</h1>
        <?php if (isset($message)) : ?>
            <div class="message success"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="written_work_percentage">Written Work Percentage:</label>
            <input type="number" id="written_work_percentage" name="written_work_percentage" min="0" max="100" value="<?php echo $gradingConfig['written_work_percentage']; ?>" required><br><br>
            <label for="performance_task_percentage">Performance Task Percentage:</label>
            <input type="number" id="performance_task_percentage" name="performance_task_percentage" min="0" max="100" value="<?php echo $gradingConfig['performance_task_percentage']; ?>" required><br><br>
            <label for="quarterly_assessment_percentage">Quarterly Assessment Percentage:</label>
            <input type="number" id="quarterly_assessment_percentage" name="quarterly_assessment_percentage" min="0" max="100" value="<?php echo $gradingConfig['quarterly_assessment_percentage']; ?>" required><br><br>
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>

</html>
