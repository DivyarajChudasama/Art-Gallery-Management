<?php
// Define database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_gallery";

// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$sql = "SELECT ex_name, SUM(Price) AS total_price FROM Exhibition JOIN Artwork ON Exhibition.Artwork_ID = Artwork.Artwork_ID GROUP BY Exhibition.Exhibition_ID";

// Execute query
$stmt = $conn->prepare($sql);
$stmt->execute();

// Fetch results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for chart
$labels = [];
$values = [];
foreach($results as $result) {
    $labels[] = $result['ex_name'];
    $values[] = $result['total_price'];
}

// Create bar chart using Plotly
$chart_data = [
    [
        'x' => $labels,
        'y' => $values,
        'type' => 'bar'
    ]
];
$chart_layout = [
    'title' => 'Exhibition Sales',
    'xaxis' => ['title' => 'Exhibition Name'],
    'yaxis' => ['title' => 'Total Sales']
];
$chart_config = ['responsive' => true];
$chart = json_encode(['data' => $chart_data, 'layout' => $chart_layout, 'config' => $chart_config]);

//Total Artworks
$sql = "SELECT SUM(Num_Artworks) as total FROM exhibition";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total_num_artworks = $result['total'];

// Total Exhibitons
$count_stmt = $conn->prepare("SELECT COUNT(ex_name) as count FROM exhibition");
$count_stmt->execute();
$count_result = $count_stmt->fetch(PDO::FETCH_ASSOC);

// Get the count value
$count_exhibitions = $count_result['count'];


// Best Painting and its price

$stmt = $conn->prepare("SELECT * FROM exhibition JOIN artwork ON exhibition.Artwork_ID = artwork.Artwork_ID ORDER BY Price DESC LIMIT 1");
$stmt->execute();

// Fetch results
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Upcoming Exhibitions
$sql = "SELECT COUNT(*) FROM exhibition WHERE start_date > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $count1 = $stmt->fetchColumn();

$conn = null;
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
          <span class="material-icons-outlined">notifications</span>
          <span class="material-icons-outlined">email</span>
          <span class="material-icons-outlined">account_circle</span>
        </div>
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">shopping_cart</span> STORE
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">dashboard</span> Dashboard
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">inventory_2</span> Products
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">category</span> Categories
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">groups</span> Customers
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">fact_check</span> Inventory
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">poll</span> Reports
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">settings</span> Settings
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
             <h3>PRODUCTS</h3>
            <span class="material-icons-outlined">inventory_2</span>
        </div>
        <h1><?php echo $total_num_artworks; ?></h1>
    </div>

    <div class="card">
        <div class="card-inner">
             <h3>Total Exhibitions</h3>
            <span class="material-icons-outlined">inventory_2</span>
        </div>
        <h1><?php echo $count_exhibitions; ?></h1>
    </div>

        
    <div class="card">
        <div class="card-inner">
            <h3>Top Painting</h3>
             <span class="material-icons-outlined">brush</span>
        </div>
        <h1><?php echo $result['Title']; ?></h1>
        <p><?php echo '$'.$result['Price']; ?></p>
</div>
          <div class="card">
            <div class="card-inner">
              <h3>Upcoming Exhibitions</h3>
              <span class="material-icons-outlined">notification_important</span>
            </div>
            <h1><?php echo $count1 ?></h1>
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