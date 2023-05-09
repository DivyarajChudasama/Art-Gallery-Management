<?php
$dsn = 'mysql:host=localhost;dbname=my_gallery';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

// Get the form data
$title = $_POST['title'];
$artist_id = $_POST['artist_id'];
$year_created = $_POST['year_created'];
$medium = $_POST['medium'];
$dimensions = $_POST['dimensions'];
$price = $_POST['price'];
$availability = $_POST['availability'];
$description = $_POST['description'];

// Check if the artist ID exists in the artist table
$stmt = $pdo->prepare("SELECT Artist_ID FROM artist WHERE Artist_ID = ?");
$stmt->execute([$artist_id]);

if ($stmt->rowCount() == 0) {
  // Artist ID does not exist in artist table
  // Handle the error, for example by displaying an error message to the user
} else {
  // Artist ID exists in artist table, proceed with insert
  // Generate a unique file name for the uploaded image
  $imageFileName = uniqid() . '_' . $_FILES['image']['name'];
  
  // Set the upload directory
  $uploadDirectory = 'uploads/';
  $imagePath = $uploadDirectory . $imageFileName;
  
  // Upload the image file to the server
  move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
  
  // Insert the artwork details into the artwork table
  $stmt = $pdo->prepare("INSERT INTO artwork (Title, Artist_ID, Year_created, Medium, Dimensions, Price, Availability, meta, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->execute([$title, $artist_id, $year_created, $medium, $dimensions, $price, $availability, $imagePath, $description]);
  
  // Handle success, for example by redirecting to a success page
}
