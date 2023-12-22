<?php

// Start the session to get the logged-in user ID
// session_start();

// Retrieving user input from the POST request
$clinicType = $_POST['clinicType'];
$dateOfClinic = $_POST['dateOfClinic'];
$userId = $_POST['userId'];
$appointmentNo = $_GET['appointmentNo'];

// Validate input
if (empty($dateOfClinic) || empty($userId)) {
    // Handle validation error
    echo '<script>alert("Please fill out all required fields.");</script>';
    echo '<script>history.go(-1);</script>';
    exit();  // Stop further execution
}

// Check if the logged-in user ID matches the reservation user ID
// if ($_SESSION['userId'] != $userId) {
//     // Handle validation error
//     echo '<script>alert("Invalid user ID.");</script>';
//     echo '<script>history.go(-1);</script>';
//     exit();  // Stop further execution
// }

// Connect to the database
$con=mysqli_connect("localhost","root","","patient");

// Check for database connection error
if(!$con){
    echo "connection error";
    die();
}

// This will look for same day appointments
$query = "SELECT * FROM reservations WHERE clinicType = '$clinicType' AND dateOfClinic = '$dateOfClinic' AND userId = '$userId'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    // Handle case where the user already has an appointment for the same clinic on the same day
    echo '<script>alert("You already have an appointment for the selected clinic on the same day.");</script>';
    echo '<script>history.go(-1);</script>';
    exit();  // Stop further execution
}


// Check for the last appointment number assigned for the given clinic and date
$query = "SELECT MAX(appointmentNo) AS maxAppointmentNo FROM reservations WHERE clinicType = '$clinicType' AND dateOfClinic = '$dateOfClinic'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

// Assign a new appointment number (incremented by 1, but not exceeding 80)
$maxAppointmentNo = ($row['maxAppointmentNo'] === null) ? 0 : $row['maxAppointmentNo'];

// Check if the next appointment number will exceed 80
$appointmentNo = ($maxAppointmentNo < 80) ? $maxAppointmentNo + 1 : 1;


// Insert user information into the 'reservations' table
$result = mysqli_query($con,"insert into reservations values('$clinicType','$dateOfClinic','$userId','$appointmentNo')");

if($result){
    echo "<script>window.location='displayNumber.html?clinicType=$clinicType&appointmentNo=$appointmentNo';</script>";
} else {
    // Handle database insertion error
    echo '<script>alert("Invalid.");</script>';
}

?>