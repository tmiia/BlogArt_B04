<?php
ini_set('display_errors','on');
ini_set('display_startup_errors','on');
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/connect/config.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/util/utilErrOn.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/connect/database.php';
global $db;

if(isset($_POST['like'])){

  /* ----------------------------------------------------------------- */
  $numArt = $_POST['numArt'];
  $numMemb = $_POST['membre'];
  $query = "SELECT * FROM likeart WHERE numArt = ? AND numMemb = ?;";
  $resultL4 = $db->prepare($query);
  $resultL4->execute([$numArt, $numMemb]);
  $rowCount = $resultL4->rowCount();
  /* ----------------------------------------------------------------- */

    if($rowCount > 0){
      $query = "DELETE FROM likeart WHERE numArt = ? AND numMemb = ?;";
      $resultL4 = $db->prepare($query);
      $resultL4->execute([$numArt, $numMemb]);
    }else{
      $query = "INSERT INTO likeart (numArt, numMemb) VALUES (?, ?);";
      $resultL4 = $db->prepare($query);
      $resultL4->execute([$numArt, $numMemb]);
    }
}
  /* ----------------------------------------------------------------- */
