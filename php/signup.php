<?php
header("Content-Type: application/json");

// Database Connection
$host = "localhost";
$user = "root"; // Change if needed
$password = "";
$database = "smart_cityzx"; // Change to your actual database name

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Get User Data
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($data['email'], $data['username'], $data['phone'], $data['password'])) {
        echo json_encode(["error" => "All fields are required"]);
        exit;
    }

    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $username = htmlspecialchars($data['username']);
    $phone = htmlspecialchars($data['phone']);
    $password = $data['password'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["error" => "Invalid email format"]);
        exit;
    }

    // Validate phone number (example: must be 10 digits)
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        echo json_encode(["error" => "Invalid phone number"]);
        exit;
    }

    // Validate username
    if (empty($username)) {
        echo json_encode(["error" => "Username cannot be empty"]);
        exit;
    }

    // Validate password (example: minimum 8 characters)
    if (strlen($password) < 8) {
        echo json_encode(["error" => "Password must be at least 8 characters long"]);
        exit;
    }

    $password = password_hash($password, PASSWORD_DEFAULT); // Hash password for security

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo json_encode(["error" => "Email already registered"]);
        exit;
    }

    $checkEmail->close();

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO users (email, username, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $username, $phone, $password);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => "Signup successful!"]);
    } else {
        echo json_encode(["error" => "Signup failed"]);
    }

    $stmt->close();
}

$conn->close();
?>
