<?php
$servername ='localhost';
$username='root';
$database='spu_booking system';
$password=''

//get data

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staffName = $_POST['staff_name'];
    $staffEmail = $_POST['staff_email'];
    $bookingDate = $_POST['booking_date'];

    // Validate the form inputs
    if (empty($staffName) || empty($staffEmail) || empty($bookingDate)) {
        echo "Please fill in all the required fields.";
        exit;
    }

    //create connectin to database.


 $conn = mysqli_connect($servername,$database, $username, $password);

 // Check connection
 if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
 }
 echo "Connected successfully \n";

 //store data to database
 $sql "INSERT INTO book_device(staffName,spuNumber,staffEmail,bookingDate) 
        VALUES('staff_name', 'spu_number', 'staff_email', 'booking_date')";

//veryfying  connection to and entry of data to database

if ($conn->query($sql)===TRUE){

    echo "Enquiry entered succesfully...";
}else {
    echo "Enquiry not entered. Try again";
  
  $conn->close();}


}
  //send email.
  $managerEmail = 'enyamway@spu.ac.ke'; 
  $fromEmail = '$staffEmail'; 

  $subject = 'Projector Booking Request';
  $message = "Staff Name: $staffName\n";
  $message .= "Staff Email: $staffEmail\n";
  $message .= "Booking Date: $bookingDate\n";

  $headers = "From: $fromEmail\r\n";
  $headers .= "Reply-To: $staffEmail\r\n";

  if (mail($managerEmail, $subject, $message, $headers)) {
      echo "Booking request submitted successfully.";
  } else {
      echo "Error sending the booking request.";
  }

?>