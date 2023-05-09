<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_gallery1";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // prepare sql and bind parameters
  $stmt = $conn->prepare("INSERT INTO data1 (username, email, password) 
  VALUES (:username, :email, :password)");
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $password);

  // insert a row
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $stmt->execute();
  $success = true;

 
  // redirect to another file
  header("Location:login1.php");
  exit();
 
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
if($success) {
  echo "<script>alert('Signup successful!')</script>";
}
?>
