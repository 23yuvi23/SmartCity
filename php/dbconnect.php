<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$host = "localhost";
$user = "root";
$password = "";
$database = "smart_city"; // Change this to your actual database name

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($data['email'], $data['username'], $data['phone'], $data['password'])) {
        echo json_encode(["error" => "Missing required fields"]);
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

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, username, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $email, $username, $phone, $password);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Signup successful!"]);
    } else {
        echo json_encode(["error" => "Error: " . $stmt->error]);
    }
    
    $stmt->close();
}

$conn->close();
?>
