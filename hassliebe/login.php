<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <?php

        if(isset($_POST['login'])){

            if(empty($_POST['benutzername'] || empty($_POST['passwort']))){

                echo "Bitte füllen Sie das Formulat vollständig aus";

            }else{

                $auth_benutzername = $_POST['benutzername'];
                $auth_passwort = $_POST['passwort'];

                require_once("db.php");

                try{

                    $statement = $pdo->prepare("SELECT benutzername, passwort FROM hassliebe1 WHERE benutzername = :benutzername");
                    $statement->bindParam(":benutzername", $auth_benutzername);
                    $statement->execute();

                }catch(PDOException $z){
                    die("Der Anmeldeversuch ist gescheitert");
                }

                if($statement->rowCount() > 0){

                    $row = $statement->fetch();
                    $passwortGS = $row['passwort'];

                    echo "Auth Benutzername: $auth_benutzername<br>";
                    echo "Auth Passwort: $auth_passwort<br>";
                    echo "Passwort aus der Datenbank: $passwortGS<br>";

                    if(password_verify($auth_passwort, $passwortGS)){

                        if(password_needs_rehash($passwortGS, PASSWORD_DEFAULT)){
                            
                            $nPWD = password_hash($auth_passwort, PASSWORD_DEFAULT);

                            try{

                                $statement = $pdo->prepare("UPDATE hassliebe1 SET passwort = :passwort WHERE benutzername = :benutzername");
                                $statement->bindParam(':passwort', $nPWD);
                                $statement->bindParam(':benutzername', $auth_benutzername);
                                $statement->execute();

                            }catch(PDOException $i){
                                die("Fehler beim Speichern des neuen Hash wertes aufgetreten");
                            }

                        }

                        echo "Login erfolgreich";

                    }else{
                        echo "Ihr Passwort ist falsch";
                    }

                }else{
                    echo "Ihr Benutzername ist nicht registiert";
                }

            }
           
        }else{

    ?>
    
<form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

    <fieldset>

        <legend>Anmeldedaten:</legend>

        <label for="benutzername">Benutzername: </label>
        <input type="text" id="benutzername" name="benutzername" required /> <br>

        <label for="passwort">Passwort: </label>
        <input type="password" id="passwort" name="passwort" required /> <br>
    
    </fieldset>

    <input type="submit" value="Login" name="login" />

</form>
<?php
    }
?>

</body>
</html>