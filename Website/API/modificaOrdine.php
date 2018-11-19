<?php

$idOrdine = $_GET["id"];
$stato = $_POST["stato"];

try {
	$conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
    $query = "UPDATE Ordini SET Stato= ".$stato." WHERE idOrdine = " . $idOrdine;
    echo $query;
    $ris = $conn->query($query);


    // REDIRECT TO HOME
   	 echo '<script type="text/javascript">
             window.location = "http://progettobasi2018.altervista.org/pannelloAdmin.html?section=ordini"
        </script>';
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>