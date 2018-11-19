<?php

$id = $_GET["idUtente"];

try {
	$conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
    $query = "SELECT * FROM Prodotti_Nel_Carrello as pc JOIN Prodotti as p ON pc.Prodotti_idProdotto = p.idProdotto WHERE '".$id."'= pc.Utenti_idUtente AND Visibile = true";
    
    $ris = $conn->query($query);
    $temp = $ris->fetchAll(PDO::FETCH_ASSOC);
   
    echo json_encode($temp);
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>