<?php

require_once('Standardzimmer.class.php');
require_once('Sparzimmer.class.php');
require_once('Luxuszimmer.class.php');
require_once('db.php');

class Test
{

  public function __construct()
  {
    $this->main();
  }

  private function main()
  {

    $spar1_data = array(
      'abkuerzung' => 'SZ',
      'anzBetten' => 2,
      'groesse' => 20,
      'preis' => 50,
      'ausstattung' => 'Dusche/WC, TV'
    );

    try {
      insertSparzimmer($spar1_data);

      echo "Sparzimmerdaten erfolgreich in die Datenbank übertragen!\n";
    } catch (PDOException $e) {
      echo "Fehler beim Übertragen der Sparzimmerdaten: " . $e->getMessage();
    }

    $spar1 = new Sparzimmer(0, "SZ", 2, 20, 50.00, "Dusche/WC, TV");
    $luxus1 = new Luxuszimmer(true, "LX", 2, 30, 80.00, "Dusche/WC, TV, Minibar");

    echo "Sparzimmer 1 (8 Tage):\n";
    echo "  - Preis pro Nacht: " . $spar1->getPreis() . "€\n";
    echo "  - Preis für 8 Tage: " . $spar1->berechnePreis(8) . "€\n";

    echo "\nSparzimmer 1 (14 Tage):\n";
    echo "  - Preis pro Nacht: " . $spar1->getPreis() . "€\n";
    echo "  - Preis für 14 Tage: " . $spar1->berechnePreis(14) . "€\n";

    echo "\nLuxuszimmer 1 (15 Tage):\n";
    echo "  - Preis pro Nacht: " . $luxus1->getPreis() . "€\n";
    echo "  - Preis für 15 Tage: " . $luxus1->berechnePreis(15) . "€\n";
  }
}

new Test();

?>
