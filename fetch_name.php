<?php
// Database connection parameters
$servername = "localhost";
$username = 'root';
$password = '';
$database = "alumnus";

// Get the student ID from the request
$student_id = $_GET['student_id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query to fetch the name of the student based on their ID
$sql = "SELECT names FROM student WHERE student_id =?";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("s",$student_id);

// Execute the statement
$stmt->execute();

// Bind result variables
$stmt->bind_result($name);

// Fetch the result
$stmt->fetch();

// Close statement
$stmt->close();

// Close connection
$conn->close();

// Return the name as JSON
echo json_encode($name);
?>
