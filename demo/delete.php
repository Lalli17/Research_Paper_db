<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "research";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["p_id"])) {
    $p_id = $_GET["p_id"];

    $sql = "DELETE FROM paper WHERE p_id='$p_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
