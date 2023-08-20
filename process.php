<?php
// Establish a database connection
$servername = "localhost";  // Change this if your database is hosted elsewhere
$username = "anon";
$password = "@Kay14OUd!03";
$dbname = "anondb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];

// Insert data into the database
$sql = "INSERT INTO submissions (name, email) VALUES ('$name', '$email')";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
