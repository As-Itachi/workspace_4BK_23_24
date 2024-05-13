<?php

    try{

        $pdo = new PDO("mysql:host=localhost;dbname=hassliebe;charset = utf8", "root");

    }catch(PDOException $e){
        $e->getMessage();
        echo "Fehler beim Aaufbau der Datenbank";
    }

?>