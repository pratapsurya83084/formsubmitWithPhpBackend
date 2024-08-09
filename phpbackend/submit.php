<?php
//cors policy add


header('Content-Type: application/json');

// CORS headers  if CORS Header is not add then exist cors error 
// and value is not send frontend to backend

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

header('Content-Type: application/json');

// Database credentials
$host = 'localhost';//default:3306  port
$db = 'userform'; // 
$user = 'root'; //pratap Replace with your database username
$pass = ''; //pratap@#12345 Replace with your database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the posted data
$data = json_decode(file_get_contents("php://input"), true);
echo $data;

if (
    isset($data['username']) &&
    isset($data['email']) &&
    isset($data['contact_no']) &&
    isset($data['country']) &&
    isset($data['jobrole'])
) {
    $username = $conn->real_escape_string($data['username']);
    $email = $conn->real_escape_string($data['email']);
    $contact_no = $conn->real_escape_string($data['contact_no']);
    $country = $conn->real_escape_string($data['country']);
    $jobrole = $conn->real_escape_string($data['jobrole']);

    // users is table name
    // $sql = "INSERT INTO users (username, email, contact_no, country, jobrole)
    // VALUES ('$username', '$email', '$contact_no', '$country', '$jobrole')";
    $sql = "INSERT INTO `users` (`username`, `email`, `contact_no`, `country`, `jobrole`)
    VALUES ('$username', '$email', '$contact_no', '$country', '$jobrole')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Form submitted successfully!"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["message" => "Invalid input"]);
}

$conn->close();
?>



