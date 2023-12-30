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
?>