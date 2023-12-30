<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Data</title>
</head>
<body>
    <?php
        include 'header.php';  // Assuming you have a header.php file with the navigation header
        session_start();
        // Check if the user is logged in
        if (isset($_SESSION['user'])) {
            // You can perform any database queries or display search options here
            echo "<h1>Search Data</h1>";
            echo "<p>This is the search data page. You can provide search options and display search results here.</p>";
        } else {
            // Redirect the user to the login page if not logged in
            header("Location: login.php");
            exit();
        }
    ?>
</body>
</html>
