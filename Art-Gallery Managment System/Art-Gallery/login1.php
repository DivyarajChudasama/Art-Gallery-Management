<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup/Login Page</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="container">
    <div class="form" id="signup-form">
      <h2>Sign Up</h2>
      <form method="POST" action="register.php">
        <div class="form-control">  
          <label for="username">Username</label>
         <strong> <input type="text" id="username"  name="username" placeholder="Enter your username" required></strong>
        </div>
        <div class="form-control">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <input type="password" id="password"  name="password" placeholder="Enter your password" required>
        </div>
        
        <button type="submit" href="login1.php">Sign Up</button>
        <p onclick="showLoginForm()">Already have an account? Log in</p>
      </form>
    </div>
    <div class="form login" id="login-form">
      <h2>Log In</h2>
      <form action="login.php" method="POST">
        <div class="form-control">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <input type="password" id="password" name="pass" placeholder="Enter your password" required>
        </div>
        <button type="submit" id="submit1">Log In</button>
        <p onclick="showSignupForm()">Don't have an account?Sign up </p>
      </form>
    </div>
  </div>
     
  <script src="login.js"></script>
</body>
</html>