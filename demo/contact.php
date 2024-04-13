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

$cont_name = $_POST["cont_name"];
$email = $_POST["email"];
$message =$_POST["message"];
$sql = "INSERT INTO contact (cont_name,email,message) VALUES (?,?,?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $cont_name,$email,$message);
if ($stmt->execute()) {
    echo '<script>alert("Thank you for your feedback!!"); window.location.href = "index.html";</script>';
}
else {
echo "User registration failed.";
}
$stmt->close();
$conn->close();
?>