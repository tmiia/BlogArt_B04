<?php
////////////////////////////////////////////////////////////
//
//  CRUD comment (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deletecomment.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Del logique du comment
//
// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe comment
require_once __DIR__ . '/../../class_crud/comment.class.php';
// Instanciation de la classe comment
$moncommentaire = NEW comment();
// Instanciation de la classe comment


// Gestion des erreurs de saisie
$erreur = false;

// Init variables form
include __DIR__ . '/initcomment.php';

// Gestion du $_SERVER["REQUEST_METHOD"] => En GET
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    


    // create / update effective du comment
    
    $moncommentaire->delete($_GET['id1'], $_GET['id2']);
    header("Location: ./comment.php");





}   // Fin if ($_SERVER["REQUEST_METHOD"] === "GET")
?>

