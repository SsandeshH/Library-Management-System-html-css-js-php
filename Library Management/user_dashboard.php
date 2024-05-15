<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .book-request {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h2 {
            margin-top: 0;
        }
        p {
            margin-bottom: 10px;
        }
        strong {
            font-weight: bold;
        }
        .no-requests {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dashboard<br></h2>
        <?php
        session_start();
        echo "Requests of ". $_SESSION['username'];
        // Check if user is logged in
        if (!isset($_SESSION['username'])) {
            // User is not logged in, display error message
            echo "<p class='no-requests'>User not logged in.</p>";
        } else {
            // Retrieve user's username from session
            $username = $_SESSION['username'];

            // Database connection
            $servername = "localhost";
            $username_db = "root"; // Your MySQL username
            $password_db = ""; // Your MySQL password
            $dbname = "lmsdb";

            // Create connection
            $conn = new mysqli($servername, $username_db, $password_db, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve requested books for the user
            $sql = "SELECT * FROM book_requests WHERE userName='$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Display requested books
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='book-request'>";
                    echo "<p><strong>Title:</strong> " . $row['title'] . "<br>";
                    echo "<strong>Author:</strong> " . $row['author'] . "<br>";
                    echo "<strong>Genre:</strong> " . $row['genre'] . "<br>";
                    echo "<strong>Description:</strong> " . $row['description'] . "<br>";
                    echo "<strong>Status:</strong> " . $row['status'] . "<br>";
                    echo "<strong>Requested At:</strong> " . $row['created_at'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-requests'>No book requests found for this user.</p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
