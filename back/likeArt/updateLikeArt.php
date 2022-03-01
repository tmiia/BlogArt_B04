<?php
////////////////////////////////////////////////////////////
//
//  CRUD LIKEART (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateLikeArt.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Likeart

// Instanciation de la classe Likeart




// Gestion des erreurs de saisie
$erreur = false;

// Init variables form
include __DIR__ . '/initLikeArt.php';

// Gestion du $_SERVER["REQUEST_METHOD"] => En GET
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // Ctrl saisies form

var_dump($_GET);
exit;
    // Insert / update likeart
    if (isset($_GET['id1']) and $_GET['id1'] != '' and isset($_GET['id2']) and $_GET['id2'] != '') {

        $numMemb = ctrlSaisies($_GET['id1']);
        $numArt = ctrlSaisies($_GET['id2']);
    }




}   // Fin if ($_SERVER["REQUEST_METHOD"] === "GET")
