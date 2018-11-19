<?php

$idUtente = $_GET["Utente_idUtente"];
$idProdotto = $_GET["Prodotto_idProdotto"];

try {
  $conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
  $query = "DELETE FROM Prodotti_Nel_Carrello WHERE Utenti_idUtente = '".$idUtente."' AND '".$idProdotto."'= Prodotti_idProdotto";

  $ris = $conn->query($query);  // si lancia la query, torna true o false

  echo '<script type="text/javascript">
             window.location = "http://progettobasi2018.altervista.org/carrello.html"
        </script>';

} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}
?>