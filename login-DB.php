<?php
session_start();
include('pdo-connection.php');

// Check if the user is already logged in
if (!isset($_SESSION['upo_ime'])) {
    if (isset($_POST['mail']) && isset($_POST['geslo'])) {
        // Retrieve form data
        $mail = $_POST['mail'];
        $geslo = $_POST['geslo'];

        try {
            // Prepare and execute the query to retrieve the user
            $stmt = $pdo->prepare("SELECT id_uporabnik, upo_ime, geslo FROM uporabnik WHERE mail = :mail");
            $stmt->bindParam(':mail', $mail);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if user exists and if passwords match (comparing hashed passwords)
            if ($user && hash('sha256', $geslo) === $user['geslo']) {
                // Store user information in session
                $_SESSION['upo_ime'] = $user['upo_ime'];
                $_SESSION['sesionid'] = session_id();
                $_SESSION['userid'] = $user['id_uporabnik'];

                // Redirect user
                echo "<script>
                    sessionStorage.setItem('userid', '{$user['id_uporabnik']}');
                    window.location.href = 'index.php';
                </script>";
            } else {
                echo "<script>alert('Login failed. Please check email or password.'); window.location.href = 'login-register.php';</script>";
            }
        } catch (PDOException $e) {
            echo "Error during login: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Please fill in all fields.'); window.location.href = 'login-register.php';</script>";
    }
} else {
    echo "<script>window.location.href = 'index.php';</script>";
}
?>