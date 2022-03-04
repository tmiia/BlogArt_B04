<?php
require_once './CONNECT/database.php';
if(isset($_COOKIE['eMailMemb'])){
    setcookie('eMailMemb', "", time() - 3000600, "/");
    setcookie('pseudoMemb', "",time() - 3000600, "/");
}
elseif(isset($_COOKIE['pseudoUser'])){
    setcookie('pseudoUser', "", time() - 3000600, "/");
    setcookie('passUser', "",time() - 3000600, "/");
}
header('Location: '. ROOTFRONT .'/front/home.php');