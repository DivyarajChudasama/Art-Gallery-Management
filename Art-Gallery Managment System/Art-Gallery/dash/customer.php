<?php
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

 

// Vip customers number
$sql = "SELECT COUNT(*) AS VIP FROM shipping JOIN customer ON shipping.customer_id=customer.customer_id  WHERE customer.notes LIKE '%Regular customer%'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result2 = $stmt->fetch(PDO::FETCH_ASSOC);

// Count of customers
$sql1 = "SELECT COUNT(*) as counted from customer;";
$stmt = $conn->prepare($sql1);
$stmt->execute();
$result3= $stmt->fetch(PDO::FETCH_ASSOC);

 
 
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
    <link rel="stylesheet" href="stylec.css">
  </head>
  <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
          <span class="material-icons-outlined">search</span>
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
              <h3>PRODUCTS</h3>
              <span class="material-icons-outlined">inventory_2</span>
            </div>
            <h1>249</h1>
          </div>

          <div class="card">
            <div class="card-inner">
              <h3>CATEGORIES</h3>
              <span class="material-icons-outlined">category</span>
            </div>
            <h1>5</h1>
          </div>

          <div class="card">
            <div class="card-inner">
                <h3>Total Customers</h3>
                
                <span class="material-icons-outlined">groups</span>
               
            </div>
            <h1> <?php echo "<h1>" . $result3['counted'] . "</h1>"?></h1>
            </div>

          <div class="card">
            <div class="card-inner">
          
                <h3>Regular Customers</h3>
                
                <span class="material-icons-outlined">groups</span>
               
            </div>
            <h1> <?php echo "<h1>" . $result2['VIP'] . "</h1>"?></h1>
            </div>
             
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