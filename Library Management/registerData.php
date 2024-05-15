<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "lmsdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// Check if email or username already exists
$check_query = "SELECT * FROM registerdata WHERE email='$email' OR username='$username'";
$result = $conn->query($check_query);
if ($result->num_rows > 0) {
    // Redirect back to register.html with error parameter
    header("Location: register.html?error=1");
    exit();
}

$sql = "INSERT INTO registerdata (email, username, password) VALUES ('$email', '$username' ,'$password')";

if ($conn->query($sql) === TRUE) {
    // Registration successful
    session_start();
    $_SESSION['registration_success'] = true;
    $redirect_delay = 3;
    header("refresh:$redirect_delay;url=index.html"); 
    echo "Registration successful! You will be redirected to the homepage in $redirect_delay seconds.";
    exit();
} else {
    // Error occurred
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
