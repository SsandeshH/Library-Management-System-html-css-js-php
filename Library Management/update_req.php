<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "lmsdb"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if request ID is set
if(isset($_POST['id'])){
    $requestId = $_POST['id'];

    // Check if the request ID is valid
    // You may want to add additional validation here

    // Update the status of the request in the database
    // Assuming 'accepted' and 'denied' are the only valid status values
    $status = $_POST['status'];
    if ($status === 'accepted' || $status === 'denied') {
        $sql = "UPDATE book_requests SET status='$status' WHERE id=$requestId";
        if ($conn->query($sql) === TRUE) {
            echo "Request status updated successfully";
        } else {
            echo "Error updating request status: " . $conn->error;
        }
    } else {
        echo "Invalid status";
    }
} else {
    echo "Request ID not set";
}

$conn->close();
?>
