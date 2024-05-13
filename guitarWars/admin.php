<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="admin.css" />
</head>
<body>

    <?php

        require_once("dbconnect.php");

        try{

            $statement = $pdo->prepare("SELECT * FROM guitarwars1 WHERE bestaetigt = 0");
            $statement->execute();

            echo "<table>";

            while ($row = $statement->fetch()) {

                echo 
                    "<tr>" . 
                        "<th>" . $row['id'] . "</th>" .
                        "<th>" . $row['nachname'] . "</th>" .
                        "<td>" . $row['datum'] . "</td>" .
                        "<td>" . $row['punkte'] . "</td>" .
                        "<td>" . "<a href='hsloeschen.php?id=$row[id]&nachname=$row[nachname]&datum=$row[datum]&punkte=$row[punkte]' >Löschen </a>" . "</th>" .
                        "<td>" . "<a href='bestaetigen.php?id=$row[id]'>Bestätigen </a>" . "</td>" .

                    "</tr>";
    
            }

            echo "</table>";
            echo "<a link href='/workspace_4BK_23_24/guitarwars/guitarWars2.php'>Zurück zum Highscore Melden</a>";

        }catch(PDOException $e){
            echo $e->getMessage();
            echo "Fehler beim Auslesen der Daten";
        }

    ?>
    
</body>
</html>