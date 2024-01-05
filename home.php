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
        include("connection.php");					
        $result = mysqli_query($mysqli, "SELECT * FROM login");
        echo "Welcome".$_SESSION['name']." !";
    } 
    else 
    {
        echo "<script>alert('You must be logged in to view this page.')</script>";
        header("Location: login.php");
    }
    ?>

</body>
</html>
