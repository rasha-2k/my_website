<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
</head>
<body>
    <?php
    include 'database_conn.php';
    include 'header.php';  // Assuming you have a header.php file with the navigation header
        session_start();
        // Check if the user is logged in
        if (isset($_SESSION['user']) && isset($_SESSION['fullname'])) 
        {
            // Get the user's full name from the session
            $fullname = $_SESSION['fullname'];
            echo "<h1>Welcome, $fullname!</h1>";
    ?>
    <p>Please choose what you want to see in the database:</p>
    <ul>
        <li><a href="view_data.php">View Data</a></li>
        <li><a href="search_data.php">Search Data</a></li>
        <!-- Add more options as needed -->
    </ul>
    <?php
        } else 
        {
            // Redirect the user to the login page if not logged in
            echo "<script>alert('Please log in first to go to the main page')</script>";
            header("Location: login.php");
            exit();
        }
    ?>
</body>
</html>
