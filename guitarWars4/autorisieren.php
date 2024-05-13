<?php
  //Benutzername und Passwort für die Authentifizierung
  $benutzername = 'danijel';
  $passwort = 'danijel';

  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
    ($_SERVER['PHP_AUTH_USER'] != $benutzername) || ($_SERVER['PHP_AUTH_PW'] != $passwort)) {
    // Zugangsdaten falsch, Authenfizizierungs-Header senden
	//Gibt der Benutzer eine falsche Benutzername-Passwort-Kombination ein, 
	//wird einfach wieder das Authenfizizierungsfenster angezeigt.
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="GuitarWars"');
	//basic realm -> Benutzername u Passwort bleiben im Browser gespeichert, 
	//damit bei weiteren Authentifizierungsheadern für die gleiche 
	//Zone das Authenfizizierungsfenster nicht erneut angezeigt werden muss.
	//Dazu einfach in allen zusammengehörigen Seiten das gleiche Realm
	//für die Authenfizizierungs-Header	angeben.
	
	//exit wird nur ausgeführt, wenn der Benutzer auf Abbrechen klickt
	//-> admin.php wird nicht angezeigt - das Skript bricht ab
	//Hat der Benutzer falsche Daten eingegeben, dann wird 
	//der Header erneut gesendet, d.h. das Authenfizizierungsfenster
	//erneut angezeigt - exit wird nicht ausgeführt!
    exit('<h2>Guitar Wars</h2>Tut uns wirklich Leid, aber auf diese Seite können ' .
         'Sie nur mit den richtigen Zugangsdaten zugreifen.'); 
  }
  //Wenn Benutzername u. Passwort korrekt eingegeben wurden,
  //dann wird die Admin-Seite angezeigt.
?>
<!-- 
<html>
Es wird kein HTML-Code an den Browser geliefert, 
bevor die Header versendet und verarbeitet wurden.
</html>
-->