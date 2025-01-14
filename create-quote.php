<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    session_start();
    include('pdo-connection.php');
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
    <link rel="stylesheet" href="css/create-quote.css">
    <link rel="stylesheet" href="css/logout.css">
    <title>Quotify</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
    <script src="https://unpkg.com/scrollreveal"></script>
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
  <!-- 
============================================================
=                                                          =
=                        CREATE QUOTE                      =
=                         Naredi potem in vrrasaj          =
============================================================
-->



<?php

if ( isset($_POST['besedilo']) && isset($_POST['datum_quote']) && isset($_POST['avtorQuota']) && isset($_POST['kategorija']))  {

  // Retrieve data from the form
  $besedilo = $_POST['besedilo'];
  $datum_quote = $_POST['datum_quote'];
  $avtorQuota = $_POST['avtorQuota'];
  $kategorija = $_POST['kategorija']; // Array of selected category IDs

  // dobim id uporabnika
  $TK_uporabnik = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;

  if ($TK_uporabnik === null) {
    echo "User not logged in. Please log in first.";
    exit;
}

try {
    // Insert the quote into the `quote` table
    $stmt = $pdo->prepare("INSERT INTO quote (besedilo, datum_quote, TK_uporabnik, avtorQuota) VALUES (:besedilo, :datum_quote, :TK_uporabnik, :avtorQuota)");
    $stmt->bindParam(':besedilo', $besedilo);
    $stmt->bindParam(':datum_quote', $datum_quote);
    $stmt->bindParam(':TK_uporabnik', $TK_uporabnik);
    $stmt->bindParam(':avtorQuota', $avtorQuota);
    $stmt->execute();

    //vzame zadni insertan id
    $lastQuoteId = $pdo->lastInsertId();

    // za kategorija_quote
    foreach ($kategorija as $categoryId) {
      $stmtCategory = $pdo->prepare("INSERT INTO  `quote_kategorija` (TK_quote, TK_kategorija) VALUES (:TK_quote, :TK_kategorija)");
        $stmtCategory->bindParam(':TK_quote', $lastQuoteId);
        $stmtCategory->bindParam(':TK_kategorija', $categoryId);
        $stmtCategory->execute();
    }

    echo "<script>alert('Quote successfully added with categories.');</script>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
} else {
 
}
		?>



   
    <div class="create-section">
    <div class="container-create">
    <!-- Title section -->
    <div class="title-create">Create Your Quote</div>
    <div class="content-create">
      <!-- Registration form -->
      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

        <div class="user-details-create">
          <!-- Input for Category -->
          <div class="checkbox-create">
            <span class="checkbox-create-detail" style="font-size: 16px; font-weight: 600;">Category</span>
              <br>
                <?php
                    $stmt = $pdo->query("SELECT * FROM kategorija");
                    $stmt->setFetchMode(PDO::FETCH_ASSOC); // rezultat naj bo asociativno polje ()

                    while ($row = $stmt->fetch()) {
                       ?>
                       <hr>
                     <?php echo '<div><input type="checkbox" name="kategorija[]" value="' . $row['id_kategorija'] . '"> ' . htmlspecialchars($row['vrsta']) . '</div>' ?>
                     <hr>
                     <?php
                  }
                ?>
          </div>
          <!-- Input for qupti -->
          <div class="input-box-create">
            <span class="details-create">Quote</span>
            <input type="text" placeholder="Enter your quote" name="besedilo" required>
          </div>
          <!-- Input for Date -->
          <div class="input-box-create">
            <span class="details-create">Date</span>
            <input type="date" name="datum_quote"  required>
          </div>
          <!-- Input for autor-->
          <div class="input-box-create">
            <span class="details-create">Author</span>
            <input type="text" placeholder="Enter an Author" name="avtorQuota" required>
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
    <script src="js/scrolReveal.js"></script>
</body>
</html>

<?php
    $pdo =null;
?>