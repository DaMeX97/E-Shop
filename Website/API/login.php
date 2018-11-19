<?php

$email = $_POST["email"]; // prendo il campo che in questo campo si chiama email
$password = $_POST["password"]; // eventualmente si può usare il post....

try {
  $conn = new PDO("mysql:dbname=my_progettobasi2018;host=localhost", "progettobasi2018", "ProgettoBasi2018!");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setto PDO error mode OPZIONALE    
  $query = "SELECT * FROM Utenti WHERE email = :email AND Password = :password AND Visibile = 1";
  $ris = $conn->prepare($query);
  $ris->bindParam(':email', $email, PDO::PARAM_STR);
  $ris->bindParam(':password', $password, PDO::PARAM_STR);
  
  $ris->execute();

  $temp = $ris->fetchAll(PDO::FETCH_ASSOC);

  if(count($temp) == 1){
    $utente = $temp[0];

    echo "<script type='text/javascript'> sessionStorage.setItem('Admin', " . $utente["Admin"] . " ); sessionStorage.setItem('idUtente'," . $utente["idUtente"] . "); sessionStorage.setItem('Logged', 'true'); sessionStorage.setItem('Nome', '" . $utente["Nome"] . "'); sessionStorage.setItem('Cognome', '" . $utente["Cognome"] . "');</script>";


    // REDIRECT TO HOME
    echo '<script type="text/javascript">
               window.location = "http://progettobasi2018.altervista.org/";
          </script>';
  }
  else {
    echo '<script type="text/javascript">
               window.location = "http://progettobasi2018.altervista.org/?message=Hai inserito i dati sbagliati";
          </script>';
  }

} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}
?>