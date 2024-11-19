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





    <h1>Welcome to Quotify.</h1>
    <?php

//dostop do zapisov knjig
$stmt = $pdo->query("SELECT * FROM kategorija");
$stmt->setFetchMode(PDO::FETCH_ASSOC); // rezultat naj bo asociativno polje ()


if($stmt->rowCount() > 0) //izpisemo naslov samo v primeru, ko imamo rezultate
  print('<h2> Categories </h2>');
  
//izpis podatkov iz baze
 while ($row = $stmt->fetch()) 
 {
  ?>
  
  <div class="card mb-2 px-3 pt-2 pb-2">
  <table class="table table-borderless table-striped table-sm mb-0">
    <tr><th> </th>		<td><?php echo $row['vrsta']; ?></td></tr> 
  
  
  
    </table>
    </div>

  <?php
 }


?>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>

<?php
    $pdo =null;
?>