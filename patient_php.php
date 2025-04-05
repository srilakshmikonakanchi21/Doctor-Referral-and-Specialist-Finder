<?php
$servername = "localhost";
$username = "root";
$password = "Kavya@16";
$dbname = "hospital_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $problem = mysqli_real_escape_string($conn, $_POST['problem']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $DoctorName = mysqli_real_escape_string($conn, $_POST['DoctorName']);

    // Get and sanitize date input (expected format: DD:MM:YYYY)
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    // Split by colon and check the format
    $date_array = explode(":", $appointment_date);
    if (count($date_array) === 3) {
        // Convert to MySQL's YYYY-MM-DD format
        $appointment_date_converted = $date_array[2] . "-" . $date_array[1] . "-" . $date_array[0];
    } else {
        die("Invalid date format. Please use DD:MM:YYYY.");
    }

    // Get and sanitize time input (expected format: HH:MM)
    $appointment_time = mysqli_real_escape_string($conn, $_POST['appointment_time']);
    // Ensure it's in the HH:MM format and append seconds
    if (preg_match("/^\d{2}:\d{2}$/", $appointment_time)) {
        $appointment_time_converted = $appointment_time . ":00"; // Convert to HH:MM:SS
    } else {
        die("Invalid time format. Please use HH:MM.");
    }

    // Prepare SQL query to insert data into the patients table
    $sql = "INSERT INTO patients (name, age, gender, address, blood_group, problem, contact_number, DoctorName, appointment_date, appointment_time) 
            VALUES ('$name', '$age', '$gender', '$address', '$blood_group', '$problem', '$contact_number', '$DoctorName', '$appointment_date_converted', '$appointment_time_converted')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "New patient record created successfully!";
    } else {
        echo "Error: " . $conn->error; // Print only the error
    }
}

// Close the connection
$conn->close();
?>
