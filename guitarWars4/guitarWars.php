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

if(isset($_POST['submit'])){

    if(empty($_POST['name'] || empty($_POST['punkte']))){
        echo "<h3>Bitte füllen Sie zuerst alle Plichtfelder aus</h3>";  
    }else{

    $name = $_POST['name'];
    $punkte = $_POST['punkte'];

    echo "<h1> Guitar Wars - Highscore melden</h1>" . "<br>";
    echo "<p>Vielen Dank für deinen neuen Highscore</p>";
    echo "Name: " . $name . "<br>";
    echo "Punkte: " . $punkte. "<br>";

    echo "<a link href='http://localhost/workspace_4BK_23_24/guitarwars/index.php'Zurück zur Highcore-Liste/a>";

    require_once('dbconnect.php');

    try{
    $statement = $pdo->prepare("INSERT INTO guitarwars1 (nachname, punkte) VALUES (:nachname, :punkte)");

    $statement->bindParam(":nachname", $name);
    $statement->bindParam(":punkte", $punkte);

    $statement->execute();

    }catch(PDOException $ex){
        die ("Fehler beim Einfügen der Daten in der Datenbank!");
    }
    echo "<h4>Ihre Daten wurden gespeichert</h4>";

    }
}else{
?>
    
<h1>Guitar Wars - Highscore melden</h1>

<form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

<label for="name">Name: </label>
<input type="text" id="name" name="name" required/> <br>

<label for="punkte">Punkte:</label>
<input type="number" id="punkte" name="punkte" required/> <br>

<br>

<input type="submit" value="Highscore melden" name="submit"/>

</form>

<?php
}
?>

</body>
</html>