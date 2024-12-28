<?php
    session_start();
    include('pdo-connection.php');

    if (isset($_GET['delete_id'])) {
      $quoteId = $_GET['delete_id'];
  
      
      $stmt = $pdo->prepare("DELETE FROM quote_kategorija WHERE TK_quote = ?");
      $stmt->execute([$quoteId]);
  
      $stmt = $pdo->prepare("DELETE FROM komentar WHERE TK_quote = ?");
      $stmt->execute([$quoteId]);
    
      $stmt = $pdo->prepare("DELETE FROM quote WHERE id_quote = ?");
      $stmt->execute([$quoteId]);
  
      header("Location: list-quots.php"); 
      exit;
  }
  $userRole = isset($_SESSION['vloga']) ? $_SESSION['vloga'] : null;

    if (isset($_GET['odjava']) && $_GET['odjava'] == 1) {
      session_unset();
      session_destroy();
      header("Location: login-register.php"); // Preusmeritev na stran za prijavo
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
    <link rel="stylesheet" href="css/quots.css">
    
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
    </div>





    <div class="naslov-quote">Quotes</div>


    <?php
//dostop do zapisov knjig
$stmt = $pdo->query("SELECT quote.*, kategorija.* ,uporabnik.*FROM quote INNER JOIN quote_kategorija ON
 quote_kategorija.TK_quote = quote.id_quote INNER JOIN kategorija ON quote_kategorija.TK_kategorija = kategorija.id_kategorija
   INNER JOIN uporabnik on uporabnik.id_uporabnik = quote.TK_uporabnik
   ORDER BY 
    quote.id_quote DESC;
    ");
$stmt->setFetchMode(PDO::FETCH_ASSOC); // rezultat naj bo asociativno polje ()


//izpis podatkov iz baze
 while ($row = $stmt->fetch()) 
 {
  ?>
     <div class="quote-container">
     <?php // if ($userRole == 1): ?>
        <a href="?delete_id=<?php echo $row['id_quote']; ?>" class="delete-quote">
            <img src="picture/bin.png" alt="Delete">
        </a>
    <?php //endif; ?>
        <div class="quote-category">
            <span><?php echo $row['vrsta']; ?></span>
        </div>
        <div class="quote-text">
            <?php echo $row['besedilo']; ?>
        </div>
        
        <div class="quote-author">
            Author: <span><?php echo $row['avtorQuota']; ?></span>
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
    <script src="js/scrolReveal.js"></script>
</body>
</html>

<?php
    $pdo =null;
?>