<?php

$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$indirizzo = $_POST["indirizzo"];
$telefono = $_POST["telefono"];
$admin = 0;
$password = $_POST["password"];
$email = $_POST["email"];

try {
	$conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
    $query = "INSERT into Utenti (Nome, Cognome, Indirizzo, Telefono, Admin, Password, Email) VALUES ( '".$nome."','".$cognome."','".$indirizzo."','".$telefono."','".$admin."','".$password."','".$email."')";
    $ris = $conn->query($query);
    
    // REDIRECT TO HOME
    echo '<script type="text/javascript">
             window.location = "http://progettobasi2018.altervista.org/grazie.html"
        </script>';
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>