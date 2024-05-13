<?php

   abstract class Auto{
        private $geschwindigkeit = 0;


        public function __construct(int $geschwindigkeit){
            $this -> geschwindigkeit = $geschwindigkeit;

    }


    public function getGeschwindigkeit() : int {
        return $this -> geschwindigkeit;
    }

    public function setGeschwindigkeit(int $neue_geschwindigkeit){
        $this -> geschwindigkeit = $neue_geschwindigkeit;
    }


    abstract public function bremsen(int $bremse);

    abstract public function beschleunigen(int $beschleunige);

}
?>