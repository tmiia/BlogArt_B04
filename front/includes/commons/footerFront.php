<?php
require_once __DIR__ . '/../../../connect/config.php';
?>
<link href="style.css" rel="stylesheet">

<footer>
    <div class="connect_admin">
        <a href="<?=$_SERVER['DOCUMENT_ROOT']?>/connexionAdmin.php">Connexion Administrateur</a>
        <span>@ 2022 Nebulab. All rights reserved</span>
    </div> 

    <div class="revenir_haut">
        <a href="#top">
            <img src="<?=$_SERVER['DOCUMENT_ROOT']?>/front/assets/flecheHautFooter.svg" alt="flèche haut">
            <!-- <img src="../front/assets/flecheHautFooter.svg" alt="flèche haut"> -->

            Revenir en haut
        </a>
    </div>

    <div class="liens">
        <a href="<?=$_SERVER['DOCUMENT_ROOT']?>/front/mentionlegal.php">Mentions légales</a>
        <a href="<?=$_SERVER['DOCUMENT_ROOT']?>/front/CGU.php">CGU</a>
        <a href="<?=$_SERVER['DOCUMENT_ROOT']?>/index.php">Accueil</a>
    </div>

</footer>