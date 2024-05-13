<?php 

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GuitarWars</title>
    <link rel="stylesheet" type="text/css" href="guitar.css" />
</head>
<body>

<?php

    //ist der User eingeloggt?
    if(!isset($_SESSION['email'])){

        echo "Sie müssen sich zuerst anmelden";
        echo "Dann kannst du dich hier <a link href='login2.php'>anmelden</a> und deine Highscors melden";

    }else{


    
        //Importieren der Konstanten der File-Upload
        require_once('appKonstanten.php');

        if(isset($_POST['submit'])){

            if(empty($_POST['name'] || empty($_POST['punkte']))){
                echo "<h3>Bitte füllen Sie zuerst alle Plichtfelder aus</h3>";  
            }else{

                //Werte aus $_POST auslesen
                $name = $_POST['name'];
                $punkte = $_POST['punkte'];

                //Spielername als Session-Variable setzen.
                $_SESSION['benutzername'] = $name;

                //Prüfen on Datei angekommen ist
                $screenshot_name = $_FILES['screenshot'] ['name'];
                $screenshot_typ = $_FILES['screenshot'] ['type'];
                $screenshot_groesse = $_FILES['screenshot'] ['size'];
                $screenshot_temp_name = $_FILES['screenshot'] ['tmp_name'];

                //Prüfen, ob die Datei angekommen ist
                if (($screenshot_typ == 'image/jpeg' || 
                    $screenshot_typ == 'image/png' ||
                    $screenshot_typ == 'image/gif') &&
                    $screenshot_groesse > 0 && $screenshot_groesse <= GW_MAXDATEIGROESSE) {

                    //Festlegen des Zielpfades für die Datei am Webserver
                    $ziel = GW_IMAGEPFAD . $screenshot_name;
                    
                    //verschieben der Datei aus dem temporären Ordner in den Zielordner auf dem Webserver
                    //wenn das File in den Zielordner verschoben wurde, andernfalls wird FALSE zurückgegeben
                        if (move_uploaded_file($screenshot_temp_name, $ziel)){

                            try{
                                //Verbindungsaufbau und INSERT in die Datenbank
                                require_once('dbconnect.php');
            
                                //INSERT vorbereiten
                                $statement = $pdo->prepare("INSERT INTO guitarwars1 (nachname, punkte, screenshot, bestaetigt) VALUES (:nachname, :punkte, :screenshot ,0)");
                                //Platzhalter mit Werten belegen
                                $statement->bindParam(":nachname", $name);
                                $statement->bindParam(":punkte", $punkte);
                                $statement->bindParam(":screenshot", $screenshot_name);

                                //Ausführen des Statment 
                                $statement->execute();

                                //Am Server aufräumen - Datei aus Temp-Ordner entfernen
                                if (file_exists($screenshot_temp_name)){
                                    //Löschen
                                    unlink($screenshot_temp_name);
                                }

                                echo "<h1> Guitar Wars - Highscore melden</h1>" . "<br>";
                                echo "<p>Vielen Dank für deinen neuen Highscore</p>";

                                echo "Name: " . $name . "<br>";
                                echo "Punkte: " . $punkte. "<br>";

                                echo "<br>";

                                echo "<a link href='/workspace_4BK_23_24/guitarwars4/guitarwars2.php'>Zurück zur Highcore-Liste/a>";echo "<br>";

                                echo "<a link href='/workspace_4BK_23_24/guitarwars4/index.php'>/a>Zur Eintragsliste";echo "<br>";

                                echo "<br>";

                                //echo "<a link href='/workspace_4BK_23_24/guitarwars/admin.php'>Zur Eintragsliste</a>";
                                echo "<a href='/workspace_4BK_23_24/guitarwars4/login.php'>Adminbereich</a>";


                            }catch(PDOException $e){
                                echo "DEr neue Highscore konnte nicht gespeichert werden";
                            }
                        }else{
                            echo "Waehlen sie eine geeignete Bilddatei aus";
                        }

                    }else{
                        echo "Bitte";
                    }
                }
        }else{
?>

<h1>Guitar Wars - Highscore melden</h1>
<a link href="logout2.php">Logout</a>

<hr>

<!-- Ergänzen des from-Tag, damit die Übertragung von Dateien ermöglichen wird -->

<form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

<label for="name">Name: </label>
<input type="text" id="name" name="name" required/> <br>

<label for="punkte">Punkte:</label>
<input type="number" id="punkte" name="punkte" min="1" required/> <br>

<!-- Neues Feld für die Auswahl der Datei -->
<input type="file" id="screenshot" name="screenshot" required/> <br>

<br>

<input type="submit" value="Highscore melden" name="submit"/>

</form>

<?php
}
}
?>

</body>
</html>