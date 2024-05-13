<?php

class Rechteck{

    private $laenge = 0;
    private $breite = 0;

    //Konstruktor 
    public function __construct(int $laenge, int $breite){
        $this -> laenge = $laenge;
        $this -> breite = $breite;
    }

    //setter/getter
    public function getLaenge() : int{
        return $this -> laenge;
    }

    public function setLaenge(int $laenge){
        $this -> laenge = $laenge;
    }

    public function getBreite() : int {
        return $this -> breite;
    }

    public function setBreite(int $breite){
        $this -> breite = $breite;
    }

    public function berechneFlaeche() : int{
        return ($this->laenge * $this->breite);
    }

    public function berechenUmfang() : int {
        return ($this->laenge*2 + $this->breite*2);
    }

}

?>