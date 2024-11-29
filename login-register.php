<?php
    session_start();
    include('pdo-connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/login-register.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Quotify</title>
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
=                         sing up                             =
=                                                          =
============================================================
-->
<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

//preverimo, ce je uporabnik vnesel vse podatke v formo
if (isset($_POST['upo_ime']) && isset($_POST['mail']) 
  && isset($_POST['geslo']) && isset($_POST['TK_drzava']))
{
  
  //pridobivanje podatkov iz obrazca in shranjevanje v spremelnjivke
  $upo_ime = $_POST['upo_ime'];
  $vloga = 0;
  $mail = $_POST['mail'];
  $geslo = $_POST['geslo'];
  $slika =isset($_POST['slika'])  ? $_POST['slika'] : null;
  $TK_drzava = $_POST['TK_drzava'];
    
  // pripravimo SQL izraz - imenovani vsebniki namesto ? in implicitnega vnosa
  //prepare je začetek prepared statementa. 
  $stmt = $pdo->prepare("INSERT INTO uporabnik(upo_ime, vloga, mail, geslo, slika,TK_drzava) 
  VALUES (:upo_ime, :vloga, :mail, :geslo, :slika, :TK_drzava)");
  
  // vežemo parametre
  $stmt->bindParam(':upo_ime', $upo_ime);
  $stmt->bindParam(':vloga', $vloga);
  $stmt->bindParam(':mail', $mail);
  $stmt->bindParam(':geslo', $geslo);
  $stmt->bindParam(':slika', $slika);
  $stmt->bindParam(':TK_drzava', $TK_drzava);

  
  $stmt->execute();
}

?>

<div class="login-register">
<div class="container" id="container">
        <div class="form-container sign-up">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
    <h1>Create Account</h1>
    <div class="social-icons">
        <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
        <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
        <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
    </div>
    <span>Become our newest member</span>
    <input type="text" name="upo_ime" id="upo_ime" placeholder="Name" required/>
    <input type="email" name="mail" id="mail" placeholder="Email" required/>
    <input type="password" name="geslo" id="geslo" placeholder="Password" required/>

    <!-- Dropdown for countries  
     <input type="dropdown" placeholder="Country" name="TK_drzava" required/>
    -->
    <label for="country"></label>
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


    <!-- 
============================================================
=                                                          =
=                         lop in                           =
=                                                          =
============================================================
-->
<?php

if(@$_GET['odjava'] == 1)
	{
	unset($_SESSION);
	session_destroy();

	}

?>
<?php

if(!@$_SESSION['sesionid']) {
?>
</form action="login-DB.php" method="POST">
        </div>
        <div class="form-container sign-in">
            <form>
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Log in with your account</span>
                <input type="email" name="mail" placeholder="Email" required>
                <input type="password" name="geslo" placeholder="Password" required>
                <a href="#">Forget Your Password?</a>
                <button>Sign In</button>
            </form>

            <?php
}
?>

<?php
 ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if(@$_SESSION['sid']) {
?>
	Ste prijavljeni <?php echo $_SESSION['mail']  ?>! <br /><br />
	<!--<br/>vaše uporabniško ime: <b>< ?php// echo $_SESSION['ime'] ?></b><br/>-->
	<br/>vaš sid: <b><?php echo $_SESSION['sesionid'] ?></b><br/>
	<a href="login.php?odjava=1" class="btn btn-warning"> Odjavi </a>
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
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
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
    
</body>
</html>

<?php
    $pdo =null;
?>