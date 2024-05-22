<?php

    try{

        $pdo = new PDO("mysql:host=localhost;dbname=jobs;charset = utf8", "root", "");

    }catch(PDOException $e){
        $e->getMessage();
        echo "Fehler beim Aaufbau der Datenbank";
    }

?>