<?php    
    // Include session and database connection files
    session_start();
    include_once "database_conn.php";
    include 'header.php';
    // Check if the user is not logged in, store the current URL and redirect to login page
    if (!isset($_SESSION['valid'])) 
    {
        // Store the current page URL in a session variable
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        echo "<script>alert('You must login first to view the data!'); window.location.href = 'login.php';</script>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Data</title>
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
    <form action="" method="POST">
        <label>
            <h4><b>Choose a field that you want to search:</b>
                <select id="field" name="field">
                    <option value="id">ID</option>
                    <option value="full_name">Name</option>
                    <option value="birthdate">Birthdate</option>
                    <option value="major">Major</option>
                    <option value="email">Email</option>
                </select>
            </h4>
        </label>
        <br>
        <label style="display: flex; align-items: center;">
            <h4><b>Enter search value:</b>
                <input type="text" name="value" size="20" maxlength="40" value="">
                <input type="submit" value="Search!">
            </h4>
        </label>
    </form>
    <?php
    // If the form has been submitted with a supplied field and value
    if (isset($_POST['field']) && isset($_POST['value'])) {
        // Sanitize user input
        $field = mysqli_real_escape_string($conn, $_POST['field']);
        $value = mysqli_real_escape_string($conn, $_POST['value']);

        // Create the query
        $query = "SELECT * FROM users WHERE $field LIKE '$value%'";

        // Execute the query
        $result = mysqli_query($conn, $query);

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
                        <th>Birthdate</th>
                        <th>Major</th>
                        <th>Email</th>
                    </tr>";

            while ($row = mysqli_fetch_assoc($result)) 
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
