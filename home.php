<?php
session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Dashboard</title>
</head>
<body class="p-3 m-0 border-0 bd-example m-0 border-0">
    <?php 
    include 'header.php';
    include 'database_conn.php';
    ?>

    <h1>Please choose what you want to see in the database:</h1>
    <ul>
        <h2><li><a href="order.php">View Data</a></li></h2>
        <h2><li><a href="search_data.php">Search Data</a></li></h2>
        <!-- Add more options as needed -->
    </ul>

</body>
</html>
