<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "research";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST["email"];
$password = $_POST["password"];

// Query to check if the email and password exist in the signup table
$sql = "SELECT * FROM signup WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

// If a match is found, login successful, otherwise display an error message
if ($result->num_rows > 0) {
    echo '<script>alert("Login successful"); window.location.href = "search.php";</script>';
} else {
    echo '<script>alert("Invalid email or password. Please try again."); window.history.back();</script>';
}

$stmt->close();
$conn->close();
?>
