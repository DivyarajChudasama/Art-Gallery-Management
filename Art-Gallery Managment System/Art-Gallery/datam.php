<?php
// include the PDO database connection file
include 'connect.php';
$pdo->query("USE my_gallery1");

// get total number of artists
$total_artists_query = $pdo->query("SELECT COUNT(*) FROM Artist");
$total_artists = $total_artists_query->fetchColumn();

// get total number of ongoing exhibitions
$current_exhibitions_query = $pdo->query("SELECT COUNT(*) FROM Exhibition WHERE Start_Date <= NOW() AND End_Date >= NOW()");
$current_exhibitions = $current_exhibitions_query->fetchColumn();

// get total number of upcoming exhibitions
$upcoming_exhibitions_query = $pdo->query("SELECT COUNT(*) FROM Exhibition WHERE Start_Date > NOW()");
$upcoming_exhibitions = $upcoming_exhibitions_query->fetchColumn();

$upcoming_exhibitions_query = $pdo->query("SELECT COUNT(*) FROM Exhibition WHERE Start_Date > NOW()");
$upcoming_exhibitions = $upcoming_exhibitions_query->fetchColumn();

$query1="SELECT Title FROM artwork WHERE Availability = 1 ORDER BY price DESC LIMIT 1";
$stmt = $pdo->prepare($query1);
    $stmt->execute();
// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// get total number of artists
$total_auction_query = $pdo->query("SELECT COUNT(*) FROM Auction");
$total_auction = $total_auction_query->fetchColumn();

// get total number of ongoing exhibitions
$current_auction_query = $pdo->query("SELECT COUNT(*) FROM Auction WHERE au_date <= NOW() ");
$current_auction = $current_auction_query->fetchColumn();

// get total number of upcoming exhibitions
$upcoming_auction_query = $pdo->query("SELECT COUNT(*) FROM Auction WHERE au_Date > NOW()");
$upcoming_auction = $upcoming_auction_query->fetchColumn();



echo "<div class='sidebar'>";
echo "<ul>";
echo "<li><a href='datac.php'>Customer</a></li>";
echo "<li><a href='datas.php'>Shipping</a></li>";
// echo "<li><a href='dataso.html'>Shop</a></li>";

// echo "<li><a href='#'>Sales</a></li>";
// echo "<li><a href='#'>Settings</a></li>"; 
echo "<ul>";
echo "</div>";
// display the results in rounded card view
echo "<div class='card-deck'>";

// Total number of artists
echo "<div class='card bg-info text-white rounded-circle'>";
echo "<div class='card-body'>";
echo "<h5 class='card-title'>Total Artists</h5>";
echo "<p class='card-text'>" . $total_artists . "</p>";
echo "</div>";
echo "</div>";
echo "<hr>";



// Total number of ongoing exhibitions
echo "<div class='card bg-success text-white rounded-circle'>";
echo "<div class='card-body'>";
echo "<h5 class='card-title'>Ongoing Exhibitions</h5>";
echo "<p class='card-text'>" . $current_exhibitions . "</p>";
echo "</div>";
echo "</div>";
echo "<hr>";
// Total number of upcoming exhibitions
echo "<div class='card bg-warning text-white rounded-circle'>";
echo "<div class='card-body'>";
echo "<h5 class='card-title'>Upcoming Exhibitions</h5>";
echo "<p class='card-text'>" . $upcoming_exhibitions . "</p>";
echo "</div>";
echo "</div>";
// echo "The most expensive artwork available is: " . $artwork['title'] . ", priced at $" . $artwork['price'];
echo "<hr>";
// Total number of artists
echo "<div class='card bg-info text-white rounded-circle'>";
echo "<div class='card-body'>";
echo "<h5 class='card-title'>Total Auctions</h5>";
echo "<p class='card-text'>" . $total_auction . "</p>";
echo "</div>";
echo "</div>";

echo "<hr>";



// Total number of ongoing exhibitions
echo "<div class='card bg-success text-white rounded-circle'>";
echo "<div class='card-body'>";
echo "<h5 class='card-title'>Ongoing Auctions</h5>";
echo "<p class='card-text'>" . $current_auction . "</p>";
echo "</div>";
echo "</div>";
echo "<hr>";
// Total number of upcoming exhibitions
echo "<div class='card bg-warning text-white rounded-circle'>";
echo "<div class='card-body'>";
echo "<h5 class='card-title'>Upcoming Auctions</h5>";
echo "<p class='card-text'>" . $upcoming_auction . "</p>";
echo "</div>";
echo "</div>";
echo "<hr>";

echo "</div>"; // close card-deck div

// add more rounded cards or modify existing ones as needed
// for example, you could add a card for the total number of artworks, or the number of featured artists in ongoing exhibitions.
?>
<style>
.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  width: 200px;
  height: 100%;
  background-color: #f2f2f2;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidebar ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.sidebar li {
  margin-bottom: 10px;
}

.sidebar a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

.sidebar a:hover {
  background-color: #ddd;
}

.card-deck {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 20px;
  margin-top: 20px;
  padding-left: 20px;
}

.card {
  width: 200px;
  height: 200px;
  display: flex;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  font-size: 18px;
  font-weight: bold;
  padding-left: 10px;
  margin: 0px 40px;
}

.bg-info {
  background-color: #17a2b8;
}

.bg-success {
  background-color: #28a745;
}

.bg-warning {
  background-color: #ffc107;
}

.text-white {
  color: #fff;
}

.card-title {
  margin-bottom: 0;
}

.card-text {
  margin-top: 5px;
}
#p
{
    text-align: center;
}
</style>

