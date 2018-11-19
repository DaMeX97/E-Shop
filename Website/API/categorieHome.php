<?php

$id = $_GET["idCategoria"];

try {
	$conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
    $query = "SELECT * FROM Prodotti WHERE '".$id."'= idCategoria AND Visibile = true AND Quantita > 0 ORDER BY rand() LIMIT 10";
    
    $ris = $conn->query($query);  // si lancia la query, torna true o false
    $temp = $ris->fetchAll(PDO::FETCH_ASSOC); // si prende i risultati della query
    echo json_encode($temp); // stampa il json
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>