<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
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
        .result-box {
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
        .no-results {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Results</h2>
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root"; // Your MySQL username
        $password = ""; // Your MySQL password
        $dbname = "lmsDbbooks";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if search query is submitted
        if (isset($_GET['query'])) {
            $search_query = $_GET['query'];

            // Search query
            $sql = "SELECT * FROM books WHERE title LIKE '%$search_query%' OR author LIKE '%$search_query%' OR genre LIKE '%$search_query%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Display search results
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='result-box'>";
                    echo "<p><strong>Title:</strong> " . $row['title'] . "<br>";
                    echo "<strong>Author:</strong> " . $row['author'] . "<br>";
                    echo "<strong>Genre:</strong> " . $row['genre'] . "<br>";
                    echo "<strong>Description:</strong> " . $row['description'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-results'>No results found.</p>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
