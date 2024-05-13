<?php

    session_start();
    if(isset($_SESSION['email'])){
        //Session varibale müssen gelöscht werden
        $_SESSION = array(); //alle Sessionvariable löschem
        session_destroy(); //Session löschen
    }

    //Beim ausloogen werden die Cookies gelöscht
    setcookie('email', '', time()-3600); //einen vergangennen Zeitpunkt setzen den Cookie
    setcookie('id', '', time()-3600);

    header('Location: index.php');

?>
