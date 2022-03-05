<?php
// nom de votre serveur (ou 127.0.0.1)
$hostBD = "plateforme-mmi.iut.u-bordeaux-montaigne.fr";
// nom BD
$nomBD = "db_mmi_04";
// Serveur
// Avec encodage UTF8
$serverBD = "mysql:dbname=$nomBD;host=$hostBD;charset=utf8";

// nom utilisateur de connexion à la bdd
$userBD = 'etummiuser_db_04';         // Votre login
// mot de passe de connexion à la bdd
$passBD = 'mmi-etu';         // Votre Pass


define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/etu-mmi-04');

define('ROOTFRONT', "http://" . $_SERVER['SERVER_NAME'] . '/etu-mmi-04'); 
