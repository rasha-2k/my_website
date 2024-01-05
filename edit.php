<?php
session_start();
include 'database_conn.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <!-- Include your styles here -->
</head>
<body>
    <?php include 'header.php'; ?>

    <h1>Edit Profile</h1>

    <form method="post" action="edit.php">
        <label for="new_id">ID:</label>
        <input type="text" name="new_id" value="<?php echo $user['ID']; ?>" required>

        <label for="new_full_name">Full Name:</label>
        <input type="text" name="new_full_name" value="<?php echo $user['full_name']; ?>" required>

        <label for="new_birthdate">Birthdate:</label>
        <input type="date" name="new_birthdate" value="<?php echo $user['birthdate']; ?>" required>

        <label for="new_major">Major:</label>
        <input type="text" name="new_major" value="<?php echo $user['major']; ?>" required>

        <label for="new_email">Email:</label>
        <input type="email" name="new_email" value="<?php echo $user['email']; ?>" required>

        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required>

        <!-- Add more fields as needed -->

        <input type="submit" name="submit" value="Save Changes">
    </form>

    <p><a href="home.php">Back to Home</a></p>
    <?php
    
// Check if the user is logged in
// if (!isset($_SESSION['user'])) {
//     header("Location: login.php");
//     die();
// }

// Retrieve user information from the database based on user ID
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE ID = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // Retrieve updated information from the form
    $new_id = mysqli_real_escape_string($conn, $_POST['new_id']);
    $new_full_name = mysqli_real_escape_string($conn, $_POST['new_full_name']);
    $new_birthdate = mysqli_real_escape_string($conn, $_POST['new_birthdate']);
    $new_major = mysqli_real_escape_string($conn, $_POST['new_major']);
    $new_email = mysqli_real_escape_string($conn, $_POST['new_email']);
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Update the database with the new information
    $update_sql = "UPDATE users SET ID = '$new_id', full_name = '$new_full_name', birthdate = '$new_birthdate', major = '$new_major', email = '$new_email', password = '$new_password' WHERE ID = '$user_id'";
    
    if (mysqli_query($conn, $update_sql)) 
    {
        // Redirect to a confirmation page or the home page
        header("Location: edit.php");
        die();
    } else {
        // Update failed
        echo "Error: " . mysqli_error($conn);
    }
}
    
    ?>
</body>
</html>
