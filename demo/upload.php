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

$pid = $_POST["p_id"];
$project_name = $_POST["p_name"];
$inst_id = $_POST["inst_id"];
$project_year = $_POST["p_year"];
$author_name = $_POST["author_name"];
$link = $_POST["p_link"];

// Check if the link starts with "http://" or "https://", if not, add "http://"
if (!preg_match("~^(?:f|ht)tps?://~i", $link)) {
    $link = "http://" . $link;
}

// Prepare the SQL statement
$sql = "INSERT INTO paper (p_id, p_name,inst_id, p_year, author_name, p_link) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt === false) {
    die("Error: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ssssss", $pid, $project_name, $inst_id, $project_year, $author_name, $link);

// Execute the statement
if ($stmt->execute()) {
    echo '<script>alert("Upload successful"); window.location.href = "search.php";</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
