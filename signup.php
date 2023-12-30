<?php
session_start();
?>
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
    
    .form-control 
    {
      width: 95%;
      padding: 15px;
      margin: 5px 500px 22px 0;
      display: inline-block;
      border: none;
      background: #f1f1f1;
    }

    #signupbtn span:after 
    {
      content: '\00bb';
      /* position: absolute; */
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
   <?php $hostName = "localhost";
  $dbUser = "root"; 
  $dbpassword = "";
  $dbName = "login_signup";
  $conn = mysqli_connect($hostName, $dbUser, $dbpassword, $dbName);
  if (!$conn) 
  {
    die("something went wrong". mysqli_connect_error());
  }
  if (isset($_POST["submit"])) 
  {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $psw_repeat = $_POST['psw_repeat'];
    $password_hash = password_hash($password,PASSWORD_DEFAULT);
    $errors = array();
     
    if (empty($fullname) ||empty($username)|| empty($email) || empty($password) || empty($psw_repeat)) 
    {
      array_push($errors,"All fields are required");
      echo "<script>script('All fields are required')</script>";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      array_push($errors, "Email is not valid");
      echo "<script>script('Email is not valid')</script>";
    }
     if (strlen($password)<8) 
     {
      array_push($errors,"Password must be at least 8 charactes long");
      echo "<script>script('Password must be at least 8 charactes long')</script>";
     }
    if ($password!==$psw_repeat) 
    {
      array_push($errors,"Password does not match");
      echo "<script>script('Password does not match')</script>";
    }
    include_once "database_conn.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0) 
    {
      array_push($errors,"Email already exists!");
      echo "<script>script('Email already exists!')</script>";
    }
    if (count($errors)==0)
    {
      
      $sql = "INSERT INTO users (full_name, user_name, email, password) VALUES ( ?, ?, ?, ? )";
      $stmt = mysqli_stmt_init($conn);
      $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
      if ($prepareStmt) 
      {
        mysqli_stmt_bind_param($stmt,"ssss",$fullname, $username, $email, $password_hash);
        mysqli_stmt_execute($stmt);
        echo "<script>alert('You are registered successfully.')</script>";
      }
      else
      {
          die("Something went wrong". mysqli_error($conn));
      }
    }
  }
   ?>
<div id="container">
  <form action="signup.php" method="POST" style="border: 2px solid #ccc">
      <div class="every-thing">
      <h1>Sign Up</h1>
      
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label><b>Full Name</b>
      <input type="text" placeholder="Enter your full name" name="fullname" class= "form-control" ></label>
      <br>
      <label><b>User Name</b>
      <input type="text" placeholder="Enter a User Name" name="username" class= "form-control"></label>
      <br>
      <label><b>Email</b>
      <input type="email" placeholder="Enter yourEmail" name="email" class= "form-control"></label>
      <br>
      <label ><b>Password</b>
      <input type="password" placeholder="Enter Password" name="psw" class= "form-control"></label>
      <br>
      <label ><b>Repeat Password</b>
      <input type="password" placeholder="Repeat Password" name="psw_repeat"  class= "form-control"></label>


      <div class="clearfix">
        <input type="submit" name="submit" id="signupbtn" class="button" value = "Sign Up">
        <input type="reset" name="reset" id="canclebtn" class="button" value = "Cancle">
          <p>Already have an account,<a href="login.php" id="login"><b> click here to login</b></a></p>
        </div>
      </div>
    </div>
  </form>
</div>
</body>
</html>