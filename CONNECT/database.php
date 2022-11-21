<?php
// CONNEXION bdd
// Variables connexion
require_once ROOT . 'config.php';

try {
  $db = new PDO($serverBD, $userBD, $passBD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch (PDOException $err) {
  die('Echec connexion BLOGART : ' . $err->getMessage());
}
