<?php

try{
    $pdo = new PDO("mysql:host=localhost;dbname=hassliebe;  
    charset=utf8","root"); 

}catch(PDOException $e){
    echo $e->getMessage();   
     die ("Fehler beim Verbindungsaufbau zur DB!");
}

?>