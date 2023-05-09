<style>
  .product-card {
  width: 300px;
  height: 400px;
  border: 1px solid #ccc;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  padding: 20px;
  text-align: center;
}

.product-card img {
  max-width: 100%;
  height: 200px;
  margin-bottom: 10px;
}

.product-card h3 {
  font-size: 24px;
  margin-bottom: 10px;
}

.product-card p {
  font-size: 16px;
  margin-bottom: 10px;
}

.product-price {
  display: block;
  font-size: 22px;
  margin-bottom: 10px;
}

.add-to-cart-btn {
  background-color: #4CAF50;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 5px;
  font-size: 18px;
  cursor: pointer;
}

.add-to-cart-btn:hover {
  background-color: #3e8e41;
}
</style>
<div class="product-container">

  <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "my_gallery";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $select = mysqli_query($conn, "SELECT * FROM artworky");

    if (!$select) {
      die("Query failed: " . mysqli_error($conn));
    }
    while($row = mysqli_fetch_assoc($select)){
  ?>

  <div class="product-card">
    <img src="<?php echo $row['image']; ?>" alt="Product Image">
    <h3><?php echo $row['name']; ?></h3>
    <p><?php echo $row['description']; ?></p>
    <span class="product-price">$<?php echo $row['price']; ?></span>
    <button class="add-to-cart-btn">Add to Cart</button>
  </div>

  <?php } ?>

</div>
