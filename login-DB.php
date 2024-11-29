<?php
session_start();
include('pdo-connection.php');

// ce nismo prijavljeni
if (!isset($_SESSION['upo_ime'])) {
	if (isset($_POST['mail']) && isset($_POST['geslo'])) { // v prijavnem obrazcu smo vpisali najmanj uporabnisko ime
		

		$stmt = $db->prepare("SELECT upo_ime FROM uporabnik WHERE mail = ? and geslo = ?"); // ali uporabnisko ime in geslo obstaja v bazi
		$stmt->bind_param('sesostorage', $_POST['mail'], $_POST['geslo']); 
		$stmt->execute();
		$stmt->store_result();

		// ce obstaja uporabnik
		if ($stmt->num_rows == 1)
		{
			// pridobimo ime
			$stmt->bind_result($ime);
			$stmt->fetch();
			// ime shranimo v sejo
			$_SESSION['upo_ime'] = $ime;
			$_SESSION['sesionid'] = session_id();
			// preusmeritev
			//echo("prijava je uspela");
			header("Location: index.php");
		}
		else {
			// ce prijava ni uspela nas preusmeri nazaj na prijavo
			//header("Location: login-register.php");
			echo("prijava ni uspela");
		}
	}
	// v primeru, da nismo vpisali uporabniskega imena, nam prikaze obrazec za prijavo
	else {
	//header("Location: login-register.php");
	echo("prijava ni uspela");
	}
}
else {
	//header("Location: login-register.php");
	echo("prijava ni uspela");
	}

?>