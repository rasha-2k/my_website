<?php
// ! signup php code
session_start();
if (isset($_SESSION["user"])) 
{
   header("Location: home.php");
}
?>
<?php 
/*    if(isset($_POST['submit']))
    {
      $fullname = $_POST['fullname'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['psw'];
      $psw_repeat = $_POST['psw_repeat'];
      $password_hash = password_hash($password,PASSWORD_DEFAULT);
      $errors = array();

      if(empty($fullname) || empty($username) || empty($email) || empty($password)|| empty($psw_repeat))
      {
        array_push($errors,"all fields ar required");
      }

      if (!filter_var($email,FILTER_VALIDATE_EMAIL)) 
      {
        array_push($errors,"Email is not valid");
      }

      if (strlen($password)<8) {
        array_push($errors,"passwod must be at least 8 characters!");
      }

      if ($password!==$psw_repeat) {
        array_push($errors,"password does not match");
      }
      require_once "database_conn.php";
       $sql = "SELECT * FROM users WHERE email = '$email'";
       $result = mysqli_query($conn, $sql);
       $rowCount = mysqli_num_rows($result);
       if ($rowCount>0) {
        array_push($errors,"Email already exists!");
       }
      if (count($errors)>0)
      {
        foreach($errors as $error )
        {
          echo "<div class='alert alert-danger' role='alert'>$error</div>";
        }
      }
      else
      {
        $sql = "INSERT INTO users (full_name, user_name, email, password) VALUES ( ?, ?, ?, ? )";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
        if ($prepareStmt) 
        {
          mysqli_stmt_bind_param($stmt,"sss",$fullName, $username, $email, $password_hash);
          mysqli_stmt_execute($stmt);
          echo "<div class='alert alert-success'>You are registered successfully.</div>";
        }
        else
        {
          die("Something went wrong". mysqli_error($conn));
        }
            // $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            // if ($prepareStmt) {
                
            //     echo "You are registered successfully";
            // }else
            // {
            //     die("Something went wrong");
            // }
      }
    }*/
    //! ////////////////////////////////////////////////////////////////////
    if (isset($_POST["submit"])) {
      $fullname = $_POST['fullname'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['psw'];
      $psw_repeat = $_POST['psw_repeat'];
      $password_hash = password_hash($password,PASSWORD_DEFAULT);
      $errors = array();
       
      if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) 
      {
        array_push($errors,"All fields are required");
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
      {
        array_push($errors, "Email is not valid");
      }
       if (strlen($password)<8) 
       {
        array_push($errors,"Password must be at least 8 charactes long");
       }
      if ($password!==$psw_repeat) 
      {
        array_push($errors,"Password does not match");
      }
      include_once "database_conn.php";
      $sql = "SELECT * FROM users WHERE email = '$email'";
      $result = mysqli_query($conn, $sql);
      $rowCount = mysqli_num_rows($result);
      if ($rowCount>0) 
      {
        array_push($errors,"Email already exists!");
      }
      if (count($errors)>0) 
      {
        foreach ($errors as  $error)
        {
          echo "<div class='alert alert-danger'>$error</div>";
        }
      }
      else
      {
        
        $sql = "INSERT INTO users (full_name, user_name, email, password) VALUES ( ?, ?, ?, ? )";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
        if ($prepareStmt) 
        {
          mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
          mysqli_stmt_execute($stmt);
          echo "<div class='alert alert-success'>You are registered successfully.</div>";
        }
        else
        {
            die("Something went wrong". mysqli_error($conn));
        }
      }
    }
?>
      
      
<?php 
// ! home php code

session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="home_style.css">
    <title>User Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Welcome to Dashboard</h1>
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>


    <div class="container">
        <h1>Welcome to Dashboard</h1>
        <div class="btn-group-vertical" role="group" aria-label="Vertical radio toggle button group">
            <label class="btn btn-outline-danger">
                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1" autocomplete="off" checked="">
                <a href="home.php" class="text-danger" style="text-decoration: none;">Home</a>
            </label>
            <label class="btn btn-outline-danger">
                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1" autocomplete="off">
                <a href="signup.php" class="text-danger" style="text-decoration: none;">Sign Up</a>
            </label>
            <label class="btn btn-outline-danger">
                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1" autocomplete="off">
                <a href="login.php" class="text-danger" style="text-decoration: none;">Log In</a>
            </label>
            <label class="btn btn-outline-danger">
                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1" autocomplete="off">
                <a href="edit.php" class="text-danger" style="text-decoration: none;">Edit Account</a>
            </label>
            <label class="btn btn-outline-danger">
                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio2" autocomplete="off">
                <a href="delete.php" class="text-danger" style="text-decoration: none;">Delete Account</a>
            </label>
            <label class="btn btn-outline-danger">
                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio3" autocomplete="off">
                <a href="logout.php" class="text-danger" style="text-decoration: none;">Logout</a>
            </label>
        </div>
    </div>
</body>
</html>

<script>
  //! delete.php page
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home_style.css">
    <style> 
    body {
        /* display: flex; */
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }
     .inputt {
      padding: 15px;
      margin: 5px 0 22px 0;
      display: block;
      width: 100%;
      border: none;
      background: #f1f1f1;
      box-sizing: border-box;
    }
    .button:hover{
        opacity:1;
      }
    .button {
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
    </style>
        <?php 
    include 'header.php'
    ?>
    <title>Delete a user</title>
</head>
<body>

    <form method = "post" action = "">
		<p>
            <label>Insert the username that you want to delete:<br>
				<input name = "username" type = "text" class="inputt" placeholder="Enter the username here">
			</label>
        </p>
		<p>
			<input type = "submit" value = "Submit" class="button"  style="background-color: #4CAF50;">
			<input type = "reset" value = "Clear" class="button" style="background-color: #f44336;">
		</p>   
		</form>
</body>
</html>


<!-- //!--------------------------------------------------------------------
 -->
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
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $birthdate = $_POST['birthdate'];
    $major = $_POST['major'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $psw_repeat = $_POST['psw_repeat'];
    $password_hash = password_hash($password,PASSWORD_DEFAULT);
    $errors = array();
     
    if (empty($fullname) ||empty($id)|| empty($major) || empty($email) || empty($password) || empty($psw_repeat)) 
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
      
      $sql = "INSERT INTO users (ID,full_name,birthdate, major, email, password) VALUES ( ?, ?, ?, ?,?,? )";
      $stmt = mysqli_stmt_init($conn);
      $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
      if ($prepareStmt) 
      {
        mysqli_stmt_bind_param($stmt,"ssssss",$id, $fullname,$birthdate, $major, $email, $password_hash);
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