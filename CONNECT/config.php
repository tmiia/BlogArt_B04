<?php
// nom de votre serveur (ou 127.0.0.1)
$hostBD = "localhost";
// nom BD
$nomBD = "BLOGART22";
// Serveur
// Avec encodage UTF8
$serverBD = "mysql:dbname=$nomBD;host=$hostBD;charset=utf8";

// nom utilisateur de connexion à la BDD
$userBD = 'root';         // Votre login
// mot de passe de connexion à la BDD
$passBD = '';         // Votre Pass

if(defined(ROOT) == false) {
    define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/blogart22');
}

if(defined(ROOTFRONT) == false) {
    define('ROOTFRONT', "http://" . $_SERVER['SERVER_NAME'] . '/blogart22'); 
}



// BD A CHANGER QUAND ON FERA L HEBERGEMENT



// // nom de votre serveur (ou 127.0.0.1)
// $hostBD = "plateforme-mmi.iut.u-bordeaux-montaigne.fr";
// // nom BD
// $nomBD = "db_mmi_04";
// // Serveur
// // Avec encodage UTF8
// $serverBD = "mysql:dbname=$nomBD;host=$hostBD;charset=utf8";

// // nom utilisateur de connexion à la BDD
// $userBD = 'etummiuser_db_04';         // Votre login
// // mot de passe de connexion à la BDD
// $passBD = 'mmi-etu';         // Votre Pass

// if(defined(ROOT) == false) {
//     define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/etu-mmi-04');
// }


// if(defined(ROOTFRONT) == false) {
// define('ROOTFRONT', "http://" . $_SERVER['SERVER_NAME'] . '/etu-mmi-04'); 
// }