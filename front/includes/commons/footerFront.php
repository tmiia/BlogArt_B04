<?php
require_once __DIR__ . '/../../../connect/config.php';
?>
<link href="style.css" rel="stylesheet">

<footer>
    <div class="connect_admin">
        <a href="<?=ROOTFRONT?>/connexionAdmin.php">Connexion Administrateur</a>
        <span>@ 2022 Nebulab. All rights reserved</span>
    </div> 

    <div class="revenir_haut">
        <a href="#top">
            <img src="<?=ROOTFRONT?>/front/assets/flecheHautFooter.svg" alt="flèche haut">
            <!-- <img src="../front/assets/flecheHautFooter.svg" alt="flèche haut"> -->

            Revenir en haut
        </a>
    </div>

    <div class="liens">
        <a href="<?=ROOTFRONT?>/front/mentionlegal.php">Mentions légales</a>
        <a href="<?=ROOTFRONT?>/front/CGU.php">CGU</a>
        <a href="<?=ROOTFRONT?>/index.php">Accueil</a>
    </div>

</footer>