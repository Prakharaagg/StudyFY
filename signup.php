<?php
// Database Connection
$conn = new mysqli("localhost", "root", "Sms4905@", "studyfy");

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get Form Data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check Password Match
if ($password !== $confirm_password) {
    die("Passwords do not match!");
}

// Hash Password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into Database
$sql = "INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $fullname, $email, $username, $hashed_password);

if ($stmt->execute()) {
    echo "Signup successful! <a href='login.html'>Go to Login</a>";
} else {
    echo "Error: " . $stmt->error;
}

// Close Connection
$stmt->close();
$conn->close();
?>
