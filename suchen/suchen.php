
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    if (isset($_POST['submit'])) {
        if (empty($_POST['job'])) {
            echo "<h3>Bitte füllen Sie zuerst alle Pflichtfelder aus</h3>";
        } else {
            $job = $_POST['job'];

            try{
                require_once("db.php");

                $sql = $pdo->prepare("SELECT * FROM riskantejobs WHERE bezeichnung LIKE :beschreibung");
                $job = "%" . $jobs . "%";
                $sql->bindParam(":beschreibung", "$job");
                $sql->execute();

            }catch(PDOException $e){
                echo $e->getMessage();
            }
            echo "Test";
            try{
                if ($sql->rowCount() > 0) {
                    while ($row = $sql->fetch()) {
                        echo "<div class='job-ausgabe'>";
                        echo "<h3>" . $row['bezeichnung'] . "</h3>";
                        echo "<p>" . $row['beschreibung'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<h3>Keine Jobs gefunden!</h3>";
                }
            }catch(PDOException $y){
                echo $y->getMessage();
            }
            
        }
    } else {

    ?>

        <img src="rj_logo.jpg">

        <form>

            <p><img style="float: left;" src="rj_feuerwehr.jpg" /></p>

            <h2>Riskante Job - Suche</h2>

            <label for="job">Suchen Sie ihren Traumjob</label>
            <input type="text" name="job" id="job" required> <br>

            <input type="submit" value="submit" name="submit"> <br>

        </form>

    <?php
    }
    ?>

</body>

</html>