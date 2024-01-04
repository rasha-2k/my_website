<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Data View</title>
    <style>
        table {
            width: 80%;
            text-align: center;
            margin-top: 20px;
        }

         td, th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            text-align: center;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php
    include 'header.php';  // Assuming you have a header file
    include_once "database_conn.php";
    ?>
    <div>
        <h1>Users Data</h1>

        <form action="" method="POST">
            <label for="order">Select Order:</label>
            <select name="order" id="order">
                <option value="ID">ID</option>
                <option value="full_name">Full Name</option>
                <option value="birthdate">Birthdate</option>
                <option value="major">Major</option>
            </select>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <?php 

        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // store the selected order
            $selected_order = $_POST['order'];
            $order_sql = "ORDER BY $selected_order ASC";
            
            // Fetch and display user data based on the selected order
            $data_sql = "SELECT ID, full_name, birthdate, major FROM users $order_sql";
            $result = mysqli_query($conn, $data_sql);

            if ($result) {  
                echo "<table border='1' cellspacing='1' bgcolor='#FFFF99'>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Birth Date</th>
                            <th>Major</th>
                        </tr>";
        
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['full_name'] . "</td>";
                    echo "<td>" . $row['birthdate'] . "</td>";
                    echo "<td>" . $row['major'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    ?>

    
</body>
</html>
