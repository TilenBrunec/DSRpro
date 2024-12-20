<?php
    session_start();
    include('pdo-connection.php');
    if (isset($_GET['odjava']) && $_GET['odjava'] == 1) {
      session_destroy();
       session_unset();
      header("Location: login-register.php"); // Preusmeritev na stran za prijavo
      exit;
  }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/login-register.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/logout.css">
    <title>Quotify</title>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
    <script src="https://unpkg.com/scrollreveal"></script>
</head>
<style>
select {
  background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
}
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
        <a href="?odjava=1">Logout</a>
      </li>
    <?php } else { ?>
      <li>
        <a href="login-register.php">Login</a>
      </li>
    <?php } ?>
      </ul>
    </div>


<!-- 
============================================================
=                                                          =
=                         sing up                             =
=                                                          =
============================================================
-->
<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // Check upo_ime with regular expression
    if (preg_match('/^[A-Za-z0-9_\'.\-]{4,20}$/', $_POST['upo_ime'])) {
        $upo_ime = htmlspecialchars(trim($_POST['upo_ime']));
    } else {
        $errors[] = 'Please enter a valid username (4-20 characters, only letters, digits, underscores, hyphens, apostrophes, and dots allowed).';
    }

    // Check mail with regular expression
    if (preg_match('/^[^@\s]+@[^@\s]+\.[^@\s]+$/', $_POST['mail'])) {
        $mail = htmlspecialchars(trim($_POST['mail']));
    } else {
        $errors[] = 'Please enter a valid email address.';
    }

    // Check and hash password (no regex needed here in this case)
    if (!empty($_POST['geslo'])) {
        $geslo = $_POST['geslo'];
        $hashed_geslo = hash('sha256', $geslo);
    } else {
        $errors[] = 'Please enter a password.';
    }

    // Validate TK_drzava
    if (isset($_POST['TK_drzava']) && !empty($_POST['TK_drzava'])) {
        $TK_drzava = intval($_POST['TK_drzava']);
    } else {
        $errors[] = 'Please select a valid country.';
    }

    // If no errors, insert into the database
    if (empty($errors)) {
        $slika = isset($_POST['slika']) ? $_POST['slika'] : null;
        $vloga = 0;

        // Prepare SQL query
        $stmt = $pdo->prepare("INSERT INTO uporabnik (upo_ime, vloga, mail, geslo, slika, TK_drzava)
                               VALUES (:upo_ime, :vloga, :mail, :geslo, :slika, :TK_drzava)");

        // Bind parameters
        $stmt->bindParam(':upo_ime', $upo_ime);
        $stmt->bindParam(':vloga', $vloga);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':geslo', $hashed_geslo);
        $stmt->bindParam(':slika', $slika);
        $stmt->bindParam(':TK_drzava', $TK_drzava);

        if ($stmt->execute()) {
           
        } else {
            echo '<div class="alert alert-danger" role="alert">An error occurred. Please try again.</div>';
        }
    } else {
        foreach ($errors as $error) {
            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
        }
    }
}
?>

<div class="login-register">
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                <h1>Create Account</h1>
                <input type="text" name="upo_ime" id="upo_ime" placeholder="Name" required/>
                <input type="email" name="mail" id="mail" placeholder="Email" required/>
                <input type="password" name="geslo" id="geslo" placeholder="Password" required/>
                <select name="TK_drzava" id="country" required>
                    <option value="" disabled selected>Select Country</option>
                    <?php
                    $vseDrzave = $pdo->query("SELECT * FROM drzava");
                    $vseDrzave->setFetchMode(PDO::FETCH_ASSOC);
                    while ($row = $vseDrzave->fetch()) {
                        echo '<option value="' . $row['id_drzava'] . '">' . $row['naziv'] . '</option>';
                    }
                    ?>
                </select>
                <input type="file" name="slika" placeholder="Picture">
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
    <!-- 
============================================================
=                                                          =
=                         lop in                           =
=                                                          =
============================================================
-->

<?php

if(!@$_SESSION['sesionid']) {
?>
            <form action="login-DB.php" method="POST">
                <h1 class="title">Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Log in with your account</span>
                <input class="input" type="email" name="mail" placeholder="Email" required>
                <input class="input" type="password" name="geslo" placeholder="Password" required>
                <a href="#">Forget Your Password?</a>
                <button class="input">Sign In</button>
            </form>

            <?php
}
?>





        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1 class="h1scroll">Hello, Friend!</h1>
                    <p class="pscroll">Register with your personal details to use all of site features</p>
                    <button class="buttonscroll" class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- 
============================================================
=                                                          =
=                         FOOTER                           =
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

    <script src="js/login-register.js"></script>
    <script src="js/script.js"></script>
    <script src="js/scrolReveal.js"></script>
    
</body>
</html>

<?php
    $pdo =null;
?>