
<link rel="stylesheet" type="text/css" href="login.css" />

<?php
session_start();
require_once('dbconnect.php');
require_once('appKonstanten.php');

if (isset($_POST['submit'])) {
    $benutzername = $_POST['benutzername'];
    $passwort = $_POST['passwort'];

    if ($benutzername == $admin_benutzername && $passwort == $admin_passwort) {
        $_SESSION['angemeldet'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $fehlermeldung = "Falsche Anmeldeinformationen. Bitte versuchen Sie es erneut.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>

<?php
if (isset($fehlermeldung)) {
    echo "<p>$fehlermeldung</p>";
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="benutzername">Benutzername:</label>
    <input type="text" name="benutzername" required><br>

    <label for="passwort">Passwort:</label>
    <input type="password" name="passwort" required><br>

    <input type="submit" name="submit" value="Anmelden">
</form>

</body>
</html>
