<!------------------------ logout.php ------------------------->

<?php
session_start(); // Démarrer la session
session_destroy(); // Détruit la session
header("Location: index.php"); // Redirige vers la page d'accueil
exit(); // Arrête le script
?>
