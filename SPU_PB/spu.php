<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staffName = $_POST['staff_name'];
    $spuNumber =$_POST['spu_number'];
    $staffEmail = $_POST['staff_email'];
    $deviceName =$_POST['device_name'];
    $borrowDate = $_POST['borrow_date'];
    $returnDate = $_POST['return_date'];

    // Validate the form inputs
    if (empty($staffName) || empty($spuNumber)|| empty($staffEmail) || empty($deviceName) || empty($borrowDate)) {
        echo "Please fill in all the required fields.";
        exit;
    }

    // Send email notification to the ICT manager
    $managerEmail = 'enyamwaya@spu.ac.ke'; // Replace with the actual ICT manager's email
    $fromEmail = "$staffEmail\n"; // Replace with the sender's email

    $subject = 'Projector Borrowing Request';
    $message = "Staff Name: $staffName\n";
    $message .= "Staff Email: $staffEmail\n";
    $message .= "Borrow Date: $borrowDate\n";

    $headers = "From: $fromEmail\r\n";
    $headers .= "Reply-To: $staffEmail\r\n";

    if (mail($managerEmail, $subject, $message, $headers)) {
        echo "Borrowing request submitted successfully.";
    } else {
        echo "Error sending the borrowing request.";
    }
}
