<?php

$idProdotto = $_GET["idProdotto"];
$idUtente = $_GET["idUtente"];
$quantita = $_GET["quantita"];

try {
  $conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE

  $query2  = "SELECT * FROM Prodotti_Nel_Carrello WHERE Prodotti_idProdotto = ".$idProdotto." AND Utenti_idUtente = ".$idUtente;
  $ris2 = $conn->query($query2);
  $temp = $ris2->fetchAll(PDO::FETCH_ASSOC);

  if (count($temp) == 1) {
    $query = "UPDATE Prodotti_Nel_Carrello SET Quantita_Nel_Carrello = ".$quantita." WHERE Prodotti_idProdotto = ".$idProdotto." AND Utenti_idUtente = ".$idUtente;
    $ris = $conn->query($query);
  }
  else{
    $query = "INSERT into Prodotti_Nel_Carrello(Prodotti_idProdotto, Utenti_idUtente, Quantita_Nel_Carrello) VALUES ('".$idProdotto."','".$idUtente."',".$quantita.")";
    $ris = $conn->query($query);
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}
?>