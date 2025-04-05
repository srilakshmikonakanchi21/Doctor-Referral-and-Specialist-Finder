<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection details
$servername = "localhost";
$username = "root";  // Replace with your MySQL username
$password = "Kavya@16";  // Replace with your MySQL password
$dbname = "hospital_db";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize input
    $doc_id = mysqli_real_escape_string($conn, $_POST['doc_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $Password= mysqli_real_escape_string($conn, $_POST['Password']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $Hospital= mysqli_real_escape_string($conn, $_POST['Hospital']);
    $SpecilaistIN = mysqli_real_escape_string($conn, $_POST['SpecilaistIN']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);

    // Prepare SQL query to insert data into the patients table
    $sql = "INSERT INTO doctorreg (doc_id , name,Password, age, gender, address, Hospital, SpecilaistIN, contact_number) 
            VALUES ('$doc_id','$name','$Password', '$age', '$gender', '$address', '$Hospital', '$SpecilaistIN', '$contact_number')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "doctor registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>