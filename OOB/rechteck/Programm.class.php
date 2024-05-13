<?php
//*Rechteckklasse einbinden damit Objekte davon erzeugt werden können
require_once("Rechteck.class.php");
require_once("Quader.class.php");

class Programm{

    public function __construct(){
        $this->main();
    }

    private function main(){

        //Neues Rechteck-Objekt erzeugen
        $r1 = new Rechteck(20,10);
        echo "Rechteck1 mit einer Laenge von " . $r1->getLaenge(). " und einer Breite von " . $r1->getBreite();
        echo "Die Flaeche beträgt " . $r1->berechneFlaeche(). " der Umfang betraegt " . $r1->berechenUmfang(); 

        //!Kopieren eines Objektes immer mit clone, da dann ein Abild des zweiten Objekts im Speicher abgelegt wird
        $r2 = clone $r1;
        
        //?Bessere Ausageb einbauen
        $q1 = new Quader(10,10,10);
        echo "Volumen: " . $q1->berecheVolumen();
        echo "Flaeche: " . $q1->grundFlaeche();

    }

}//end class

new Programm(); //*Eerzeugt ein Objekt der Klasse Programm und führt automatisch die main-Methode aus.

?>