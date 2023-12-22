<?php

// Retrieving user input from the POST request
$userId = $_POST['userId'];
$password = $_POST['password'];

// Connect to the database
$con=mysqli_connect("localhost","root","","patient");

// Check for database connection error
if(!$con){
    echo "connection error";
    die();
}

// Query the database to check if the user credentials are valid
$result=mysqli_query($con,"select * from signup where userId='$userId' and password='$password' ");
// Variable to indicate whether a matching user was found in the database
$boolean=false;

// Loop through the result set to check if there is a matching user
while ($row=mysqli_fetch_array($result)) {
    $boolean=true;
}
 
if($boolean){
  echo "<script>";
  echo "alert('Successfully logged in');";
  echo "window.location='clinic.html';";
  echo "</script>";
}else{
  echo "<script>";
  echo "alert('Invalid user Id or password');";
  echo "window.location='homePage.html';";
  echo "</script>";
}
?>