<?php
/*
*   Script : ajaxEtudiant.php
*   Example : 2 listbox dynamiques liées via AJAX
*/
// Mode DEV

require_once __DIR__ . '/../../../util/utilErrOn.php';

// connexion
require_once __DIR__ . '/../../../CONNECT/database.php';

// Insertion classe Angle
require_once __DIR__ . '/../../../CLASS_CRUD/article.class.php';

// Instanciation de la classe angle
$monArticle = new ARTICLE();

require_once __DIR__ . '/../../../CLASS_CRUD/thematique.class.php';
// Instanciation de la classe MotCle
$maThematique = new THEMATIQUE();


?>
<?php

    $numThem =  $_REQUEST["numThem"];
    $allArticle = $monArticle->get_AllArticlesByNumThem($numThem);

    if (isset($numThem)) {
                for($i = 0; $i <count($allArticle); $i++){ ?>

        <a class="article_recent" href="viewArticle.php?id=<?=$allArticle[$i]['numArt']?>">
        <div class="article_illustration" style="background-image: url(../uploads/<?=htmlspecialchars($allArticle[$i]['urlPhotArt']) ?>);"></div>
        <div class="article_recent_top">
            <h5><?= $allArticle[$i]['libTitrArt'] ?></h5>
            <p><?= $allArticle[$i]['libChapoArt'] ?></p>
        </div>
        <div class="article_recent_bot">
            <div class="article_like"><i class="fa fa-heart-o"></i></div>
            <div class="article_btn">Consulter l'article</div>
        </div>
        </a>
    <?php 
    }
        ?>
        
    <?php  } else{ 
        echo("too bad");
}
    ?>

<?php
