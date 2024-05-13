<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hassliebe</title>
    <link rel="stylesheet" type="text/css" href="hassliebe.css" />
</head>
<body>

    <?php

    require_once("konstante.php");

    if(isset($_POST['submit'])){

        if(empty($_POST['vorname']) || empty($_POST['nachname']) || empty($_POST['geschlecht']) || empty($_POST['wohnort'] || empty($_POST['birthdate']))){
            echo "<h3>Bitte füllen Sie zuerst alle Pflichtfelder aus</h3>";
        } else {

            $vorname = $_POST['vorname'];
            $nachname = $_POST['nachname'];
            $geschlecht = $_POST['geschlecht'];
            $wohnort = $_POST['wohnort'];
            $birthdate = $_POST['birthdate'];

            $bild_name = $_FILES['bild']['name'];
            $bild_typ = $_FILES['bild']['type'];
            $bild_groesse = $_FILES['bild']['size'];
            $bild_temp_name = $_FILES['bild']['tmp_name'];

            if(($bild_typ == 'image/jpeg' || 
            $bild_typ == 'image/png' ||
            $bild_typ == 'image/gif') &&
            $bild_groesse > 0 && $bild_groesse <= GW_MAXDATEIGROESSE) {

                $ziel = GW_IMAGEPFAD . $bild_name;

                if(move_uploaded_file($bild_temp_name, $ziel)){

                    try {
                        require_once('db.php');

                        $statement = $pdo->prepare("INSERT INTO hassliebe1 (vorname, nachname, wohnort, geschlecht, bild, geburtstag) VALUES (:vorname, :nachname, :wohnort, :geschlecht, :bild, :geburtstag)");
                        $statement->bindParam(":vorname", $vorname);
                        $statement->bindParam(":nachname", $nachname);
                        $statement->bindParam(":wohnort", $wohnort);
                        $statement->bindParam(":geschlecht", $geschlecht);
                        $statement->bindParam(":bild", $bild_name);
                        $statement->bindParam("geburtstag", $birthdate);

                        $statement->execute();

                        if(file_exists($bild_temp_name)){
                            unlink($bild_temp_name);
                        }

                        echo "<h2>Neue Mitglieder</h2>" . "<br>";

                        try{
                            require_once('db.php');

                            $statement = $pdo->prepare("SELECT * FROM hassliebe1");
                            $statement->execute();

                            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {

                                echo "<div class='profil'>";

                                echo "<img src='" . GW_IMAGEPFAD . $row->bild . "' alt='" . $row->vorname . " " . $row->nachname . "' />";

                                echo "<h2>" . $row->vorname . " " . $row->nachname . "</h2>";
                                echo "<p>" . $row->wohnort . "</p>";
                                echo "<p>" . $row->geburtstag . "</p>";

                                echo "</div>";
                            }

                        }catch(PDOException $y){
                            die("Fehler bei der Abfrage");
                        }
                        

                    } catch(PDOException $e) {
                        echo "Der neue Datensatz konnte nicht gespeichert werden: " . $e->getMessage();
                    }
                } else {
                    echo "Wählen Sie eine geeignete Bilddatei aus";
                }

            }

        }

    } else {
    ?> 

    <h4>Persönliche Daten</h4>

    <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

        <label for="vorname">Vorname: </label>
        <input type="text" id="vorname" name="vorname" required/> <br>

        <label for="nachname">Nachname: </label>
        <input type="text" id="nachname" name="nachname" required/> <br>

        <label for="geschlecht">Geschlecht </label>
        <select id="geschlecht" name="geschlecht" required>
            <option value="m">Männlich</option>
            <option value="w">Weiblich</option>
            <option value="d">Divers</option>
        </select><br>

        <label for="wohnort">Wohnort</label>
        <input type="text" id="wohnort" name="wohnort" required/> <br>

        <label for="birthdate">Geburtstag</label>
        <input type="date" name="birthdate" id="birthdate" /> <br>

        <input type="file" id="bild" name="bild" required /> <br>

        <br>

        <input type="submit" value="profil_speichern" name="submit"/>

    </form>

    <?php
    }
    ?>

</body>
</html>
