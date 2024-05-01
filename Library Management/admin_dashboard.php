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
                    <li><a href="logout.php">Logout</a></li> <!-- Assuming a logout.php file for logging out -->
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>Welcome, Admin!</h1>
        
        <!-- Add New Book Form -->
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

        <!-- Manage Books Table -->
        <div class="container">
            <h2>Manage Books</h2>
            <table>

                <tbody>
                    
                    <?php require 'display_books.php'; ?>

                </tbody>
            </table>
        </div>
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
    </script>
</body>
</html>
