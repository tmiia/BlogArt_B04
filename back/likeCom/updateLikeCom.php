<?php
////////////////////////////////////////////////////////////
//
//  CRUD likecom (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updatelikecom.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/../../util/ctrlSaisies.php';

// Insertion classe likecom

// Instanciation de la classe likecom



// Gestion des erreurs de saisie
$erreur = false;

// Init variables form
include ROOT . '/initlikecom.php';

// Gestion du $_SERVER["REQUEST_METHOD"] => En GET
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // Ctrl saisies form


    // Insert / Update => like



}   // Fin if ($_SERVER["REQUEST_METHOD"] === "GET")
