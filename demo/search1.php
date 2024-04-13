<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "research";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query to retrieve distinct inst_id values
$sql_inst_id = "SELECT DISTINCT inst_id FROM paper";
$result_inst_id = $conn->query($sql_inst_id);

echo "<tbody>"; // Ensure no whitespace before this tag

// Search query
$sql_search = "SELECT * FROM paper WHERE p_name LIKE '%$search%' OR author_name LIKE '%$search%'";
$result_search = $conn->query($sql_search);

// Insert data into search table
if ($result_search->num_rows > 0) {
    while ($row = $result_search->fetch_assoc()) {
        $inst_id = $row['inst_id'];
        $p_id = $row['p_id'];
        $p_name = $row['p_name'];
        $author_name = $row['author_name'];
        $p_link = $row['p_link'];
        
        // Check if the record already exists in the search table
        $sql_check = "SELECT * FROM search WHERE p_id = '$p_id'";
        $result_check = $conn->query($sql_check);
        
        if ($result_check->num_rows == 0) {
            // Insert data into search table
            $sql_insert = "INSERT INTO search (inst_id, p_id, p_name, author_name, p_link) VALUES ('$inst_id', '$p_id', '$p_name', '$author_name', '$p_link')";
            $conn->query($sql_insert);
        }
        
        // Display data in the search results with update and delete options
        echo "<tr>";
        echo "<td>" . $inst_id . "</td>";
        echo "<td>" . $p_id . "</td>";
        echo "<td>" . $p_name . "</td>";
        echo "<td>" . $author_name . "</td>";
        echo "<td><a href='" . $p_link . "' target='_blank'>" . $p_link . "</a></td>";
       
        echo "<td><a href='delete.php?p_id=" . $p_id . "'>Delete</a></td>";
        echo "</tr>";
    }
} elseif ($result_inst_id->num_rows == 0) {
    echo "<tr><td colspan='5'>No records found</td></tr>";
}

echo "</tbody>";

$conn->close();
?>
