<?php

$id = $_GET["id"];

try {
	$conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
    $query = "SELECT * FROM Utenti where idUtente = " . $id;
    $ris = $conn->query($query); 
    
    $temp = $ris->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($temp);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>