<?php
    require_once("Auto.class.php");
    require_once("Sportwagen.class.php");
    require_once("Lastkraftwagen.class.php");

    class Ausgabe{

        public function __construct(){
            $this->main();
        }

        private function main(){
           //$auto1 = new Auto(100);
            $auto2 = new Sportwagen(100);
            $auto3 = new Lastkraftwagen(100);

            //Auto1
            /*echo"<h2>Auto 1</h2>";
            echo "Die Geschwindigkeit des Auto1 ist: " . $auto1->getGeschwindigkeit(). " km/h <br>";
            
            $auto1->beschleunigen(20);
            echo "Nach der Beschleunigung ist die Geschwindigkeit: " .$auto1->getGeschwindigkeit(). " km/h <br>";

            $auto1->bremsen(130);
            echo "Nach dem Bremsen ist die Geschwindigkeit: " .$auto1->getGeschwindigkeit(). " km/h <br>";
            */
            //Auto2
            echo"<h2>Auto 2</h2>";
            echo "<br>Die Geschwindigkeit des Auto2 ist: " . $auto2->getGeschwindigkeit(). " km/h <br>";
            
            $auto2->beschleunigen(100);
            echo "Nach der Beschleunigung ist die Geschwindigkeit: " .$auto2->getGeschwindigkeit(). " km/h <br>";

            $auto2->bremsen(50);
            echo "Nach dem Bremsen ist die Geschwindigkeit: " .$auto2->getGeschwindigkeit(). " km/h <br>";

            //Auto3
            echo"<h2>Auto 3</h2>";
            echo "<br>Die Geschwindigkeit des Auto3 ist: " . $auto3->getGeschwindigkeit(). " km/h <br>";
            
            $auto3->beschleunigen(50);
            echo "Nach der Beschleunigung ist die Geschwindigkeit: " .$auto3->getGeschwindigkeit(). " km/h <br>";

            $auto3->bremsen(40);
            echo "Nach dem Bremsen ist die Geschwindigkeit: " .$auto3->getGeschwindigkeit(). " km/h <br>";

        }

        
    }//end class

    new Ausgabe();

?>