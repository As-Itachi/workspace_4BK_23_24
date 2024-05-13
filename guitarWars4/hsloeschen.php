<?php

    require_once("autorisieren.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    
        $id;
        $nachname;
        $datum;
        $punkte;

    if (isset($_GET['id']) && isset($_GET['nachname']) && isset($_GET['datum']) && isset($_GET['punkte'])) {

        $id = $_GET['id'];
        $nachname = $_GET['nachname'];
        $datum = $_GET['datum'];
        $punkte = $_GET['punkte'];

    ?>

        <form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

            <label for="id"><strong>ID</strong></label>
            <?php echo $id ?><br>

            <label for="nachname"><strong>Nachname</strong></label>
            <?php echo $nachname ?><br>

            <label for="datum"><strong>Datum</strong></label>
            <?php echo $datum ?><br>

            <label for="punkte"><strong>Punkte</strong></label>
            <?php echo $punkte ?><br>

            <br>

            <input type="radio" name="auswahl" id="auswahl" value="ja" checked>
            <label for="auswahl">Ja</label>

            <input type="radio" name="auswahl" id="auswahl" value="nein" checked>
            <label for="auswahl">Nein</label><br>


            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="hidden" name="nachname" value="<?php echo $nachname;?>"/>
            <input type="hidden" name="datum" value="<?php echo $datum;?>"/>
            <input type="hidden" name="punkte" value="<?php echo $punkte;?>"/>

            <br>

            <input type="submit" name="submit" value="Senden"><br>

            <br>
        </form>

        <a link href='/workspace_4BK_23_24/guitarwars4/admin.php'>Zurück zur Admin-Seite</a>;


    <?php


    } else if(isset($_POST['submit'])){

        if(isset($_POST['id']) && isset($_POST['nachname']) && isset($_POST['datum']) && isset($_POST['punkte']) && isset($_POST['auswahl'])){

            $id = $_POST["id"];
            $nachname = $_POST["nachname"];
            $datum = $_POST["datum"];
            $punkte = $_POST["punkte"];
            

            if($_POST['auswahl'] == 'ja'){

                //dateipfad löschen bei bildern hier kommt das bei den Bildern

                require_once("dbconnect.php");

                try{

                    $statement = $pdo->prepare("DELETE FROM guitarwars1 WHERE id=:id");
                    $statement->bindParam(":id" , $id);
                    $statement->execute();

                    echo "Ihre Daten wurden gelöscht . $id" . " " . $nachname . " " .  $punkte .  "<br>";
                    echo "<br>";
                    echo "<a link href='/workspace_4BK_23_24/guitarwars4/admin.php'>Zurück zur Admin-Seite</a>";
        
                }catch(PDOException $e){
                        echo $e->getMessage();
                        echo "Ihre Daten konnten nicht gelöscht werden";
                }

            }

        }   
        
    }else{
        echo "Ihr DatenSatz konnte nicht gefunden werden";
    }

    ?>

</body>

</html>