<?php
    
    session_start(); //Session erzeugen

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login2</title>
</head>
<body>

<?php

    if(isset($_COOKIE['email'])){

        echo "Sie sind schon angemeldt hier kommen sie zur <a link href='index.php'>Index</a> Seite";

    }else{

    $formular_anzeigen = true;
    if(isset($_POST['login'])){

        if(empty($_POST['benutzername'] || empty($_POST['passwort']))){

            echo "Bitte füllen sie das Formular vollständig aus";

        }else{

            //Auspacken der Dateb
            //trim funktion entfernt leerzeichen vor und hinter dem String und die die HTMlspec.. maskiert gefährliche Zeichen 
            $auth_email = htmlspecialchars(trim($_POST['benutzername']));
            $auth_passwort = htmlspecialchars(trim($_POST['passwort']));

            //Eintrag in der DB suchen
            require_once("dbconnect.php");

            try{

                $statement = $pdo->prepare("SELECT email, passwort, id FROM guitarwars1 WHERE email = :email");
                $statement->bindParam(":email", $auth_email);
                $statement->execute();

            }catch(PDOException $e){
                die("Login nicht möglich");
            }

            if($statement->rowCount() > 0){
                //Daten zum benuzter dieser Emial werden geladen
                $row = $statement->fetch();
                $gespeichertesPWD = $row['passwort'];
                $id = $row['id'];
                $email = $row['email'];

                //prüfen ob das Passwort aus der DB mit dem eingeben PWD übereinstimmt
                if(password_verify($auth_passwort, $gespeichertesPWD)){

                    /*prüfen, on alter Hash-wert mit neuen Hash-wert überschrieben werden soll*/
                    //DB aktualisieren, wenn sich der Hash-Algorothmus geändert hat

                    if(password_needs_rehash($gespeichertesPWD, PASSWORD_DEFAULT)){
                        //Passwort neu hashen
                        $neuesPWD = password_hash($auth_passwort, PASSWORD_DEFAULT);

                        //den alten gespeicherten Hash durch den neuen ersetzten

                        try{
                            $statement = $pdo->prepare("UPDATE guitarwars1 SET passwort = :passwort WHERE email = :email");
                            $statement->bindParam(':passwort', $neuesPWD);
                            $statement->bindParam(':email', $auth_email);
                            $statement->execute();
                        }catch(PDOException $e){
                            die("Es ist ein Fehler beim Speichern des neuen Hashwert aufgetreten");
                        }
                        echo "<h3>DIe Daten wurden aktualisiert</h3>";

                    }

                    echo "Login erfolgreich";
                    $formular_anzeigen = false; //weil alle Daten für den Login vorhanden sind

                    //Setzen der Cookies
                    //Wenn beim Setzen der Cookies kein driites Argument mitgegeben wird wird,
                    //dann hat das Cookie kein Ablaufsdatum
                    setcookie('email', $email);
                    setcookie('id', $id);

                    //setzen der Variabeln
                    $_SESSION['id'] = $id;
                    $_SESSION['email'] = $email;

                    $hauptseite = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
                    header('Location' . $hauptseite);


                }else{
                    echo "Ihr Passwort ist falsch";
                    $formular_anzeigen = true;
                }

            }else{
                echo "Ihre Email-Adresse ist nicht registriert.";
                $formular_anzeigen = true;
            }

        }

    }

    if($formular_anzeigen){

?>
    
    <h2>Login</h2>
    <form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

        <p>Solltest du noch nicht registiert sein, dann klicke hier</p>
        
        <fieldset>
            <legend>Anmeldedaten:</legend>
            <label for="benutzername">Benutzername:</label>
            <input type="text" id="benutzername" name="benutzername" value="" required /><br />
            <label for="passwort">Passwort:</label>
            <input type="password" id="passwort" name="passwort" required /><br />
        </fieldset><br />
        <input type="submit" value="Login" name="login" />

    </form>

<?php
}
}
?>

</body>
</html>