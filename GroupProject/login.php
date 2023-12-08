<?php

$userId = $_POST['userId'];
$password = $_POST['password'];

$con=mysqli_connect("localhost","root","","patient");

if(!$con){
    echo "connection error";
    die();
}

$result=mysqli_query($con,"select * from signup where userId='$userId' and password='$password' ");
$boolean=false;
while ($row=mysqli_fetch_array($result)) {
    $boolean=true;
}
 
if($boolean){
  echo "<script>";
  echo "alert('Successfully loginned');";
  echo "window.location='clinic.html';";
  echo "</script>";
}else{
  echo "<script>";
  echo "alert('Wrong User');";
  echo "window.location='homePage.html';";
  echo "</script>";
}
?>