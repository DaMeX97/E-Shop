<?php

$idProdotto = $_POST["id"];
$marca = $_POST["marca"];
$modello = $_POST["modello"];
$sigla = $_POST["sigla"];
$descrizione = $_POST["descrizione"];
$prezzo = $_POST["prezzo"];
$quantita = $_POST["quantita"];
$idCategoria = $_POST["idCategoria"];

echo $idCategoria;

$visibile = $_POST["visibile"];

try {
	$conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
    $query = "UPDATE Prodotti SET Marca= '".$marca."', Modello= '".$modello."', Sigla='".$sigla."', Descrizione= '".$descrizione."', Prezzo= ".$prezzo.", Quantita=".$quantita.", Visibile=".$visibile.", idCategoria=".$idCategoria . " WHERE idProdotto = " . $idProdotto;
    echo $query;
    $ris = $conn->query($query);

	$target_dir = "../img/prodotti/";
    $target_file = $target_dir . $idProdotto;
    
    echo $target_file;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      echo "Immagine caricata";
    } else {
      echo "Nessuna immagine";
    }

    // REDIRECT TO HOME
   	 echo '<script type="text/javascript">
             window.location = "http://progettobasi2018.altervista.org/pannelloAdmin.html?section=prodotti"
        </script>';
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>