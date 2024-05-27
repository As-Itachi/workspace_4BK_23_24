<?php

if (isset($_POST['submit'])) {
    if (empty($_POST['job'])) {
        echo "<h3>Bitte füllen Sie zuerst alle Pflichtfelder aus</h3>";
    } else {
        $job = $_POST['job'];

        try {
            require_once("db.php");

            $test ="";

            $searchTerms = explode(' ', $job);

            $sql = $pdo->prepare("SELECT * FROM riskantejobs WHERE :schleife");

            //$sql->bindParam(":beschreibung1", '%' . $searchTerms[0] . '%');
            for ($i = 0; $i < count($searchTerms); $i++) {
                $test .= " beschreibung LIKE " . ($searchTerms[$i]) .  " OR ";
            }
            echo $test;
            $sql->bindParam(":schleife", $test);
            $sql->execute();

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
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
} else {

?>

    <img src="rj_logo.jpg">

    <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

        <p><img style="float: left;" src="rj_feuerwehr.jpg" /></p>

        <h2>Riskante Job - Suche</h2>

        <label for="job">Suchen Sie ihren Traumjob</label>
        <input type="text" name="job" id="job"> <br>

        <input type="submit" value="submit" name="submit"> <br>

    </form>

<?php
}
?>