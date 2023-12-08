<?php

$userId = $_POST['userId'];
$fullName = $_POST['fullName'];
$address = $_POST['address'];
$age = $_POST['age'];
$dateOfBirth = $_POST['dateOfBirth'];
$phoneNumber = $_POST['phoneNumber'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$gender = isset($_POST["gender"]) ? $_POST["gender"] : null;

$isValid = true;

if (empty($userId) || empty($fullName) || empty($address) || empty($age) || empty($dateOfBirth) || empty($phoneNumber) || empty($password) || empty($confirmPassword)) {
    echo '<script>
            alert("Please fill in all fields.");
          </script>';
    $isValid = false;
}

elseif (!preg_match('/^\d{10}$/', $phoneNumber)) {
    echo '<script>
            alert("Invalid Phone Number.");
          </script>';
    $isValid = false;
}

elseif (strlen($password) < 6 || strlen($password) > 16 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[^a-zA-Z\d]/', $password)) {
    echo '<script>
            alert("Password must be between 6 and 16 characters and contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
          </script>';
    $isValid = false;
}

elseif($password != $confirmPassword){
    echo '<script>
            alert("Password does not match");
          </script>';
    $isValid = false;
}

if (!$isValid) {
    $redirectUrl = "signUpPage.html?userId=$userId&fullName=$fullName&address=$address&age=$age&dateOfBirth=$dateOfBirth&phoneNumber=$phoneNumber&gender=$gender";
    echo "<script>window.location.href='$redirectUrl';</script>";
    die();
}

$con=mysqli_connect("localhost","root","","patient");

if(!$con){
    echo "connection error";
    die();
}

$result = mysqli_query($con,"insert into signup values('$userId','$fullName','$address','$age','$dateOfBirth','$phoneNumber','$password','$gender')");
if($result){
    echo "successfully registered";
}else{
    echo "Failed";
}
?>