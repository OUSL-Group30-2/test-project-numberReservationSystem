<?php

// Retrieving user input from the POST request
$userId = $_POST['userId'];
$fullName = $_POST['fullName'];
$address = $_POST['address'];
$age = $_POST['age'];
$dateOfBirth = $_POST['dateOfBirth'];
$phoneNumber = $_POST['phoneNumber'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$gender = isset($_POST["gender"]) ? $_POST["gender"] : null;

// Variable to track the overall validity of the input
$isValid = true;

// Check for empty fields in registration form
if (empty($userId) || empty($fullName) || empty($address) || empty($age) || empty($dateOfBirth) || empty($phoneNumber) || empty($password) || empty($confirmPassword)) {
    echo '<script>
            alert("Please fill in all fields.");
          </script>';
    $isValid = false;
}
// Check for valid phone number format in registration form
elseif (!preg_match('/^\d{10}$/', $phoneNumber)) {
    echo '<script>
            alert("Invalid Phone Number.");
          </script>';
    $isValid = false;
}
// Check for valid password criteria in registration form(check if the password length is not equal to 8, there is no uppercase letter in the password, there is no lowercase letter in the password, there is no digit in the password,there is no special character in the password)
elseif (strlen($password) !== 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[^a-zA-Z\d]/', $password)) {
    echo '<script>
            alert("Password must be 8 characters and contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
          </script>';
    $isValid = false;
}
// Check if passwords match
elseif($password != $confirmPassword){
    echo '<script>
            alert("Password does not match");
          </script>';
    $isValid = false;
}else {
    // Calculate age based on date of birth
    $dob = new DateTime($dateOfBirth);
    $today = new DateTime();
    $diff = $today->diff($dob);
    $calculatedAge = $diff->y;

    // Compare calculated age with entered age
    if ($calculatedAge != $age) {
        echo '<script>
                alert("Age does not match with the provided date of birth.");
              </script>';
        $isValid = false;
    }
}

// If validation fails, redirect with user input
if (!$isValid) {
    $redirectUrl = "signUpPage.html?userId=$userId&fullName=$fullName&address=$address&age=$age&dateOfBirth=$dateOfBirth&phoneNumber=$phoneNumber&gender=$gender";
    echo "<script>window.location.href='$redirectUrl';</script>";
    die();
}

// Connect to the database
$con=mysqli_connect("localhost","root","","patient");

// Check for database connection error
if(!$con){
    echo "connection error";
    die();
}

// Insert user information into the 'signup' table
$result = mysqli_query($con,"insert into signup values('$userId','$fullName','$address','$age','$dateOfBirth','$phoneNumber','$password','$gender')");
if($result){
    echo "<script>window.location='homePage.html';</script>";
}else{
    echo "<script>window.location='signUpPage.html';</script>";
}
?>