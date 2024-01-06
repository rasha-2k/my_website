<?php
session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home page</title>
</head>
<body class="p-3 m-0 border-0 bd-example m-0 border-0">
    <?php 
    include 'header.php';
    include 'database_conn.php';
    ?>
    <?php
    if(isset($_SESSION['valid'])) 
    {			
        include("database_conn.php");					
        $result = mysqli_query($conn, "SELECT * FROM users");
        echo "<h1>Welcome ".$_SESSION['full_name']." !</h1>";
    } 

    ?>

</body>
</html>
