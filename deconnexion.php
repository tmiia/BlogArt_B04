<?php
require_once './CONNECT/database.php';
setcookie('eMailMemb', "", time() - 3000600, "/");
setcookie('pseudoMemb', "",time() - 3000600, "/");
header('Location: '. ROOTFRONT .'/front/home.php');