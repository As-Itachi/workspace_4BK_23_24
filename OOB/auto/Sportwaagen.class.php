<?php

    require_once("Auto.class.php");
    class Sportwagen extends Auto
    {

        private $hoechstgeschwindigkeit = 250;

        public function __construct(int $geschwindigkeit, int $hoechstgeschwindigkeit)
        {
            parent::__construct($geschwindigkeit);
            $this->hoechstgeschwindigkeit = $hoechstgeschwindigkeit;
        }

        public function setHoechstgeschwindigkeit(int $hoechstgeschwindigkeit){
            $this->hoechstgeschwindigkeit = $hoechstgeschwindigkeit;
        }

        public function getHoechstgeschwinigkeit() :int{
            return $this->hoechstgeschwindigkeit;
        }

        public function beschleunigen($geschwindigkeit)
        {
            $this->setGeschwindigkeit($this->getGeschwindigkeit() + $geschwindigkeit);

            if ($this->getGeschwindigkeit() > $this->hoechstgeschwindigkeit) {
                $this->setGeschwindigkeit($this->hoechstgeschwindigkeit);
                echo "Die maximale Geschwindigkeit des Sportwagens beträgt {$this->hoechstgeschwindigkeit}";
            }
        }
    }

?>