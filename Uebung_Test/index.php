<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php

    require_once("db_T.php");

    try{

        $statement = $pdo->prepare("SELECT * FROM daten");
        $statement->execute();

        echo "<tabel>";

        if($statement->rowCount() > 0){

            while($zeile = $statement->fetch()){
                echo "<t>" .
                        "<td>" . $zeile['nname'] . "</td>" .
                        "<tr>";
            }

        }

        echo "</table>";

    }catch(PDORow $e){
        die("Fehler beim Einfügen der Daten in die Datenbank");
    }

    ?>

</body>
</html>