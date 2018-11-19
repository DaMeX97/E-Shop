<?php
$pagamento = $_POST["pagamento"];
$data = date("Y/m/d");
$idUtente = (int) $_GET["idUtente"];
$stato = 1;

try {
  $conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE
  $query = "INSERT INTO Ordini (Data, Pagamento, Stato, idUtente) VALUES ('" . $data . "', '". $pagamento ."', ".$stato.",".$idUtente.")";
  $ris = $conn->query($query);
  $idOrdine = $conn->lastInsertId();

  $query2 = "SELECT * FROM Prodotti_Nel_Carrello as pc JOIN Prodotti as p ON pc.Prodotti_idProdotto = p.idProdotto WHERE '".$idUtente."'= pc.Utenti_idUtente AND Visibile = true";
  $ris2 = $conn->query($query2);
  $array = $ris2->fetchAll(PDO::FETCH_ASSOC);

  foreach($array as $row) {
    $idProdotto = $row["idProdotto"];
    $prezzo = $row["Prezzo"];
    $quantita = $row["Quantita_Nel_Carrello"];
    $query3 = "INSERT INTO Prodotti_Nel_Ordine(idOrdine, idProdotto, Prezzo, Quantita_Nel_Ordine) VALUES (".$idOrdine.",".$idProdotto.",".$prezzo.",".$quantita.")";
    $ris3 = $conn->query($query3);	
    $query4 = "UPDATE Prodotti SET Quantita = (Quantita - ".$quantita.") WHERE idProdotto = ".$idProdotto;
    $ris4 = $conn->query($query4);	

  }

  $query4 = "DELETE FROM Prodotti_Nel_Carrello WHERE Utenti_idUtente = ".$idUtente;
  $ris4 = $conn->query($query4);
  
  echo '<script type="text/javascript">
             window.location = "http://progettobasi2018.altervista.org/ordineEffettuato.html"
        </script>';

} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}
?>