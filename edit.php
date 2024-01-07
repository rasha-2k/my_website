<?php
session_start();
include_once "database_conn.php";
include 'header.php';

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['valid'])) 
{
    // Store the current page URL in a session variable
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    echo "<script>alert('You must log in first to edit your profile!'); window.location.href = 'login.php';</script>";
    exit;
}

// Initialize variables
$new_fullname = $new_birthdate = $new_major = $new_email = "";

// Check if the form is submitted for editing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) 
{
    // Validate the password (you may want to improve this validation)
    $entered_password = trim($_POST["password"]);

    // Fetch user details based on the currently logged-in user
    $query = "SELECT * FROM users WHERE ID = '{$_SESSION['id']}'";
    $result = mysqli_query($conn, $query);

    if (!$result)
    {
        echo "Error: " . mysqli_error($conn);
        exit;
    }

    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if(password_verify($entered_password, $user['password']))
    {
        // Process form submission for updating user details
        $new_fullname = trim($_POST["new_fullname"]) ;
        $new_birthdate = trim($_POST["new_birthdate"]) ;
        $new_major = trim($_POST["new_major"]) ;
        $new_email = trim($_POST["new_email"]) ;
        
        // Update user details
        $update_query = "UPDATE users 
                        SET full_name='$new_fullname', 
                            birthdate='$new_birthdate', 
                            major='$new_major', 
                            email='$new_email' 
                        WHERE ID='{$_SESSION['id']}'";
       
        $update_result = mysqli_query($conn, $update_query);
        if (!$update_result) 
        {
            echo "<script>alert('Error updating user details: " . mysqli_error($conn) . "')</script>";
        } else 
        {
            // Update session variables with new details
            $_SESSION['full_name'] = $new_fullname;
            $_SESSION['birthdate'] = $new_birthdate;
            $_SESSION['major'] = $new_major;
            $_SESSION['email'] = $new_email;
            echo "<script>alert('User details updated successfully!'); window.location.href = 'home.php';</script>";
        }
    }
    else 
    {
        echo "<script>alert('Incorrect password!')</script>";
    }
}

mysqli_close($conn);
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
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .inputt {
    width: 285%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    border-radius: 4px;
    background: #f1f1f1;
    box-sizing: border-box;
    }
    #idd{
    width: 267%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    border-radius: 4px;
    background: #f1f1f1;
    box-sizing: border-box;
    }
    #bdate {
    width: 385%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    border-radius: 4px;
    background: #f1f1f1;
    box-sizing: border-box;

    }

    #savebtn span:after 
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

    #savebtn
    {
      background-color: #4CAF50;
    }

    .every-thing
    {
      padding: 16px;
      width: 100%;

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

    #savebtn:hover,#canclebtn:hover
    {
        opacity:1;
    }

    #savebtn,#canclebtn 
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

    <title>Edit Profile</title>
</head>
<body>
    <div id="container">
        <form method="POST" action="edit.php" style="border: 2px solid #ccc">
            <div class="every-thing">
                <h1>Edit Profile</h1>
                <hr>

                <label>
                    <input type="password" placeholder="Enter your Password" name="password" class="inputt" maxlength="255" required>
                </label>
                <hr>
                <label>
                    <input type="text" placeholder="Enter the new Full name" name="new_fullname" class="inputt" maxlength="50" value="<?php echo $_SESSION['full_name']; ?>" >
                </label>
                <br>
                <label>
                    Enter the new Birthdate: <br>
                    <input type="date" name="new_birthdate" id="bdate" value="<?php echo $_SESSION['birthdate']; ?>" >
                </label>
                <br>
                <label>
                    <input type="text" placeholder="Enter the new major" name="new_major" class="inputt" maxlength="30" value="<?php echo $_SESSION['major']; ?>" >
                </label>
                <br>
                <label>
                    <input type="email" placeholder="Enter the new Email" name="new_email" class="inputt" maxlength="255" value="<?php echo $_SESSION['email']; ?>" >
                </label>
                <br>
                <div class="clearfix">
                    <input type="submit" name="submit" id="savebtn" class="button" value="Save Changes">
                    <input type="button" onclick="location.href='home.php'" id="canclebtn" class="button" value="Cancel">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
