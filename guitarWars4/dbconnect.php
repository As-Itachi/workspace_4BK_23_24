<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=guitarwars4;  
                    charset=utf8","root",""); 

  } catch (PDOException $e) {
     echo $e->getMessage();   
     die ("Fehler beim Verbindungsaufbau zur DB!");
  }
?>