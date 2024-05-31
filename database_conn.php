<?PHP
$hostName = "localhost";
$dbUser = "root"; 
$dbpassword = "";
$dbName = "login_signup";
$conn = mysqli_connect($hostName, $dbUser, $dbpassword, $dbName);
if (!$conn) 
{
    die("something went wrong". mysqli_connect_error());
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if (!mysqli_query($conn, $sql)) 
    echo "<script>alert('Error creating database:');</script> " . mysqli_error($conn);

// Select the database
mysqli_select_db($conn, $dbName);

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    ID VARCHAR(9) PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    birthdate DATE,
    major VARCHAR(30),
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if (!mysqli_query($conn, $sql))
    echo "Error creating table: " . mysqli_error($conn);


