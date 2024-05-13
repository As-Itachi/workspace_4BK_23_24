<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrieren</title>
</head>
<body>

    <?php

    $auth_benutzername;

    if(isset($_POST['anmelden'])){

        if(empty($_POST['benutzername'] || empty($_POST['passwort'] || empty($_POST['passwortWH'] || ($_POST['passwort'] != $_POST['passwortWH']))))){
            echo "Bitte füllen Sie alle Pflichtfelder aus";
        }else{

            $auth_benutzername = htmlspecialchars(trim($_POST['benutzername']));
            $auth_passwort = $_POST['passwort'];
            $auth_passwortWH = $_POST['passwortWH'];
            $passwort_hash = password_hash($auth_passwort, PASSWORD_DEFAULT);

            if($auth_passwort != $auth_passwortWH) {
                echo "Die Passwörter stimmen nicht überein";
            }else{

                try{

                    require_once('db.php');

                    $statement = $pdo->prepare("SELECT benutzername from hassliebe1 WHERE benutzername = :benutzername");

                    $statement->bindParam(":benutzername", $auth_benutzername);
                    $statement->execute();

                    if($statement->rowCount()>0){
                        echo "<i><b style='color: red'>Ihr Benutzername ". $auth_benutzername . " existiert bereits!<br> Bitte geben Sie eine anderen Benuternamen ein!</b></i>";
                    }else{

                        $statement = $pdo->prepare("INSERT INTO hassliebe1 (benutzername, passwort) VALUES (:benutzername, :passwort)");

                        $statement->bindParam(':benutzername', $auth_benutzername);
                        $statement->bindParam(':passwort', $passwort_hash);

                        $statement->execute();
                        echo "<h1>Hassliebe.net - Registrierung</h1>";
                        echo "<p>Ihr Konto wurde erstellt. Sie können sich jederzeit einloggen und ihr </p>";

                    }

                }catch(PDOException $z){
                    echo "Fehlgeschlagen";
                }

            }

        }

    }else{

    ?>

<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

    <h1>Hassliebe.net - Registrierung</h1>

    <p>Waehlen Sie einen Benutzernamen und ein Passwort, um sich für Hassliebe.net zu registrieren</p>

        <fieldset>
            <legend>Anmeldedaten</legend>
            <label for="benutzername">Benutzername:</label>
            <input type="email" name="benutzername" id="benutzername" 
                value="<?php if(!empty($auth_benutzername)){
                            echo "$auth_benutzername";
                        }?>"><br>

            <label for="passwort">Passwort:</label>
            <input type="password" id="passwort" name="passwort"><br>

            <label for="passwortWH">Passwort (Wiederholung):</label>
            <input type="password" id="passwortWH" name="passwortWH"><br>
        </fieldset>

        <br>
        <input type="submit" value="Anmelden" name="anmelden">

</form>

<?php
}
?>
    
</body>
</html>