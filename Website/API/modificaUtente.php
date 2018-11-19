<?php

$idUtente = $_GET["id"];
$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$password = $_POST["password"];
$email = $_POST["email"];
$indirizzo = $_POST["indirizzo"];
$telefono = $_POST["telefono"];

$visibile = $_POST["abilitato"];

try {
  $conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
  $query = "UPDATE Utenti SET Nome= '".$nome."', Cognome= '".$cognome."', Password='".$password."', Email= '".$email."', Telefono = '" .$telefono . "', Indirizzo='" .$indirizzo . "'";

  if(isset($visibile)){
    $query = $query . ", Visibile=" . $visibile;
  }


  $query = $query . " WHERE idUtente = " . $idUtente;

  $ris = $conn->query($query);

  // REDIRECT TO HOME
  echo '<script type="text/javascript">
             window.location = "http://progettobasi2018.altervista.org/"
        </script>';

} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}
?>