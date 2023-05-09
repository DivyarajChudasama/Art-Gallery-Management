<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shipping Dashboard</title>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <link rel="stylesheet" href="stylea.css">
</head>
<body>
  <h1>Shipping Dashboard</h1>
  
  <div class="topnav">
  <a class="active" href="datam.php">Home</a>
  </div>
  <div class="cards-container">
    <?php
      require_once "connect.php";
      $pdo->query("USE my_gallery");

      // Calculate average delivery days

      $result = $pdo->query("SELECT a.title, COUNT(*) AS sales_count 
      FROM artwork a 
      JOIN sale s ON a.artwork_id = s.artwork_id 
      GROUP BY a.artwork_id 
      ORDER BY sales_count DESC 
      LIMIT 1");
$row = $result->fetch();
$title = $row['title'];
$sales_count = $row['sales_count'];
?>

<div class="card1">
  <h2>Most Expensive Artwork</h2>
  <p style="font-size:30px;"><?php echo $row['a.Title']; ?></p>
  <p style="font-size:20px;">Price: $<?php echo $row['a.price']; ?></p>
</div>
<div class="card2">
  <h2>Most Popular Artwork</h2>
  <p><?php echo $title; ?></p>
  <p>Sales Count: <?php echo $sales_count; ?></p>
</div>
<div class="card3">
  <h2>Most Expensive Artwork</h2>
  <p><?php echo $title; ?></p>
  <p>Price: <?php echo $price; ?></p>
</div>
</body>

</html>