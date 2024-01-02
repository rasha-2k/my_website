<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

    form {
      border: 2px solid #ccc;
      max-width: 700px;
      width: 100%;
      box-sizing: border-box;
      padding: 20px;
    }
    
    .inputt
    {
      width: 100%;
      padding: 15px;
      margin: 5px 500px 22px 0;
      display: inline-block;
      border: none;
      border-radius: 4px;
      background: #f1f1f1;
    }

    #signupbtn span:after 
    {
      content: '\00bb';
      opacity: 0;
      top: 0;
      right: -20px;
      transition: 0.5s;
    }
    hr 
    {
      border: 1px solid #acacac;
      margin-bottom: 25px;
    }
    #canclebtn 
    {
      background-color: #f44336;
    }
    #signupbtn
    {
      background-color: #4CAF50;
    }
    .every-thing
    {
      padding: 16px;
    }
    #container
    {
      display: flex;
      align-content: center;
      justify-content: center;
    }
    #login
    {
    text-decoration: none;
    }
    #signupbtn:hover,#canclebtn:hover
    {
        opacity:1;
    }
    
    #signupbtn,#canclebtn 
    {
      width: 100%;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      opacity: 0.8;
    }
    </style>

    <title>Sign Up Page</title>
</head>
<body>
  <?php 
  include 'header.php'
  ?>
<?php
include_once "database_conn.php";

if (isset($_POST["submit"])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $birthdate = $_POST['birthdate'];
    $major = $_POST['major'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $psw_repeat = $_POST['psw_repeat'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $errors = array();

    // Validation and error handling code...

    if (empty($fullname) || empty($id) || empty($major) || empty($email) || empty($password) || empty($psw_repeat)) {
        array_push($errors, "All fields are required");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }

    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }

    if ($password !== $psw_repeat) {
        array_push($errors, "Password does not match");
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        array_push($errors, "Email already exists!");
    }

    if (count($errors) == 0) {
        $sql = "INSERT INTO users (ID, full_name, birthdate, major, email, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssss", $id, $fullname, $birthdate, $major, $email, $password_hash);
            $result = mysqli_stmt_execute($stmt);

            if (!$result) {
                // Check for duplicate entry error (error code 1062)
                if (mysqli_errno($conn) == 1062) {
                    echo "<script>alert('Email or ID already exists! Please choose a different Email or ID.')</script>";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "<script>alert('You are registered successfully.')</script>";
            }

            mysqli_stmt_close($stmt);
        } else {
            die("Something went wrong: " . mysqli_error($conn));
        }
    } else {
        // Display all errors
        foreach ($errors as $error) {
            echo "<script>alert('$error')</script>";
        }
    }
}

mysqli_close($conn);
?>

<div id="container">
  <form action="signup.php" method="POST" style="border: 2px solid #ccc">
      <div class="every-thing">
      <h1>Sign Up</h1>
      
      <hr>
      <label>
      <input type="text" placeholder="Enter your ID" name="id" class= "inputt" maxlength="9" ></label>
      <br>
      <label>
      <input type="text" placeholder="Enter your Full name" name="fullname" class= "inputt" maxlength="50"></label>
      <br>
      <label>
      <input type="date" placeholder="Enter your Birth Date" name="birthdate" class= "inputt"></label>
      <br>
      <label>
      <input type="text" placeholder="Enter your Major" name="major" class= "inputt" maxlength="30"></label>
      <br>
      <label>
      <input type="email" placeholder="Enter your Email" name="email" class= "inputt" maxlength="255"></label>
      <br>
      <label >
      <input type="password" placeholder="Enter a Password" name="psw" class= "inputt" maxlength="50"></label>
      <br>
      <label >
      <input type="password" placeholder="Repeat Password" name="psw_repeat"  class= "inputt" maxlength="50"></label>

      <hr>
      <div class="clearfix">
        <input type="submit" name="submit" id="signupbtn" class="button" value = "Sign Up">
        <input type="reset" name="reset" id="canclebtn" class="button" value = "Cancle">
          <br><br>
        <p>Have an account? <a href="login.php" id="login"><b>Log in</b></a></p>
        </div>
      </div>
    </div>
  </form>
</div>
</body>
</html>