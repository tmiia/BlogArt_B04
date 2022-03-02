<?php
////////////////////////////////////////////////////////////
//
//  CRUD LIKEART (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateLikeArt.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/util/ctrlSaisies.php';

// Insertion classe Likeart
require_once ROOT . '/CLASS_CRUD/likeart.class.php';
$monLikeArt = new LIKEART();



// Gestion des erreurs de saisie
$erreur = false;

// Init variables form
include ROOT . '/back/likeArt/initLikeArt.php';

// Gestion du $_SERVER["REQUEST_METHOD"] => En GET
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // Ctrl saisies form

    // Insert / update likeart
    if (isset($_GET['id1']) and $_GET['id1'] != '' and isset($_GET['id2']) and $_GET['id2'] != '') {

        $numMemb = intval(ctrlSaisies($_GET['id1']));
        $numArt = intval(ctrlSaisies($_GET['id2']));

        $likeA = $monLikeArt->get_1LikeArt($numMemb, $numArt)['likeA'];

        if($likeA == 1){
            $likeA = 0;
        }
        else{
            $likeA = 1;
        }

        $monLikeArt->update($numMemb, $numArt, $likeA);
        header("Location: ./likeArt.php");
    }
    else{
        $erreur = true;
        $errSaisies =  "Erreur !";
    }




}   // Fin if ($_SERVER["REQUEST_METHOD"] === "GET")
