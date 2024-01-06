<?php
// Include the session and database connection files
    session_start();
    include_once "database_conn.php";
    include 'header.php'; 

    // Check if the user is not logged in, redirect to login page
    if (!isset($_SESSION['valid'])) 
    {
        // Store the current page URL in a session variable
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        
        echo "<script>alert('you must login first to view the data!'); window.location.href = 'login.php';</script>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Data View</title>
    <style>

        table {
            text-align: center;
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <div>
        <h1>Users Data</h1>

        <form action="" method="POST">
            <label>
                <h4><b>Select Order:</b>
                    <select name="order" id="order">
                        <option value="ID">ID</option>
                        <option value="full_name">Full Name</option>
                        <option value="birthdate">Birthdate</option>
                        <option value="major">Major</option>
                    </select>
                </h4>
            </label>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>

    <?php 
        // Check if the form is submitted
        if (isset($_POST['submit'])) 
        {
            // store the selected order
            $selected_order = $_POST['order'];
            $order_sql = "ORDER BY $selected_order ASC";
            
            // Fetch and display user data based on the selected order
            $data_sql = "SELECT * FROM users $order_sql";
            $result = mysqli_query($conn, $data_sql);

            // If records found, display in a table
            if (mysqli_num_rows($result) == 0) 
            {
                echo "No results found.";
            } 
            else
            {  
                echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Birth Date</th>
                            <th>Major</th>
                            <th>Email</th>
                        </tr>";
        
                while($row = mysqli_fetch_assoc($result)) 
                {
                    echo "<tr><td>" . $row['ID'] . "</td>"
                            ."<td>" . $row['full_name'] . "</td>"
                            ."<td>" . $row['birthdate'] . "</td>"
                            ."<td>" . $row['major'] . "</td>"
                            ."<td>" . $row['email'] . "</td></tr>";
                }
                echo "</table>";
            }
        }
    // Close the connection
    mysqli_close($conn);
    ?>
</body>
</html>
