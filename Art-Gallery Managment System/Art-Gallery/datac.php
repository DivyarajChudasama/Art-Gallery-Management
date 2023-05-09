<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insights Dashboard</title>
  <link rel="stylesheet" href="stylec.css">
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
<div class="topnav">
  <a class="active" href="datam.php">Home</a>
  </div>
  <h1>Insights Dashboard</h1>

  <div class="cards-container">
    <?php
      require_once "connect.php";
      $pdo->query("USE my_gallery");

      // Get the quarterly sales data for Q1
$q1_query = "SELECT SUM(net_income) AS q1_sales FROM finance WHERE QUARTER(pay_date) = 1";
$q1_result = $pdo->query($q1_query);
$q1_row = $q1_result->fetch();
$q1_sales = $q1_row['q1_sales'];

// Get the quarterly sales data for Q2
$q2_query = "SELECT SUM(net_income) AS q2_sales FROM finance WHERE QUARTER(pay_date) = 2";
$q2_result = $pdo->query($q2_query);
$q2_row = $q2_result->fetch();	
$q2_sales = $q2_row['q2_sales'];

// Get the quarterly sales data for Q3
$q3_query = "SELECT SUM(net_income) AS q3_sales FROM finance WHERE QUARTER(pay_date) = 3";
$q3_result = $pdo->query($q3_query);
$q3_row = $q3_result->fetch();
$q3_sales = $q3_row['q3_sales'];

// Get the quarterly sales data for Q4
$q4_query = "SELECT SUM(net_income) AS q4_sales FROM finance WHERE QUARTER(pay_date) = 4";
$q4_result = $pdo->query($q4_query);
$q4_row = $q4_result->fetch();
$q4_sales = $q4_row['q4_sales'];


      // Get top 5 fees
      $result = $pdo->query("SELECT YEAR(pay_date) as year, QUARTER(pay_date) as quarter, SUM(revenue) as total_revenue, SUM(expenses) as total_expense, SUM(revenue - expenses) as quarterly_profit FROM finance GROUP BY YEAR(pay_date), QUARTER(pay_date);");
      $top_fees = [];
      while($row = $result->fetch()) {
        $top_fees[] = $row['total_revenue'];
      }

    ?>
	<div class="card1">
        <h2>Quater1</h2>
        <p style="font-size:40px">$<?php echo 	 number_format($q1_sales, 2)."<br>"; ?> </p>
      </div>

      <div class="card2">
        <h2>Quater2</h2>
        <p style="font-size:40px">$<?php echo  number_format($q2_sales, 2)."<br>"; ?></p>
      </div>

      <div class="card3">
        <h2>Quater3</h2>
        <p style="font-size:40px">$<?php echo   number_format($q3_sales, 2) . "<br>" ?></p>
      </div>
      <div class="card3">
        <h2>Quater4</h2>
        <p style="font-size:40px">$<?php echo number_format($q4_sales, 2) . "<br>" ?></p>
      </div>
      <div class="card">
        <h2>Quaterly Sales </h2>
        <div id="Scatter-chart"></div>
        <script>
          var data = [{
            x: ["1", "2", "3", "4"],
            y: [<?php echo implode(',', $top_fees); ?>],
            type: 'scatter',
			mode:'lines+markers'
          }];
		  var layout = {
        width: 500, // set the width of the chart in pixels
        height: 500 // set the height of the chart in pixels
};
          Plotly.newPlot('Scatter-chart', data,layout);
        </script>
      </div>
  </div>
</body>

</html>
