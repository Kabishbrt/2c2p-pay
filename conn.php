<?php
// Database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "twocp";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$createTableSQL = "
CREATE TABLE IF NOT EXISTS payment_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    locale VARCHAR(10) NOT NULL,
    invoice_no VARCHAR(50) NOT NULL,
    channel_code VARCHAR(20) NOT NULL,
    response_code VARCHAR(10) NOT NULL,
    response_desc TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($createTableSQL) === TRUE) {
} else {
    echo "Error creating table: " . $conn->error;
}

?>