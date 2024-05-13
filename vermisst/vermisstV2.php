<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php

    if(isset($_POST['submit'])){

        if(empty($_POST['nachname'] || empty($_POST['email'] || empty($_POST['wann'] || empty($_POST['zeit'] || empty($_POST['wo'] || empty($_POST['standort']))))))){
            echo "Bitte fuellen sie die Pflichtfelder aus";
        }else{

            $nachname = $_POST['nachname'];
            $email = $_POST['email'];
            $wann = $_POST['date'];
            $zeit = $_POST['time'];
            $wo = $_POST['wo'];
            $standort = $_POST['standort'];

            echo "Name:" . $nachname . "<br>";
            echo "Email:" . $email. "<br>";
            echo "Wann" . $wann. "<br>";
            echo "Zeit" . $zeit. "<br>";
            echo "Wo" . $wo. "<br>";
            echo "Standort" . $standort. "<br>";

            $datetime = new DateTime("$wann $zeit");

            $datetimeString = $datetime->format("Y-m-d H:i:s");

            include("db.php");

            try{

                $statement = $pdo->prepare("INSERT INTO sichtungen(nachname, email, standort, wo, datum) VALUES (:nachname, :email, :standort, :wo, :datum)");

                $statement->bindParam(":nachname", $nachname);
                $statement->bindParam(":email", $email);
                $statement->bindParam(":standort", $standort);
                $statement->bindParam(":wo", $standort);
                $statement->bindParam(":datum", $datetimeString);

                $statement->execute();

            }catch(PDOException $e){
                $e->getMessage();
                echo "Fehler beim einfügen der Daten";
            }
            echo "<h4>Ihre Daten wurden gespeichert</h4>";
        }

    }else{
    ?>

<form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

    <label for="nachname">Ihr Nachname:</label>
    <input type="text" name="nachname" id="nachname" required/> <br>

    <label for="email">E-Mail:</label>
    <input type="email" name="email" id="email" /> <br>

    <label for="wann">Wann haben Sie ihn gesehen?</label>
    <input type="date" name="date" id="date" required /> <br>

    <label for="zeit">Um welche Uhrzeit? </label>
    <input type="time" name="time" id="time" required/> <br>

    <label for="wo">Wo haben sie ihn gesehen?</label>
    <input type="text" name="wo" id="wo" required/> <br>

    <label for="standort">Ist Goran bei Ihnen noch?</label>
    <input type="radio" name="standort" value="ja" checked />
    <input type="radio" name="standort" value="nein" /> <br>

    <br>

    <input type="submit" name="submit" value="melden" />

</form>

<?php
    }
?>

</body>
</html>