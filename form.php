<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
  body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
  }
  form {
    border: 2px solid #ccc;
    max-width: 700px;
    width: 100%;
    box-sizing: border-box;
    padding: 20px;
  }

  .form-control {
    width: 100%;
    padding: 10px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
    box-sizing: border-box;
  }
  
  hr {
    border: 1px solid #acacac;
    margin-bottom: 25px;
  }
  #canclebtn {
    background-color: #f44336;
  }
  #signupbtn{
    background-color: #4CAF50;

  }
  .every-thing
   {
    padding: 16px;
   }
  
  #login
  {
  text-decoration: none;
  }
  button:hover{
      opacity:1;
  }
  button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    opacity: 0.8;
    width: 50%;
  }</style></head>
<body>
    <div class="container">
        <?php
         if(isset($_POST['submit']))
         {
           $fullname = $_POST['fullname'];
           $username = $_POST['username'];
           $email = $_POST['email'];
           $password = $_POST['psw'];
           $psw_repeat = $_POST['psw_repeat'];
           $errors = array();
     
           if(empty($fullname) OR empty($username) OR empty($email) OR empty($password)OR empty($psw_repeat))
           {
             array_push($errors,"all fields ar required");
           }
     
           if (filter_var($email,FILTER_VALIDATE_EMAIL)) 
           {
             array_push($errors,"Email is not valid");
           }
     
           if (strlen($password)<8) {
             array_push($errors,"passwod must be at least 8 characters!");
           }
     
           if ($password!==$psw_repeat) {
             array_push($errors,"password does not match");
           }
           if (count($errors)>0) {
             foreach($errors as $error )
             {
               echo "<div class='alert alert-danger' role='alert'>$error</div>";
             }
           }
           else
           {
            $sql = "INSERT INTO users (full_name, user_name, email, password) VALUES ( ?, ?, ?,? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            }else
            {
                die("Something went wrong");
            }
           }
        }
        ?>
        <form action="signup.php" method="post" style="border: 2px solid #ccc">
            <div class="every-thing">
                <h1>Sign Up</h1>
      
                <p>Please fill in this form to create an account.</p>
                <hr>
                <div class="form-group">
                    <label><b>Full Name</b>
                    <input type="text" placeholder="Enter your full name" name="fullname" class= "form-control" required ></label>
                </div>
                <div class="form-group">
                    <label><b>User Name</b>
                    <input type="text" placeholder="Enter a User Name" name="username" class= "form-control" required></label>
                </div>
                <div class="form-group">
                    <label><b>Email</b>
                    <input type="email" placeholder="Enter yourEmail" name="email" class= "form-control" required></label>
                </div>
                <div class="form-group">
                    <label ><b>Password</b>
                    <input type="password" placeholder="Enter Password" name="psw" class= "form-control" required></label>
                </div>
            
                <div class="form-group">
                <label ><b>Repeat Password</b>
                <input type="password" placeholder="Repeat Password" name="psw_repeat"  class= "form-control" required></label>
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn btn-primary" value="Register" name="submit">
                </div>
                <div><p>Already Registered <a href="login.php">Login Here</a></p></div>
            </div>
        </form>
    </div>
</body>
</html>