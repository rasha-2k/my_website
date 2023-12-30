<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
    /* body {
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    } */
    .inputt {
      
      padding: 15px;
      margin: 5px 500px 22px 0;
      display: block;
      width: 100%;
      border: none;
      background: #f1f1f1;
      box-sizing: border-box;
    }
    
    hr {
      border: 1px solid #acacac;
      margin-bottom: 25px;
      width: 100%;
    }
    #canclebtn {
      color: #f1f1f1;
      background-color: #f44336;
    }
    #loginbtn {
      color: #f1f1f1;
      background-color: #4CAF50;
    }
    .every-thing
     {
      padding: 16px;
     }
    form {
      border: 2px solid #ccc;
      max-width: 500px;
      width: 100%;
      box-sizing: border-box;
      padding: 20px;
    }
    #container{
      display: flex;
      align-content: center;
      justify-content: center;
    }
    #signup
    {
    text-decoration: none;
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
    label {
        display: block;
        margin-bottom: 15px;
    }

    </style>

</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0">
    <?php 
    include 'header.php'
    ?>
<?php
        if (isset($_POST["submit"])) {
           $username = $_POST["username"];
           $password = $_POST["psw"];
            require_once "database_conn.php";
            $sql = "SELECT * FROM users WHERE user_name = '$username'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) 
            {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: home.php");
                    die();
                }else
                {
                    echo "<script>alert('Password is incorrect')</script>";
                }
            }
            else
            {
                echo "<script>alert('Username does not exist')</script>";
            }
        }
       
  if (isset($_GET['logout']) && $_GET['logout'] == 'success') {
      echo '<script>alert("You have logged out successfully.");</script>';
  }
?>

<div id="container">
<form method="post" action="login.php" style="border: 2px solid #ccc">
    <div class="every-thing">
      <h1>Login</h1>
      <hr>
      <label><b>User Name</b>
      <input type="text" placeholder="Enter your User Name" name="username" class= "inputt" required></label>

      <label ><b>Password</b>
      <input type="password" placeholder="Enter Password" name="psw" class= "inputt" required></label>

      <div class="clearfix">
        <input type="submit" id="loginbtn" class="button" name="submit" value="Log in">
        <input type="reset" id="canclebtn" class="button" name="clear" value="Cancle">
      </div>
    </div>
    <p>Don't have an account? <a href="signup.php" id="signup"><b> Register here</b></a></p>

  </form>
  </div>
</body>

</html>
