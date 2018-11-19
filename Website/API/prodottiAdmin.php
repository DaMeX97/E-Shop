<?php

$page = $_GET["page"] - 1;
$n = $_GET["n"];
$inv = $_GET["inv"] ? 0 : 1;

try {
	$conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
    $query = "SELECT * FROM Prodotti WHERE Visibile >= " .$inv. " LIMIT " . $n . " OFFSET " . ($n * $page) ;
    
    $ris = $conn->query($query);
    $temp = $ris->fetchAll(PDO::FETCH_ASSOC);
    
    $query2 = "SELECT COUNT(*) as num FROM Prodotti";
    
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