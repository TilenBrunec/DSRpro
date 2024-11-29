<?php
    session_start();
    include('pdo-connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/quoti.css">
    
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





   


    <?php
//dostop do zapisov knjig
$stmt = $pdo->query("SELECT * FROM quote , uporabnik, avtor  
WHERE quote.TK_uporabnik = uporabnik.id_uporabnik 
    AND quote.TK_avtor = avtor.id_avtor 
    ");
$stmt->setFetchMode(PDO::FETCH_ASSOC); // rezultat naj bo asociativno polje ()

//kategorija, qoute_kategorija
// AND qoute_kategorija.TK_quote = quote.id_quote 
//AND qoute_kategorija.TK_kategorija = kategorija.id_kategorija

//izpis podatkov iz baze
 while ($row = $stmt->fetch()) 
 {
  ?>
  <div class="quote-container">
        <div class = "delete-quote"> <img src="picture/trash-can.png" alt=""> </div>
        <div class="quote-text">
            <?php echo $row['besedilo']; ?>
        </div>
        <div class="quote-author">
            Author: <span><?php echo $row['imeInPriimek']; ?></span>
        </div>
        <div class="quote-user">
            Added by: <?php echo $row['upo_ime']; ?>
        </div>
        
        <div class="quote-date">
            <?php echo $row['datum_quote']; ?>
        </div>
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
</body>
</html>

<?php
    $pdo =null;
?>