<?php
session_start();
include('pdo-connection.php');

// Preverimo, ali uporabnik že ni prijavljen
if (!isset($_SESSION['upo_ime'])) {
    if (isset($_POST['mail']) && isset($_POST['geslo'])) {
        // Pridobimo podatke iz obrazca
        $mail = $_POST['mail'];
        $geslo = $_POST['geslo'];

        try {
            // Pripravimo in izvedemo poizvedbo
            $stmt = $pdo->prepare("SELECT id_uporabnik, upo_ime, geslo FROM uporabnik WHERE mail = :mail");
            $stmt->bindParam(':mail', $mail);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Preverimo, ali smo našli uporabnika in ali se geslo ujema
            if ($user && $user['geslo'] === $geslo) {
                // Shranimo podatke v sejo
                $_SESSION['upo_ime'] = $user['upo_ime'];
                $_SESSION['sesionid'] = session_id();
                $_SESSION['userid'] = $user['id_uporabnik'];

                // Zapis v sessionStorage preko JavaScript-a
                echo "<script>
                    sessionStorage.setItem('userid', '{$user['id_uporabnik']}');
                    window.location.href = 'index.php';
                </script>";
            } else {
                echo "<script>alert('Prijava ni uspela. Preverite e-poštni naslov ali geslo.'); window.location.href = 'login-register.php';</script>";
            }
        } catch (PDOException $e) {
            echo "Napaka pri prijavi: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Prosimo, izpolnite vsa polja.'); window.location.href = 'login-register.php';</script>";
    }
} else {
    echo "<script>window.location.href = 'index.php';</script>";
}
?>