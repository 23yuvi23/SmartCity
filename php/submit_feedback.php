<?php
// Database connection
$host = "localhost";
$username = "root";  // Change if necessary
$password = "";  // Change if necessary
$database = "smart_city";  // Using the existing database

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data (handling missing fields with empty defaults)
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$contact = $_POST['contact'] ?? '';
$address = $_POST['address'] ?? '';
$complaint_id = $_POST['complaintId'] ?? '';
$issue_type = $_POST['issueType'] ?? '';
$satisfaction_rating = $_POST['satisfactionRating'] ?? '';
$comments = $_POST['comments'] ?? '';

// Validation: Ensure name and email are not empty
if (empty($name) || empty($email)) {
    die("Error: Name and Email are required fields.");
}

// Insert into database
$sql = "INSERT INTO feedback (name, email, contact, address, complaint_id, issue_type, satisfaction_rating, comments) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssisis", $name, $email, $contact, $address, $complaint_id, $issue_type, $satisfaction_rating, $comments);

if ($stmt->execute()) {
    echo "Feedback submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
