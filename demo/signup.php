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

$fname1 = $_POST["fname"];
$lname1 = $_POST["lname"];
$inst_id1 = $_POST["inst_id"];
$inst_name1 = $_POST["inst_name"];
$email1 = $_POST["email"];
$password1 =$_POST["password"];
$sql = "INSERT INTO signup (fname, lname,inst_id ,inst_name ,email,password) VALUES (?,?,?,?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ssssss", $fname1, $lname1,$inst_id1,$inst_name1,$email1,$password1);
if ($stmt->execute()) {
    echo '<script>alert("Signup successful"); window.location.href = "login.html";</script>';}
    // echo '<script>alert("Signup successful");</script>';
    // header("Location: index.html");
    // exit; }
else{
echo "User registration failed.";
}
$stmt->close();
$conn->close();
?>