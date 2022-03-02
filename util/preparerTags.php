<?php
///////////////////////////////////////////////////////
//
//  Script : preparerTags.php
//  Remplace espace par % entre tags
//
///////////////////////////////////////////////////////  

// Mode DEV
require_once ROOT . '/util/utilErrOn.php';

function preparerTags($tags){

  $nbcar = strlen($tags);
  $formatTags = '';

  for ($i = 0; $i < $nbcar; $i++) {
    if ($tags[$i] == ' ') {
        $formatTags .= '%';
    } else {
        $formatTags .= $tags[$i];
    }
  } // End of for
  return $formatTags;
}
