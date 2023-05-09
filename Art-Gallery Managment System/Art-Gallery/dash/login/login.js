// Get the signup and login buttons
const signupButton = document.getElementById("signup-button");
const loginButton = document.getElementById("login-button");

// Get the signup and login forms
const signupForm = document.getElementById("signup-form");
const loginForm = document.getElementById("login-form");

// Add event listeners to the buttons
signupButton.addEventListener("click", showSignupForm);
loginButton.addEventListener("click", showLoginForm);

// Function to show the signup form and hide the login form
function showSignupForm() {
  signupForm.style.display = "block";
  loginForm.style.display = "none";
}

// Function to show the login form and hide the signup form
function showLoginForm() {
  loginForm.style.display = "block";
  signupForm.style.display = "none";
}