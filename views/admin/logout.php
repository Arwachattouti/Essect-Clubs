<?php
session_start(); 
session_unset();
session_destroy();
header("Location: ../visiteur/listeclubs.php");
exit();  
?>
