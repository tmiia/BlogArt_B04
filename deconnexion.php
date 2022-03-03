<?php
setcookie('eMailMemb', "", time() - 3000600);
setcookie('pseudoMemb', "",time() - 3000600);
header('Location: /BLOGART22/front/home.php');
