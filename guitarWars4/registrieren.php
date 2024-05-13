<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrieren1</title>
</head>

<body>
    <h1> Guitar Wars - Registrierung</h1>

    <p>Wähle einen Benutzername und ein Passwort, um Dich für Guitar Wars zu registrieren.</p>

    <?php

    $auth_email;

    if (isset($_POST['registrieren'])) {
        if (empty($_POST['email']) || empty($_POST['passwort']) || empty($_POST['passwortWH'] || ($_POST['passwort'] != $_POST['passwortWH']))) {
            echo "Bitte füllen Sie alle Felder!";
        } else {
            $auth_email = $_POST['email'];
            $auth_passwort = $_POST['passwort'];
            $auth_passwortWH = $_POST['passwortWH'];
            $passwort_hash = password_hash($auth_passwort, PASSWORD_DEFAULT);

            if ($auth_passwort != $auth_passwortWH) {
                echo "Die Passwörter stimmen nicht überein!";
            } else {

                //Alle Daten vorhanen -> in DB eintragen
                try {
                    require_once('dbconnect.php');

                    $stmt = $pdo->prepare("SELECT email FROM guitarwars1 WHERE email = :email");
                    
                    $stmt->bindParam(':email', $auth_email);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        echo "<i><b style='color: red'>Ihre Email ". $auth_email . " existiert bereits!<br> Bitte geben Sie eine andere Email ein!</b></i>";
                    } else {

                        $statement = $pdo->prepare("INSERT INTO guitarwars1 (email, passwort) VALUES (:email, :passwort)");

                        $statement->bindParam(':email', $auth_email);
                        $statement->bindParam(':passwort', $passwort_hash);

                        $statement->execute();

                       echo "$passwort_hash" ;
                        echo "Registrierung erfolgreich!";
                    }
                } catch (PDOException $e) {
                    die("Registrierung fehlgeschlagen!");
                }
            }
        }
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
        <fieldset>
            <legend>Anmeldedaten</legend>
            <label for="email">E-Mail:</label>
            <input type="email" name="email" id="email" 
                value="<?php if(!empty($auth_email)){
                            echo "$auth_email";
                        }?>"><br>

            <label for="passwort">Passwort:</label>
            <input type="password" id="passwort" name="passwort"><br>

            <label for="passwortWH">Passwort (Wiederholung):</label>
            <input type="password" id="passwortWH" name="passwortWH"><br>
        </fieldset>
        <br>
        <input type="submit" value="Registrieren" name="registrieren">
    </form>
</body>

</html>