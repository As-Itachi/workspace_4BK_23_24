<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GuitarWars</title>
</head>
<body>

<h1>Guitar Wars - Highscores<br></h1>
<p>Willkommen, Guitar Wars-Held!<br></p>
<hr>

<?php

require_once('dbconnect.php');

    try{
        $statement = $pdo->prepare("SELECT * FROM guitarwars1 WHERE bestaetigt = 1" );
        $statement->execute();

        echo "<table>";

        if($statement->rowCount() > 0){

            while($zeile = $statement->fetch()){
                echo "<tr style='font-size:20px'>" .
                        "<td style='color: blue'>" . $zeile['punkte'] . "</td>" . 
                   "</tr>" .
                   "<tr>" . 
                        "<th>Nachname</th>" . 
                        "<td>" . $zeile['nachname'] . "</td>" .
                    "</tr>" . 
                    "<tr>" . 
                        "<th>Datum</th>" . 
                        "<td>" . $zeile['datum'] . "</td>" .
                    "</tr>";

                //echo $zeile['nachname'];
                //echo $zeile['punkte'];
            }

        }

        echo "</table>";
    }catch(PDOException $ex){
        die ("Fehler beim Einfügen der Daten in der Datenbank!");
    }
   
?>

</body>
</html>