<?php

    require_once("Auto.class.php");
    class LKW extends Auto
    {

        private $hoechstgeschwindigkeit = 120;

        public function __construct(int $hoechstgeschwindigkeit, int $geschwindigkeit)
        {
            parent::__construct($geschwindigkeit);
            $this->setHoechstgeschwindigkeit($hoechstgeschwindigkeit);
        }

        public function setHoechstgeschwindigkeit(int $hoechstgeschwindigkeit)
        {
            if ($hoechstgeschwindigkeit <= 120) {
                $this->hoechstgeschwindigkeit = $hoechstgeschwindigkeit;
            } else {
                echo "Die zulässige Höchstgeschwindigkeit für LKWs beträgt". $hoechstgeschwindigkeit . PHP_EOL;
            }
        }

        public function getHoechstgeschwinigkeit(): int
        {
            return $this->hoechstgeschwindigkeit;
        }

        public function beschleunigen($geschwindigkeit)
        {
            $neueGeschwindigkeit = $this->getGeschwindigkeit() + $geschwindigkeit;

            if ($neueGeschwindigkeit > $this->hoechstgeschwindigkeit) {
                $this->setGeschwindigkeit($this->hoechstgeschwindigkeit);
                echo "Die maximale Geschwindigkeit des LKWs beträgt " . $this->hoechstgeschwindigkeit . " km/h." . PHP_EOL;
            } else {
                $this->setGeschwindigkeit($neueGeschwindigkeit);
            }
        }
    }
?>