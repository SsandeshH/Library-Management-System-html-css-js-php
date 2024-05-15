<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="adminDashStyle.css">
</head>
<body>
    <header>
        <div class="headcontainer">
            <div class="logo">
                <i class="fa-solid fa-l"></i>
            </div>
            <nav>
                <ul>
                    <!-- <li><a href="index.html">Home</a></li> -->
                    <li><a href="logout.php">Logout</a></li> 
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>Welcome, Admin!</h1>

        <h2>Process Pending Requests</h2>
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

            // Retrieve pending book requests
            $sql = "SELECT * FROM book_requests WHERE status = 'pending'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Display pending book requests in a table
                echo "<table class='pending-requests-table'>";
                echo "<tr><th>Title</th><th>Author</th><th>Genre</th><th>Description</th><th>Requested By</th><th>Requested At</th><th>Action</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['author'] . "</td>";
                    echo "<td>" . $row['genre'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['userName'] . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    if ($row['status'] == 'pending') {
                        echo "<td><button class='accept-btn' onclick='acceptRequest(" . $row['id'] . ")'>Accept</button><button class='deny-btn' onclick='denyRequest(" . $row['id'] . ")'>Deny</button></td>";
                    } else {
                        echo "<td>Fulfilled</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='no-requests'>No pending requests found.</p>";
            }

            $conn->close();
            ?>

    </div>

    <div class="container">    
        <h2>Add New Book</h2>
        <form action="add_book.php" method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required>
            </div>
            <div class="form-group">
                <label for="available">Available:</label>
                <input type="checkbox" id="available" name="available" value="1">
            </div>
            <button type="submit" class="btn">Add Book</button>
        </form>
    </div>

        <div class="container">
            <h2>Manage Books</h2>
            <table>
                <tbody>
                    <?php 
                        // Display existing books
                        require 'display_books.php'; 
                    ?>
                </tbody>
            </table>
        </div>


    <script>
        function deleteBook(id) {
            if (confirm('Are you sure you want to delete this book?')) {
                // Send AJAX request to delete_book.php with the book ID
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete_book.php');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Reload the page after deletion
                        location.reload();
                    } else {
                        console.error('Error deleting book');
                    }
                };
                xhr.send('id=' + id);
            }
        }
        
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const bookId = this.dataset.id;
                    deleteBook(bookId);
                });
            });
        });

        
    function acceptRequest(id) {
        updateRequestStatus(id, 'accepted');
    }

    function denyRequest(id) {
        updateRequestStatus(id, 'denied');
    }

    function updateRequestStatus(id, status) {
        // Send AJAX request to update request status
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_req.php');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Reload the page after updating request status
                location.reload();
            } else {
                console.error('Error updating request status');
            }
        };
        xhr.send('id=' + id + '&status=' + status);
    }

    // Add event listeners to accept and deny buttons
    const acceptButtons = document.querySelectorAll('.accept-btn');
    acceptButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const requestId = this.dataset.id;
            acceptRequest(requestId);
        });
    });

    const denyButtons = document.querySelectorAll('.deny-btn');
    denyButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const requestId = this.dataset.id;
            denyRequest(requestId);
        });
    });




    </script>
  

</body>
</html>
