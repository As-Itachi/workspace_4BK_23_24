<?php

try{
    $pdo = new PDO("mysql:host=localhost;dbname=vermisst2;  
    charset=utf8","testuser","7087");
}catch(PDOException $e){
    echo $e->getMessage();
    echo "Fehler bei der Verbindung zur Datenbank";
}

?>