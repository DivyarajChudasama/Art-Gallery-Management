<!DOCTYPE html>
<html>
<head>
	<title>Customer Dashboard</title>
	<link rel="stylesheet" href="stylec.css">
</head>
<body>
	<h1>Customer Dashboard</h1>
	<?php
		include 'connect.php'; // include the PDO database connection file
		$pdo->query("USE my_gallery");
		// Customer table queries
		$total_customers_query = $pdo->query("SELECT COUNT(*) FROM customer");
		$average_time_between_purchases_query = $pdo->query("SELECT AVG(DATEDIFF( created_date,last_purchase_date)) FROM customer");
		$total_revenue_query = $pdo->query("SELECT SUM(sale_price) AS total_price FROM sale");
		$new_customers_query = $pdo->query("SELECT COUNT(*) FROM customer WHERE created_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)");

		// Execute each query and store the result in a variable
		$total_customers = $total_customers_query->fetchColumn();
		$average_time_between_purchases = round($average_time_between_purchases_query->fetchColumn(), 2);
		$total_revenue = number_format($total_revenue_query->fetchColumn(), 2);
		$new_customers = $new_customers_query->fetchColumn();

		echo "<div class='topnav'>";
  		echo "<a class='active' href='datam.php'>Home</a>";
		echo "</div>";

		// Display the results in card view
		echo "<div class='card-deck'>";

		// Total customers
		echo "<div class='card bg-success text-white'>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>Total Customers</h5>";
		echo "<p class='card-text'>" . $total_customers . "</p>";
		echo "</div>";
		echo "</div>";

		// Average time between first and last purchase
		echo "<div class='card bg-success text-white'>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>Average Time Between First and Last Purchase</h5>";
		echo "<p class='card-text'>" . $average_time_between_purchases . " days</p>";
		echo "</div>";
		echo "</div>";

		// Total revenue
		echo "<div class='card bg-warning text-white'>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>Total Revenue from Customers</h5>";
		echo "<p class='card-text'>$" . $total_revenue . "</p>";
		echo "</div>";
		echo "</div>";

		// Number of new customers in the last 30 days
		echo "<div class='card bg-primary text-white'>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>Number of New Customers in the Last 30 Days</h5>";
		echo "<p class='card-text'>" . $new_customers . "</p>";
		echo "</div>";
		echo "</div>";

		echo "</div>"; // close card-deck div

		// Add more card views or modify existing ones as needed
		// For example, you could add a card view for the number of customers with a valid email address, or the number of customers who have not made a purchase in the last 30 days.
		?>

</body>
</html>