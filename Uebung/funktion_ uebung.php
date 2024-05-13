<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Übung: Brechung mithilfe von Funktionen</h1>

    <?php

    function addiere($zahl1, $zahl2, $zahl3OP = 0){
        $ergebnis = $zahl1 + $zahl2 + $zahl3OP;
        echo "Die Summe von $zahl1, $zahl2 und $zahl3OP ist: $ergebnis<br>";
    }

    function multipliziere($zahl1, $zahl2, $zahl3OP = 1){
        $ergebnis = $zahl1 * $zahl2 * $zahl3OP;
        echo "Das Produkt von $zahl1, $zahl2 und $zahl3OP ist: $ergebnis<br>";
    }

    addiere(8,4,2);
    multipliziere(8,4,2);
    addiere(8,4);
    multipliziere(8,4,1);
    
    ?>

</body>
</html>