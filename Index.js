document.getElementById("regForm").addEventListener("submit", function (event) {
  // Stop form from submitting by default
  event.preventDefault();

  // Clear previous errors
  document.getElementById("firstNameError").innerText = "";
  document.getElementById("lastNameError").innerText = "";
  document.getElementById("emailError").innerText = "";
  document.getElementById("imgError").innerText = "";
  document.getElementById("passError").innerText = "";
  document.getElementById("conPassError").innerText = "";
  document.getElementById("numError").innerText = "";

  // Get input values
  let firstName = document.getElementById("firstName").value.trim();
  let lastName = document.getElementById("lastName").value.trim();
  let email = document.getElementById("email").value.trim();
  let gender = document.getElementById("inputState").value;
  let image = document.getElementById("image").value;
  let password = document.getElementById("password").value;
  let conPassword = document.getElementById("conPassword").value;
  let number = document.getElementById("number").value.trim();

  // Validation flag
  let isValid = true;

  // ======= First Name =======
  if (firstName === "") {
    document.getElementById("firstNameError").innerText = "First name is required";
    isValid = false;
  } else if (!/^[a-zA-Z-' ]+$/.test(firstName)) {
    document.getElementById("firstNameError").innerText = "Only letters allowed";
    isValid = false;
  }

  // ======= Last Name =======
  if (lastName === "") {
    document.getElementById("lastNameError").innerText = "Last name is required";
    isValid = false;
  } else if (!/^[a-zA-Z-' ]+$/.test(lastName)) {
    document.getElementById("lastNameError").innerText = "Only letters allowed";
    isValid = false;
  }

  // ======= Email =======
  if (email === "") {
    document.getElementById("emailError").innerText = "Email is required";
    isValid = false;
  } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    document.getElementById("emailError").innerText = "Invalid email format";
    isValid = false;
  }

  // ======= Gender =======
  if (gender === "Select Gender") {
    alert("Please select your gender");
    isValid = false;
  }

  // ======= Image =======
  if (image === "") {
    document.getElementById("imgError").innerText = "Please upload an image";
    isValid = false;
  }

  // ======= Password =======
  if (password === "") {
    document.getElementById("passError").innerText = "Password is required";
    isValid = false;
  } else if (password.length < 6) {
    document.getElementById("passError").innerText = "At least 6 characters required";
    isValid = false;
  }

  // ======= Confirm Password =======
  if (conPassword === "") {
    document.getElementById("conPassError").innerText = "Confirm password required";
    isValid = false;
  } else if (password !== conPassword) {
    document.getElementById("conPassError").innerText = "Passwords do not match";
    isValid = false;
  }

  // ======= Phone Number =======
  if (number === "") {
    document.getElementById("numError").innerText = "Phone number is required";
    isValid = false;
  } else if (!/^[0-9]{11}$/.test(number)) {
    document.getElementById("numError").innerText = "Enter 11-digit valid number";
    isValid = false;
  }

  // If all validation passes, submit the form
  if (isValid) {
    this.submit();
  }
});