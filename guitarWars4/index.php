<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GuitarWars</title>
</head>
<body>

<h1>Guitar Wars - Highscores<br></h1>

<?php

    if(isset($_SESSION['email'])){
        //Benutzer ist angemeldet
        if(isset($_SESSION['benutzername'])){
        echo "<p>Willkommen, " . $_SESSION['benutzername'] . "!<br></p> <hr>";
        echo "Dann kannst du dich hier <a link href='guitarWars2.php'>Highscore-melden</a>";
        
        }

    }else{
        echo "<p>Willkommen, Held<br></p>";
        echo "Dann kannst du dich hier <a link href='login2.php'>anmelden</a> und deine Highscors melden";
    }

?>

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