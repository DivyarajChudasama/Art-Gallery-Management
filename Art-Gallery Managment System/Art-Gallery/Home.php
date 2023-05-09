<?php
if(!isset($_SESSION)){session_start();}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="asset\museum.png" type="image/jpeg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Home.css">
    <title>Art Gallery</title>
</head>
<body>
   <div class="hero">
    <video autoplay loop muted plays-inline class="back-video">
        <source src="./asset/videos/Homepage.mp4"  type="video/mp4">
    </video>
    <nav>
        <img src="asset\Logo.png" class="logo">
        <ul>
            <li><a href="shop.php">Shopping</a></li>
            <li><a href="Painting.html">PAINTINGS</a></li>
            <li><a href="Egypt.html">EGYPTIAN</a></li>
            <li><a href="Sculpture.html">SCULPTURES</a></li>
            <li id="user-menu">
  <b><a style="color:white" > Hello, <?php echo $_SESSION["SessUsername"] ?></a></b>
      <div id="dropdown-menu">
        <a href="logout.php">Logout</a>
      </div>
    </li>

        </ul>

    </nav>
    <!-- <nav>
  <img src="logo.png" class="logo">
  <li id="user-menu">
  <b><a style="color:white" > Hello, <?php echo $_SESSION["SessUsername"] ?></a></b>
      <div id="dropdown-menu">
        <a href="logout.php">Logout</a>
      </div>
    </li>
  <ul>
    <li><a href="auction.html">SHOPPING</a></li>
    <li><a href="Painting.html">PAINTINGS</a></li>
    <li><a href="Egypt.html">EGYPTIAN</a></li>
    <li><a href="Sculpture.html">SCULPTURES</a></li>
  </ul>
</nav> -->
    <div class="content">
        <h1>Art Gallery</h1>
        <a href="Explore.html">Explore</a>   
    </div>
   </div>
<script>
  const userMenu = document.getElementById('user-menu');
  const dropdownMenu = document.getElementById('dropdown-menu');

  userMenu.addEventListener('mouseover', function() {
    dropdownMenu.style.display = 'block';
  });

  userMenu.addEventListener('mouseout', function() {
    dropdownMenu.style.display = 'none';
  });
</script>   
</body>

</html>