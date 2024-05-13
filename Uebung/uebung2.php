<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Übung: Addition mit eingebundener Funktion</h1>

    <p>Bitte geben Sie zwei oder drei Zahlen ein und senden Sie das Formular ab</p>
    
    <?php
    
    require_once("funktion.inc.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $zahl1 = (int)$_POST['zahl1'];
        $zahl2 = (int)$_POST['zahl2'];
        $zahl3 = (int)$_POST['zahl3'];
    
        $ergebnis = addiere($zahl1, $zahl2, $zahl3);
    
        echo "<p>Die Summe der Zahlen ist: $ergebnis</p>";
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="zahl1">Zahl1: </label>
        <input type="number" id="zahl1" name="zahl1" required/> <br>

        <label for="zahl2">Zahl2: </label>
        <input type="number" id="zahl2" name="zahl2" required/> <br>

        <label for="zahl3">Zahl3: (optional): </label>
        <input type="number" id="zahl3" name="zahl3"/> <br>

        <br>
        <input type="submit" value="absenden" name="submit"/>
    </form>

</body>
</html>