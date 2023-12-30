<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // $numbers = [1,44,55,22];
    // $fruits = array('apple','orange','pear',"rasha");
    // echo "<h1>";
    // print_r($fruits);
    // echo "<br>";
    // print_r($numbers);
    // echo "<br>";
    // var_dump($fruits);
    // echo "<br>";
    // var_dump($numbers);
    // echo "</h1>";
    // function rasha()
    // {
    //     $string1 = __FUNCTION__;
    //     $string2 = __METHOD__;
    //     // Display the results
    //     echo "<h1>".$string1;//! output: rasha
    //     echo "<br>";
    //     echo $string2."</h1>";//! output: rasha
    // }
    // class MyClass {
    //     function myMethod() {
    //         echo "<h1>".__METHOD__; //!output: MyClass:rasha
    //         echo "<br>";
    //         echo __FUNCTION__."</h1>";//! output: rasha
    //     }
    // }
    // rasha();
    // $myObject = new MyClass();

    // $myObject->myMethod();
    // 
    ?>


<?php
$hostname = 'localhost';
$username = 'root';
$password = ''; // Change this if you have a password set for your MySQL server

// Attempt to establish a connection
$conn = new mysqli($hostname, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Close the connection
$conn->close();
?>

</body>
</html>