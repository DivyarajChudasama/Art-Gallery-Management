<?php
if(!isset($_SESSION)){session_start();}
// Define database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_gallery1";
// Query to select shipped and delivered dates
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$sql = "SELECT shipped_date, delivered_date FROM shipping";

// Execute query
$stmt = $conn->prepare($sql);
$stmt->execute();

// Fetch results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate average delivery days
$total_days = 0;
$count = 0;
foreach($results as $result) {
    if ($result['shipped_date'] && $result['delivered_date']) {
        $shipped_date = new DateTime($result['shipped_date' ]);
        $delivered_date = new DateTime($result['delivered_date']);
        $delivery_days = $shipped_date->diff($delivered_date)->days;
        $total_days += $delivery_days;
        $count++;
    }
}
$average_delivery_days = ($count > 0) ? round($total_days / $count, 2) : 0;
// Highest Cost
$sql = "SELECT (shipping_cost + handling_cost + insurance_cost) AS total_cost FROM shipping ORDER BY total_cost LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


// Vip customers number
$sql = "SELECT COUNT(*) AS VIP FROM shipping JOIN customer ON shipping.customer_id=customer.customer_id  WHERE customer.notes LIKE '%VIP customer%'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result2 = $stmt->fetch(PDO::FETCH_ASSOC);

// New Customers
$sql = "SELECT COUNT(*) AS Regular FROM shipping JOIN customer ON shipping.customer_id=customer.customer_id  WHERE customer.notes LIKE '%First-time customer%'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result3 = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        
        <div class="header-right">
          <!-- <span class="material-icons-outlined">notifications</span>
          <span class="material-icons-outlined">email</span> -->
          <span class="material-icons-outlined">account_circle</span>
        </div>
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
          <span class="material-icons-outlined">poll</span> Insights
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="customer.php">
              <span class="material-icons-outlined">groups_3</span> Customer
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="admin_page.php" >
              <span class="material-icons-outlined">inventory_2</span> Product
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="shipping.php" >
              <span class="material-icons-outlined">anchor</span> Shipping
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="../logout.php" >
              <span class="material-icons-outlined">logout</span> Log Out
            </a>
          </li>
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <h2>DASHBOARD</h2>
        </div>

        <div class="main-cards">

          <div class="card">
            <div class="card-inner">
              <h3>Average Delivery Days</h3>
              <span class="material-icons-outlined">inventory_2</span>
            </div>
            <?php echo '<h1>'.$average_delivery_days.'</h1>'?>
          </div>

        <div class="card">
            <div class="card-inner">
                <h3>Highest Shipping Cost</h3>
                
                <span class="material-icons-outlined">local_shipping</span>
               
            </div>
            <h1> <?php echo "<h1>" . $result['total_cost'] . "</h1>"?></h1>
            </div> 
            <div class="card">
            <div class="card-inner">
                <h3>VIP Customers</h3>
                
                <span class="material-icons-outlined">groups</span>
               
            </div>
            <h1> <?php echo "<h1>" . $result2['VIP'] . "</h1>"?></h1>
            </div>

            <div class="card">
            <div class="card-inner">
                <h3>New Customers</h3>
                
                <span class="material-icons-outlined">groups</span>
               
            </div>
            <h1> <?php echo "<h1>" . $result3['Regular'] . "</h1>"?></h1>
            </div>

        </div>

        <div class="charts">

          <div class="charts-card">
            <h2 class="chart-title">Top 5 Products</h2>
            <div id="bar-chart"></div>
          </div>

          <div class="charts-card">
            <h2 class="chart-title">Purchase and Sales Orders</h2>
            <div id="area-chart"></div>
          </div>

        </div>
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="script.js"></script>
  </body>
</html>