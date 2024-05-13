<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="konzert.css" />
</head>
<body>
    
    <?php

    if(isset($_POST['submit'])){

        if(empty($_POST['name'] || empty($_POST['konzert'] || empty($_POST['anzahl'])))){

            echo "Bitte füllen Sie alle Pflichtfelder aus";

        }else{
            
            $name = $_POST['name'];
            $konzert = $_POST['konzert'];
            $anzahl = $_POST['anzahl'];

            require_once('konstanten.php');

            switch($konzert){

                case "u2":
                    $gesamtbetrag = $anzahl * U2_Preis;
                    break;
                case "dth":
                    $gesamtbetrag = $anzahl * Die_Toten_Hosen_Preis;
                    break;
                case "r":
                    $gesamtbetrag = $anzahl * Rammstein_Preis;
                    break;
                default:
                    $gesamtbetrag = 0;
                    break;
            }

            echo "<h3>Zusammenfassung Ihrer Reservierung</h3>" ."<br>";

            echo "Besteller: " . $name . "<br>";
            echo "Bestelldetails: " . $anzahl . " Karten für " . $konzert;

            echo "<h3>Gesamtpreis: </h3>" . $gesamtbetrag . "€";

            echo "<p>Viel Spass auf dem Konzert!";

            require_once('db_T.php');

            try{

                $statemnt = $pdo->prepare("INSERT INTO daten(nname, konzert, anzahl) VALUES (:nname, :konzert, :anzahl)");

                $statemnt->bindParam("nname" , $name);
                $statemnt->bindParam("konzert", $konzert);
                $statemnt->bindParam("anzahl", $anzahl);

                $statemnt->execute();


            }catch(PDOException $e){
                die("Fehler beim einfügen der Daten in die Datenbank");
            }

            echo "<h3>Ihre Daten wurden gespeichert</h3>";

        }

    }else{
    ?>

<h1>Reservierung Konzertkarte</h1>

<form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>"> 

    <label for="name">Name: </label>
    <input type="text" name="name" id="name" required/> <br>

    <label for="Konzert">Konzert: </label>
    <select id="konzert" name="konzert" required>
            <option value="u2">U2</option>
            <option value="dth">Die Toten Hosen</option>
            <option value="r">Rammstein</option> <br>
    </select><br>

    <label for="anzahl">Anzahl: </label>
    <input type="number" name="anzahl" id="anzahl" min="0" max="10" required/> <br>

    <br>

    <input type="submit" name="submit" value="weiter"/> <br>

</form>

<?php
}
?>

</body>
</html>