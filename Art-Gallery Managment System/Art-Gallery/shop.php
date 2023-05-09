<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_gallery1";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

// Fetch product data from database
$stmt = $conn->prepare("SELECT image, description FROM artworky");
$stmt->execute();

// Display products in a card format
while ($row = $stmt->fetch()) {
  $image = $row['image'];
  $description = $row['description'];

  echo "<div class='card'>";
  echo "<img src='$image'>";
  echo "<div class='card-description'>" . substr($description, 0, 100) . "... <a href='#'>Read More</a></div>";
  echo "</div>";
}
?>

<html>
    <head>
        <link rel="stylesheet" href="shop.css">
    </head>
    <body>
    </body>
</html>