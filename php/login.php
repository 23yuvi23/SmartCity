<?php
header("Content-Type: application/json");

// Database Connection
$host = "localhost";
$user = "root"; 
$password = "";
$database = "smart_city"; 

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Get User Data
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($data['email'], $data['password'])) {
        echo json_encode(["error" => "Email and Password required"]);
        exit;
    }

    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $password = $data['password'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["error" => "Invalid email format"]);
        exit;
    }

    // Validate password
    if (empty($password)) {
        echo json_encode(["error" => "Password cannot be empty"]);
        exit;
    }

    // Check user in DB
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            echo json_encode(["success" => "Login successful!", "user_id" => $user_id]);
        } else {
            echo json_encode(["error" => "Invalid password"]);
        }
    } else {
        echo json_encode(["error" => "User does not exist"]);
    }

    $stmt->close();
}

$conn->close();
?>
