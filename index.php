<?php
    session_start();
    include('pdo-connection.php');
    if (isset($_GET['odjava']) && $_GET['odjava'] == 1) {
      session_unset();
      session_destroy();
      header("Location: login-register.php"); 
      exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/logout.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Quotify</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
    <script src="https://unpkg.com/scrollreveal"></script>
</head>
<style>
  
</style>
<body>
  
<nav>
      <div class="logo">
        <img src="picture/Logo64x64.png" alt="logo" />
        <h1>Quotify</h1>
      </div>
      <ul>
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <a href="list-kategorij.php">Categories</a>
        </li>
        <li>
          <a href="list-quots.php">Quotes</a>
        </li>
        
        <li>
          <a href="create-quote.php">Create one</a>
        </li>
        <?php if (isset($_SESSION['sesionid'])) { ?>
      <li class="odjava">
        <a href="?odjava=1">Log out</a>
      </li>
    <?php } else { ?>
      <li class="odjava">
        <a href="login-register.php">Log in</a>
      </li>
    <?php } ?>
      </ul>
      <div class="hamburger">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
      </div>
    </nav>
    <div class="menubar">
      <ul>
      <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <a href="list-kategorij.php">Categories</a>
        </li>
        <li>
          <a href="list-quots.php">Quotes</a>
        </li>
        
        <li>
          <a href="create-quote.php">Create one</a>
        </li>
        <li>
          <a href="login-register.php">Login</a>
        </li>
      </ul>
    </div>
<!-- 
============================================================
=                                                          =
=                         NAV                          =
=                                                          =
============================================================
-->



<div class="main">
<div class="text"> 
  <h2 class="welcomeH2">Welcome to Quotify</h2>
  <p class="welcomeP">Your one-stop destination for inspiring, thought-provoking, and memorable quotes.
     Whether you're here to discover wisdom, share your own words, or explore categories of curated thoughts,
      Quotify is the perfect space for all quote enthusiasts.</p>
</div>
<div class="image"> <img src="picture/release.png" alt=""></div>
</div>
    
<!-- 
============================================================
=                                                          =
=                         FOOTER                            =
=                                                          =
============================================================
-->
    <footer>
        <div class="container-footer-all">
            <div class="footer-content">
                <h3>Contact Us</h3>
                <p>Email:Info@example.com</p>
                <p>Phone:+121 56556 565556</p>
                <p>Address:Your Address 123 street</p>
            </div>
            <div class="footer-content">
                <h3>Quick Links</h3>
                 <ul class="list-footer">
                    <li><a href="">Home</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Services</a></li>
                    <li><a href="">Products</a></li>
                    <li><a href="">Contact</a></li>
                 </ul>
            </div>
            <div class="footer-content">
                <h3>Follow Us</h3>
                <ul class="social-icons">
                  
                </ul>
                </div>
        </div>
        <div class="bottom-bar">
            <p>&copy; 2023 your company . All rights reserved</p>
        </div>
    </footer>
    <script src="js/script.js"></script>
    <script src="js/scrolReveal.js"></script>
    

</body>
</html>

<?php
    $pdo =null;
?>