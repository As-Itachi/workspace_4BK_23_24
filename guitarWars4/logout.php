<?php
session_start();
session_destroy();
header("Location: guitarWars2.php");
exit();
?>
