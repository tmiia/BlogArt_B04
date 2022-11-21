<?php
// nom de votre serveur (ou 127.0.0.1)
$hostBD = "au-bord-des-rues.osc-fr1.scalingo.io/";
// nom BD
$nomBD = "au_bord_des_1939";
// Serveur
// Avec encodage UTF8
$serverBD = "mysql:dbname=$nomBD;host=$hostBD;charset=utf8";

// nom utilisateur de connexion à la bdd
$userBD = 'au_bord_des_1939';         // Votre login
// mot de passe de connexion à la bdd
$passBD = '';         // Votre Pass


define('ROOT', $_SERVER['DOCUMENT_ROOT']);

define('ROOTFRONT', "http://" . $_SERVER['SERVER_NAME']); 
