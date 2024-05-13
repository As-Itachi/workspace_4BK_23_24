<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vermisst</title>
    <link rel="stylesheet" type="text/css" href="katze.css" />
</head>
<body>
    <?php

    if(isset($_POST['submit'])){

        if(empty($_POST['nachname'] || empty($_POST['email'] || empty($_POST['date'] || empty($_POST['place'] || empty($_POST['standort'] || empty($_POST['time']))))))){
            echo "<h3>Bitte füllen Sie zuerst alle Plichtfelder aus</h3>";
        }else{

        $nachname = $_POST['nachname'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        $place = $_POST['place'];
        $standort = $_POST['standort'];
        $zeit = $_POST['time'];


        echo "Name: " . $nachname;
        echo "<br>E-Mail: " . $email;
        echo "<br>Zeit: " . $date;
        echo "<br>Ort: " . $place;
        echo "<br>Bei Ihnen? " . $standort;
        echo "<br> Zeit: " . $zeit;

        $datetime = new DateTime("$date $zeit");

        $datetimeString = $datetime->format("Y-m-d H:i:s");

        //Wenn alle Daten vorhanden sind, sollen diese in die DB übertragen werden
        //1. Schritt Verbindungsaufbau (erstellen eines PDO-Verbindungsobjekts)

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=vermisst;  
                            charset=utf8","testuser","7087"); 

          } catch (PDOException $e) {
             echo $e->getMessage();   
             die ("Fehler beim Verbindungsaufbau zur DB!");
          }
        

        try{
        //2.a. Schritt - SQL-Statement aufbauen
        $statement = $pdo->prepare("INSERT INTO meldungen (nachname, email, place, standort, datum) VALUES (:nachname, :email, :place, :standort, :datum)");
        //2.b. Schritt - alle Platzhalter mit Werten belgen (binden)
        $statement->bindParam(":nachname", $nachname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":datum", $datetimeString);
        $statement->bindParam(":place", $place);
        $statement->bindParam(":standort", $standort);

        //3. Schritt - Absetzen
        $statement->execute();

        }catch(PDOException $e){
            die ("Fehler beim Einfügen der Daten in der Datenbank!");
        }
       echo "<h2>Ihre Daten wurden gespeichert</h2>";

        }

    }else{
    ?>

    <h1>Meine Katze Goran ist verschwunden</h1>
    <img src="./katze.jpg" width="200"/><br />

<form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

    <p> Wenn Sie sie gesehen haben, dann füllen Sie bitte folgendes Folmular aus: </p>

    <label for="nachname"> Ihr Nachname: </label>
    <input type="text" id="nachname" name="nachname" required/> <br>
  
    <label for="email"> Ihre E-Mail-Adresse: </label>
    <input type="email" id="email" name="email" required/> <br> 

    <label for="time"> Wann haben Sie Goran gesehen? </label>
    <input type="date" id="date" name="date" required/> <br> 

    <label for="time"> Um wie viel Uhr? </label>
    <input type="time" id="time" name="time" required/> <br> 

    <label for="place"> Wo haben Sie ihn gesehen? </label>
    <input type="text" id="place" name="place" required/> <br> 

    <label for="standort">Ist Goran noch bei Ihnen? </label>
    <input  name="standort" type="radio" value="Ja" /> Ja
    <input  name="standort" type="radio" value="Nein" checked> Nein <br>

    <br>
    <input type="submit" value="Sichtung melden" name="submit"/>


</form> 

<?php
    }
?>

</body>
</html>