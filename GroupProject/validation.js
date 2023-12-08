
function validateForm() {
  var userId = document.getElementById("userid").value;
  var fullName = document.getElementById("fullName").value;
  var address = document.getElementById("address").value;
  var age = document.getElementById("age").value;
  var dob = document.getElementById("dateofbirth").value;
  var phoneNumber = document.getElementById("phoneNumber").value;
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirmPassword").value;

  // Check if required fields are empty
  if (
    userId === "" ||
    fullName === "" ||
    address === "" ||
    age === "" ||
    dob === "" ||
    phoneNumber === "" ||
    password === "" ||
    confirmPassword === ""
  ) {
    alert("All fields must be filled out");
    return false;
  }

  // Check if phone number has 10 digits
  if (!/^\d{10}$/.test(phoneNumber)) {
    alert("Phone number must have 10 digits");
    return false;
  }

  // Check if password and confirm password match
  if (password !== confirmPassword) {
    alert("Passwords do not match");
    return false;
  }

  // Check if password meets criteria
  var passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;
  if (!passwordPattern.test(password)) {
    alert(
      "Password must be at least 8 characters and include at least one uppercase letter, one lowercase letter, one digit, and one special character."
    );
    return false;
  }

  return true;
}
