<?php

$page = $_GET["page"] - 1;
$n = $_GET["n"];
$q = "";
if(isset($_GET["q"]))
  $q=$_GET["q"];

$pda = -1;
if(isset($_GET["pda"]))
  $pda=$_GET["pda"];

$pa = -1;
if(isset($_GET["pa"]))
  $pa=$_GET["pa"];

$cat = -1;
if(isset($_GET["cat"]))
  $cat=$_GET["cat"];


try {
  $conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
  $query = "SELECT * FROM Prodotti WHERE Visibile = TRUE AND Quantita > 0";
  if($q != "")
    $query = $query." AND CONCAT(Marca, ' ', Modello, ' ', Descrizione, ' ') like '%".$q."%'";
  if($pda != -1)
    $query = $query." AND Prezzo >= ".$pda;
  if($pa != -1)
    $query = $query." AND Prezzo <= ".$pa;
  if($cat != -1)
    $query = $query." AND idCategoria = ".$cat;
  $query = $query." LIMIT " . $n . " OFFSET " . ($n * $page) ;

  $ris = $conn->query($query);
  $temp = $ris->fetchAll(PDO::FETCH_ASSOC);

  $query2 = "SELECT COUNT(*) as num FROM Prodotti WHERE Visibile = TRUE AND Quantita > 0";
  if($q != "")
    $query2 = $query2." AND CONCAT(Marca, ' ', Modello, ' ', Descrizione, ' ') like '%".$q."%'";
  if($pda != -1)
    $query2 = $query2." AND Prezzo >= ".$pda;
  if($pa != -1)
    $query2 = $query2." AND Prezzo <= ".$pa;
  if($cat != -1)
    $query2 = $query2." AND idCategoria = ".$cat;

  $ris2 = $conn->query($query2);
  $temp2 = $ris2->fetchAll(PDO::FETCH_ASSOC);

  $object = (object) [
    'array' => $temp,
    'num' => $temp2[0]['num'],
  ];


  echo json_encode($object);

} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}
?>