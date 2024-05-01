<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "lmsdbbooks"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch books from the database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

// Display books in the table
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead><tr><th>Title</th><th>Author</th><th>Genre</th><th>Availability</th><th>Action</th></tr></thead>";
    echo "<tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<form action='update_book.php' method='post'>"; // Form for editing or deleting book
        echo "<td><input type='text' name='title' value='" . $row["title"] . "'></td>";
        echo "<td><input type='text' name='author' value='" . $row["author"] . "'></td>";
        echo "<td><input type='text' name='genre' value='" . $row["genre"] . "'></td>";
        echo "<td><input type='text' name='available' value='" . ($row["available"] == 1 ? 'Yes' : 'No') . "'></td>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>"; // Hidden input for book ID
        echo "<input type='hidden' name='action' value='update'>"; // Hidden input for action (update)
        echo "<td>";
        echo "<button type='submit' class='edit-btn' data-id='" . $row["id"] . "'>Save</button>"; // Save button
        echo "<button class='delete-btn' data-id='" . $row["id"] . "'>Delete</button>";

        echo "</td>";
        echo "</form>";
        
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "0 results";
}

// Close database connection
$conn->close();
?>
