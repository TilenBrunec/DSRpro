<?php
    #session_start();
    include('pdo-connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/create-quote.css">
    <title>Quotify</title>
</head>
<body>
  <!-- 
============================================================
=                                                          =
=                         NAVIGATION                       =
=                                                          =
============================================================
-->
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
        <li>
          <a href="login-register.php">Login</a>
        </li>
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
=                        CREATE QUOTE                      =
=                                                          =
============================================================
-->




   
    <div class="create-section">
    <div class="container-create">
    <!-- Title section -->
    <div class="title-create">Create Your Quote</div>
    <div class="content-create">
      <!-- Registration form -->
      <form action="#">
        <div class="user-details-create">
          <!-- Input for Category -->
          <div class="input-box-create">
            <span class="details-create">Category</span>
            <input type="text" placeholder="Enter Category" required>
          </div>
          <!-- Input for qupti -->
          <div class="input-box-create">
            <span class="details-create">Quote</span>
            <input type="text" placeholder="Enter your quote" required>
          </div>
          <!-- Input for Date -->
          <div class="input-box-create">
            <span class="details-create">Date</span>
            <input type="date"  required>
          </div>
          <!-- Input for Phone Number -->
          <div class="input-box-create">
            <span class="details-create">Author</span>
            <input type="text" placeholder="Enter an Author" required>
          </div>
        
        </div>
        
        
        <!-- Submit button -->
        <div class="button">
          <input type="submit" value="Crate">
        </div>
      </form>
    </div>
  </div>
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
</body>
</html>

<?php
    $pdo =null;
?>