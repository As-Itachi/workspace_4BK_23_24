<?php

    abstract class Standardzimmer{

        protected $abkuerzung = "";
        private $anzBetten = 0;
        private $groesse = 0;
        protected $preis = 0;
        protected $ausstattung = "";

        public function __construct(String $abkuerzung, int $anzBetten, int $groesse, float $preis, String $ausstattung)
        {
            $this->abkuerzung = $abkuerzung;
            $this->anzBetten = $anzBetten;
            $this->groesse = $groesse;
            $this->preis = $preis;
            $this->ausstattung = $ausstattung;
        }
        
        abstract public function berechnePreis(int $anzTage);

        public function getPreis() {
            return $this->preis;
        }

        public function getAusstattung() {
            return $this->ausstattung;
        }
    }

?>