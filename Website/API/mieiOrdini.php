<?php

$id = $_GET["id"];
$idOrdine = $_GET["idOrdine"];

try {
  $conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
  
  $query = "SELECT * FROM Ordini ";
  if (isset($idOrdine)){
  	 $query = $query . " where idOrdine = " . $idOrdine;
  }
  
  if (isset($id)){
    $query = $query . " where idUtente = " . $id;
  }
  
  $query = $query . " ORDER BY Data DESC, idOrdine DESC";
  
  $ris = $conn->query($query); 
  $temp = $ris->fetchAll(PDO::FETCH_ASSOC);
  
  $array = array(); // per creare array
  
  foreach($temp as $row){
    $query2 = "SELECT * FROM Prodotti AS p JOIN Prodotti_Nel_Ordine AS pno ON p.idProdotto = pno.idProdotto WHERE pno.idOrdine = ".$row["idOrdine"];
    $ris2 = $conn->query($query2);
    $temp2 = $ris2->fetchAll(PDO::FETCH_ASSOC);
    
        
    $object = (object) [
      'prodotti' => $temp2,
      'id' => $row["idOrdine"],
      'data' => $row["Data"],
      'pagamento' => $row["Pagamento"],
      'Stato' => $row["Stato"],
    ];
    
    array_push($array, $object);  // per aggiungere un elemento ad un array
  }
  echo json_encode($array);
  
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}
?>