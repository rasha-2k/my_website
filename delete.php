<?php
    include 'header.php';
    include 'database_conn.php';
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home_style.css">
    <style> 
    body {
        height: 100vh;
        margin: 0;
    }
    .inputt {
        padding: 15px;
        margin: 5px 500px 22px 0;
        width: 100%;
        border: none;
        border-radius: 4px;
        background: #f1f1f1;
    }
    .button:hover {
        opacity: 1;
    }
    .button {
        color: #f1f1f1;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        width: 100%;
        opacity: 0.8;
    }
    form {
        border: 2px solid #ccc;
        max-width: 500px;
        width: 100%;
        box-sizing: border-box;
        padding: 20px;
    }
    label {
        display: block;
        margin-bottom: 15px;
    }
    #container{
      display: flex;
      align-content: center;
      justify-content: center;

    }
    </style>
    <?php 

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $IDToDelete = $_POST['id'];
        
        // Perform the deletion in the database
        $sql = "DELETE FROM users WHERE ID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt) 
        {
            mysqli_stmt_bind_param($stmt, "s", $IDToDelete);
            mysqli_stmt_execute($stmt);
            
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<script>alert('User has been deleted successfully.')</script>";
            } 
            else 
            {
                echo "<script>alert('User not found.')</script>";
            }
            mysqli_stmt_close($stmt);
        } 
        else 
        {
            echo "Error in preparing the delete statement.";
        }
    }
    
    mysqli_close($conn);
    ?>
    <title>Delete a user</title>
</head>
<body>
    <div id="container">
        <form method="POST">
            <p>
                <label>Insert account ID that you want to delete:<br>
                    <input name="id" type="text" class="inputt" placeholder="Enter the ID here" required>
                </label>
            </p>
            <hr>
            <p>
                <input type="submit" value="Submit" class="button" style="background-color: #4CAF50;">
                <input type="reset" value="Clear" class="button" style="background-color: #f44336;">
            </p>   
        </form>
    </div>
</body>
</html>
