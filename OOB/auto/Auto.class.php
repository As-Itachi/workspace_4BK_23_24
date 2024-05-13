<?php

    class Auto
    {
        private $geschwindigkeit = 0;

        public function __construct(int $geschwindigkeit)
        {
            $this->geschwindigkeit = $geschwindigkeit;
        }

        public function setGeschwindigkeit(int $geschwindigkeit)
        {
            $this->geschwindigkeit = $geschwindigkeit;
        }

        public function getGeschwindigkeit() :int 
        {
            return $this->geschwindigkeit;
        }

        public function beschleunigen($delta)
        {
            $this->geschwindigkeit += $delta;
            echo "Die beschleunigte Geschwindigkeit beträgt " . $this->geschwindigkeit . " km/h";
        }

        public function bremsen($delta)
        {
            $this->geschwindigkeit -= $delta;

            if ($this->geschwindigkeit < 0) {
                $this->geschwindigkeit = 0;
            }

            echo "Die gebremste Geschwindigkeit beträgt " . $this->geschwindigkeit . " km/h";
        }
    }

?>