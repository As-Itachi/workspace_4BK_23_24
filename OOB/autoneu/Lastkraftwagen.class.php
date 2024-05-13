<?php
    require_once("Auto.class.php");

    class Lastkraftwagen extends Auto{
        
        private $hoechstgeschwindigkeit = 120;

        public function __construct(int $geschwindigkeit){
            parent::__construct($geschwindigkeit);
            $this->hoechstgeschwindigkeit;
        }

        public function beschleunigen(int $beschleunige){
            if ($this->getGeschwindigkeit() >= $this->hoechstgeschwindigkeit) {
                $this->setGeschwindigkeit($this->getGeschwindigkeit() + $beschleunige);
            }else{
                $this->setGeschwindigkeit($this->hoechstgeschwindigkeit);
            }
        }
        
        public function bremsen(int $bremse){
            if($this->getGeschwindigkeit() >= $bremse){
                $this->setGeschwindigkeit($this->getGeschwindigkeit() - $bremse);
            }else{
                $this->setGeschwindigkeit(0);
            }
        }

    }
?>