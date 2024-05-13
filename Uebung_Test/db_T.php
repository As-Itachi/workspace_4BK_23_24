<?php

    try{

        //$pdo = new PDO("mysql:host=localhost;dbname=konzert; charset=utf8", "Testuser", "7087");
        $pdo = new PDO("mysql:host=localhost;dbname=konzert;  
        charset=utf8","root");

    }catch(PDOException $e){
        $e->getMessage();
        echo "Fehler bei deim Aufbau der Datenbank";
    }

?>