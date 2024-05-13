<?php

require_once("Rechteck.class.php");
class Quader extends Rechteck{

   private $hoehe = 0;
   
   public function __construct(int $laenge, int $breite, int $hoehe){
        parent::__construct($laenge, $breite);
        $this->hoehe = $hoehe; 
   }

   public function setHoehe(int $hoehe){
        $this->hoehe = $hoehe; 
   }

   public function getHoehe() : int{
        return $this->hoehe;
   }

   public function berecheVolumen() : int{
        return $this->getLaenge() * $this->getBreite() * $this->getHoehe();
   }

   public function grundFlaeche() :int{
          return parent::berechneFlaeche();  
   }

}

?>