<?php
// Include your database connection configuration
$host = 'localhost';
$username = 'anon';
$password = '';
$database = 'anonDB';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];

    // Insert post into the posts table
    $insertPostQuery = "INSERT INTO posts (text) VALUES ('$text')";
    if ($conn->query($insertPostQuery) === TRUE) {
        $post_id = $conn->insert_id; // Get the ID of the newly inserted post

        // Check if the user interacted (liked/disliked) with the post
        if (isset($_POST["interaction"])) {
            $interaction = $_POST["interaction"];
            // Insert interaction into the interactions table
            $insertInteractionQuery = "INSERT INTO interactions (post_id, interaction_type) VALUES ('$post_id', '$interaction')";
            $conn->query($insertInteractionQuery);
        }
    } else {
        echo "Error inserting post: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
