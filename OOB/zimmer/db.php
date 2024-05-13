<?php

function connectDB() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=zimmer', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo "Fehler beim Aufbau der Datenbankverbindung: " . $e->getMessage();
        exit;
    }
}

function insertSparzimmer($spar1_data) {
    $db = connectDB();
  
    $sql_zimmer = "INSERT INTO zimmer (abkuerzung, anzBetten, groesse, preis, ausstattung) VALUES (:abkuerzung, :anzBetten, :groesse, :preis, :ausstattung)";
    $stmt_zimmer = $db->prepare($sql_zimmer);
    $stmt_zimmer->bindParam(':abkuerzung', $spar1_data['abkuerzung']);
    $stmt_zimmer->bindParam(':anzBetten', $spar1_data['anzBetten']);
    $stmt_zimmer->bindParam(':groesse', $spar1_data['groesse']);
    $stmt_zimmer->bindParam(':preis', $spar1_data['preis']);
    $stmt_zimmer->bindParam(':ausstattung', $spar1_data['ausstattung']);
  
    if ($stmt_zimmer->execute()) {
      $zimmer_id = $db->lastInsertId(); 

      $sql_sparzimmer = "INSERT INTO sparzimmer (zimmerid, anzahlBetten, groesse) VALUES (:zimmerid, :anzahlBetten, :groesse)";
      $stmt_sparzimmer = $db->prepare($sql_sparzimmer);
      $stmt_sparzimmer->bindParam(':zimmerid', $zimmer_id);
      $stmt_sparzimmer->bindParam(':anzahlBetten', $spar1_data['anzBetten']);
      $stmt_sparzimmer->bindParam(':groesse', $spar1_data['groesse']);
  
      if ($stmt_sparzimmer->execute()) {
    
        echo "Sparzimmerdaten erfolgreich in die Datenbank übertragen!\n";
      } else {
        echo "Fehler beim Einfügen in die Tabelle 'sparzimmer': " . $stmt_sparzimmer->errorInfo()[2];
      }
    } else {
      echo "Fehler beim Einfügen in die Tabelle 'zimmer': " . $stmt_zimmer->errorInfo()[2];
    }
  }
  
?>

