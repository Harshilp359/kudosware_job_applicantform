<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root"; // default username for XAMPP/WAMP
$password = "Harshil@10"; // default password for XAMPP/WAMP
$dbname = "kudosware";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $role = $_POST['role'];

    // Handle file upload
    $target_dir = "uploads/";
    $resume = basename($_FILES["resume"]["name"]);
    $target_file = $target_dir . time() . "_" . $resume; // Adding time() to make the filename unique

    // Check if the uploads directory exists
    if (!is_dir($target_dir)) {
        die("The uploads directory does not exist.");
    }

    // Attempt to move the uploaded file
    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO job_seekers (name, email, contact, age, role, resume) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("sssiss", $name, $email, $contact, $age, $role, $target_file);

        // Execute the statement
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        } else {
            // Redirect to success page
            header("Location: success.html");
            exit();
        }

        $stmt->close();
    } else {
        die("Sorry, there was an error uploading your file.");
    }
}

$conn->close();
?>
