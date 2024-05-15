<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>

</head>
<body>
    <div class="container">

        <h2>Search Results</h2>
        <?php

        
        // Database connection
        $servername = "localhost";
        $username = "root"; // Your MySQL username
        $password = ""; // Your MySQL password
        $dbname = "lmsdb";



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
                    // Add request button
                    echo "<button class='request-button' onclick='requestBook(\"" . $row['title'] . "\", \"" . $row['author'] . "\", \"" . $row['genre'] . "\", \"" . $row['description'] . "\")'>Request</button>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-results'>No results found.</p>";
            }
        }

        $conn->close();
        ?>

        <script>
            function requestBook(title, author, genre, description) {
                // AJAX request to insert book details into book_requests table
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "insert_request.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Display response message
                        alert(xhr.responseText);
                    }
                };
                xhr.send("title=" + title + "&author=" + author + "&genre=" + genre + "&description=" + description);
            }
        </script>
    </div>
</body>
</html>
