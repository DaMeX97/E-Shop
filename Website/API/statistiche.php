<?php

try {
  $conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
  $query = "SELECT DISTINCT data FROM Ordini order by data ";
  $ris = $conn->query($query);
  $array = $ris->fetchAll(PDO::FETCH_ASSOC);
  $arrayFinal = array();

  foreach($array as $row) {
    $data = $row["data"];
    $query2 = "select * from Ordini Where data = '".$data."'";
    $ris2 = $conn->query($query2);
    $array2 = $ris2->fetchAll(PDO::FETCH_ASSOC);

    $totale = 0;

    foreach($array2 as $row2){
      $idOrdine = $row2["idOrdine"];
      $query3 = "SELECT sum(Prezzo * Quantita_Nel_ordine) as somma FROM Prodotti_Nel_Ordine where idOrdine = " .$idOrdine;
      $ris3 = $conn->query($query3);
      $array3 = $ris3->fetchall(PDO::FETCH_ASSOC);

      $totale = $totale + $array3[0]['somma'];
    }

    $object = (object) [
      'data' => $data,
      'totale' => $totale,
      'count' => count($array2),
    ];

    array_push($arrayFinal, $object);
  }
  echo json_encode($arrayFinal);

} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}
?>