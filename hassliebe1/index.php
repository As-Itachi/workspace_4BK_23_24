<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" type="text/css" href="index.css" />
</head>
<body>
    
    <?php

    try{

        require_once('db.php');
        require_once('konstante.php');

        echo "<h1>Neue Mitglieder</h1>" . "<br>";
        
        $statement = $pdo->prepare("SELECT * FROM hassliebe1");
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_OBJ)) {

            echo "<div class='profil'>";

            //echo "<img src='" . GW_IMAGEPFAD . $row['bild'] . "' alt='" . $row['vorname'] . " " . $row['nachname'] . "' />";
            echo "<img src='" . GW_IMAGEPFAD . $row->bild . "' alt='" . $row->vorname . " " . $row->nachname . "' />";


            echo "<h2>" . $row->vorname . " " . $row->nachname . "</h2>";
            echo "<p>" . $row->wohnort . "</p>";
            echo "<p>" . $row->geburtstag . "</p>";

            echo "</div>";
        }

    }catch(PDOException $y){
        die("Fehler bei der Abfrage");
    }

    ?>

</body>
</html>