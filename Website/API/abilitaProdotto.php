<?php

$id = $_GET["id"];

try {
	$conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
    $query = "UPDATE Prodotti SET Visibile = 1 WHERE idProdotto = :id ";
    
    $ris = $conn->prepare($query);
   	$ris->bindParam(':id', $id, PDO::PARAM_INT);
    $ris->execute();
    
  	echo '<script type="text/javascript">
             window.location = "http://progettobasi2018.altervista.org/pannelloAdmin.html?section=prodotti"
        </script>';
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>