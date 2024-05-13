<?php

    require_once('Standardzimmer.class.php');
    class Luxuszimmer extends Standardzimmer{

        protected $sauna = false;

        public function __construct(bool $sauna, String $abkuerzung, int $anzBetten, int $groesse, float $preis, String $ausstattung)
        {
            parent::__construct($abkuerzung, $anzBetten, $groesse, $preis, $ausstattung);
            $this->sauna;
        }

        public function berechnePreis($anzTage) {
            
            $rabatt = 0;
            if ($anzTage >= 7) {
              $rabatt = 0.2; 
            }else if($anzTage){
                $rabatt =0.3;
            }

            $rabattPreis = $this->preis * (1 - $rabatt);
        
            return $rabattPreis;
        }
        
    }

?>