<?php

    require_once("Auto.class.php");
    require_once("LKW.class.php");
    require_once("Sportwaagen.class.php");

    class Programm {

        public function __construct() {
            $this->main();
        }

        private function main() {
            /*
            $pkw = new Auto(100);
            $pkw->beschleunigen(20);
            $pkw->bremsen(15);
            $pkw->bremsen(60);
            */
            echo "<br>";

            $sportwagen = new Sportwagen(100, 250);
            echo "Sportwaagen";
            $sportwagen->beschleunigen(50);
            $sportwagen->bremsen(20);
            $sportwagen->beschleunigen(100);
            $sportwagen->bremsen(45);

            echo "<br>";

            $lkw = new LKW(100, 120);

            echo $lkw->getGeschwindigkeit();

            $lkw->beschleunigen(20);

            echo $lkw->getGeschwindigkeit();

            $lkw->bremsen(15);
            $lkw->beschleunigen(30);
            $lkw->bremsen(15);
        }
    }

    new Programm();

?>
