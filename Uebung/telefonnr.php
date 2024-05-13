<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formular mit Telefonnummer-Validierung</title>
</head>
<body>

    <?php 
        if(isset($_POST['submit'])){
            $tele = $_POST['tele'];
            if(preg_match('/^0\d{3}\d{7}$/', $tele)){
                echo "Die eingegebene Telefonnummer ist korrekt.";
            }else{
                echo "Die eingegebene Telefonnummer ist falsch formatiert.";
            }
        } else {
            echo "Bitte geben Sie eine Telefonnummer ein.";
        }
    ?>
    
    <form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

        <h2>Telefonnummer überprüfen</h2>

        <label for="tele">Telefonnummer:</label>
        <input type="text" name="tele" id="tele" placeholder="z.B. 0123456789">

        <input type="submit" name="submit" value="Überprüfen"/>

    </form>

</body>
</html>
