<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shipping Dashboard</title>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <link rel="stylesheet" href="styles.css">
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
      $result = $pdo->query("SELECT AVG(DATEDIFF(delivered_date, shipped_date)) AS avg_delivery_days FROM shipping");
      $row = $result->fetch();
      $avg_delivery_days = round($row['avg_delivery_days']);

      // Get recent customers
      $result = $pdo->query("SELECT DISTINCT customer_id FROM shipping ORDER BY shipped_date DESC LIMIT 5");
      $customers = [];
      while($row = $result->fetch()) {
        $customer_id = $row['customer_id'];
        $customer_result = $pdo->query("SELECT * FROM customer WHERE customer_id = $customer_id");
        $customer = $customer_result->fetch();
        $customers[] = $customer;
      }

      // Calculate average tax
      $result = $pdo->query("SELECT AVG(handling_cost) AS avg_tax_cost FROM shipping");
      $row = $result->fetch();
      $avg_tax_cost = round($row['avg_tax_cost'], 2);

      // Calculate average fee
      $result = $pdo->query("SELECT AVG(handling_cost + insurance_cost) AS avg_fee FROM shipping");
      $row = $result->fetch();
      $avg_fee = round($row['avg_fee'], 2);

      // Get top 5 fees
      $result = $pdo->query("SELECT handling_cost + insurance_cost AS fee FROM shipping ORDER BY fee DESC LIMIT 5");
      $top_fees = [];
      while($row = $result->fetch()) {
        $top_fees[] = $row['fee'];
      }
     
    ?>

      <div class="card1">
        <h2>Average Delivery Days</h2>
        <p style="font-size:40px"><?php echo $avg_delivery_days; ?> days</p>
      </div>

      <div class="card2">
        <h2>Average Tax Cost</h2>
        <p style="font-size:40px">$<?php echo $avg_tax_cost; ?></p>
      </div>

      <div class="card3">
        <h2>Average Fee</h2>
        <p style="font-size:40px">$<?php echo $avg_fee; ?></p>
      </div>

      <div class="canvas">
        <p id="canva">Top 5 Expensive Shippings</p>
        <div id="bar-chart"></div>
        <script>
          var data = [{
            x: ["1", "2", "3", "4", "5"],
            y: [<?php echo implode(',', $top_fees); ?>],
            type: 'bar'
            
          }];
          var layout = {
        width: 600, // set the width of the chart in pixels
        height: 375 // set the height of the chart in pixels
};

        Plotly.newPlot('bar-chart', data, layout); // replace 'myDiv' with the ID of your chart container

        </script>
      </div>
  </div>
</body>

</html>