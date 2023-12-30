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

<?php 
		if (!empty($_POST['username'])) {
			include 'database_conn.php'; 
			mysqli_select_db($conn, 'login_signup');
		
			$sql=mysqli_query($conn, "DELETE FROM users WHERE user_name ='$_POST[username]'");		
		
			if ($sql) {
				echo "<script> alert('User has been deleted')</script> ". mysqli_affected_rows($conn);
			}else{ 
				echo 'User not found.'  . "<br>";
			}
		}
 ?>
