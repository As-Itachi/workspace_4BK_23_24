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

        if(empty($_POST['email'] || empty($_POST['passwort'] || empty($_POST['passwortW'])))){

            echo "Bitte füllen sie das Formular vollständig aus";

        }else{

            $auth_email = htmlspecialchars(trim($_POST['email']));
            $auth_pwd = htmlspecialchars(trim($_POST['passwort']));
            $pwd_hash = password_hash($auth_pwd, PASSWORD_DEFAULT);

            try{

                require_once("dbconnect.php");

                echo $auth_email;
                echo $pwd_hash;

                $statement = $pdo->prepare("SELECT * FROM guitarwars1 WHERE email= :email");

                $statement->bindParam("email", $auth_email);
                $statement->execute();

                    if ($statement->rowCount() > 0) {
                        echo '<br> Der Email ist bereits vergeben' . "<br>";
                    }

                $statement = $pdo->prepare("INSERT INTO guitarwars1 (email, passwort) VALUES (:email, :passwort)");

                $statement->bindParam(":email", $auth_email);
                $statement->bindParam(":passwort", $pwd_hash);
                $statement->execute();

                

                echo "Registierung erfolgreich";

            }catch(PDOException $x){
                die("Fehler beim Registieren");
            }
        }

    }else{

    ?>

    <h2>Guitar Wars - Registrierung</h2>

<form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

    <fieldset>
        <legend>Anmeldedaten:</legend>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="" required /><br />
        <label for="passwort">Passwort:</label>
        <input type="password" id="passwort" name="passwort" required /><br />
        <label for="passwortW">Passwort: Wiederholung</label>
        <input type="password" id="passwortW" name="passwortW" required /><br />
    </fieldset><br />
        <input type="submit" value="Registrieren" name="submit" />

</form>

<?php
    }
?>

</body>
</html>