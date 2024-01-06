<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    nav {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
    }
  </style>
</head>
<body>

<?php
// Get the current page name from the PHP_SELF variable
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <?php
        // Check if the user is logged in
        if (isset($_SESSION['valid'])) {
          // Display the user's full name as the website name
          echo '<a class="navbar-brand" href="home.php">' . $_SESSION['full_name'] . '</a>';
        } 
        else 
        {
          // Display "Account" as the website name if the user is not logged in
          echo '<a class="navbar-brand" href="login.php">Account</a>';
        }
      ?>
    </div>
    <ul class="nav navbar-nav">
      <li <?php if ($current_page == 'home.php') echo 'class="active"'; ?>><a href="home.php">Home</a></li>
      <li <?php if ($current_page == 'order.php') echo 'class="active"'; ?>><a href="order.php">View Data</a></li>
      <li <?php if ($current_page == 'search.php') echo 'class="active"'; ?>><a href="search.php">Search Data</a></li>
      <li class="dropdown <?php if ($current_page == 'edit.php' || $current_page == 'logout.php' || $current_page == 'delete.php') echo 'active'; ?>">
        <a class="dropdown-toggle" data-toggle="dropdown">Sitting<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="edit.php">Edit Profile</a></li>
          <li><a href="logout.php">Log Out</a></li>
          <li><a href="delete.php">Delete an account</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

    </ul>
  </div>
</nav>

</body>
</html>
