<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "lmsDb";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$username= $_POST['username'];
$password = $_POST['password'];


$sql = "INSERT INTO registerdata (email,username, password) VALUES ('$email', '$username' ,'$password')";

if ($conn->query($sql) === TRUE) {

    session_start();
    $_SESSION['registration_success'] = true;
    $redirect_delay = 3;
    header("refresh:$redirect_delay;url=index.html"); 
    echo "Registration successful! You will be redirected to the homepage in $redirect_delay seconds.";
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


$conn->close();
?>
