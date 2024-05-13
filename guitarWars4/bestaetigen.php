<?php

    require_once("dbconnect.php");

    if (isset($_GET['id'])){

        $id = $_GET['id'];

        try{

            $statement = $pdo->prepare("UPDATE guitarwars1 SET bestaetigt = 1 WHERE id = :id");
            $statement->bindParam(":id", $id);
            $statement->execute();

            echo "Highscore wurde bestätigt" . "<br>";

            echo "<br>";

            echo "<a link href='/workspace_4BK_23_24/guitarwars4/guitarwars2.php'>Zurück zur Highcore-Liste";echo "<br>";
            echo "<a link href='/workspace_4BK_23_24/guitarwars4/index.php'>Zurück zur Index-Liste";echo "<br>";

        }catch(PDOException $e){
            echo "Fehler bei der Bestätigung des Highscores.";
        }
    }

?>