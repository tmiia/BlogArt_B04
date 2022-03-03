<?php
require_once __DIR__ . '/../CLASS_CRUD/article.class.php';
$monArticle = new ARTICLE();


if (isset($_GET['id']) and $_GET['id'] != '') {
    $id = $_GET['id'];

    $query = $monArticle->get_1Article($id);

    if($query) {
        $libTitrArt = $query['libTitrArt'];
        $dtCreArt = $query['dtCreArt'];
        $libChapoArt = $query['libChapoArt'];
        $libAccrochArt = $query['libAccrochArt'];
        $parag1Art = $query['parag1Art'];
        $libSsTitr1Art = $query['libSsTitr1Art'];
        $libSsTitr2Art = $query['libSsTitr2Art'];
        $parag2Art = $query['parag2Art'];
        $parag3Art = $query['parag3Art'];
        $libConclArt = $query['libConclArt'];
        $urlPhotArt = $query['urlPhotArt'];
        $numAngl = $query['numAngl'];
        $numThem = $query['numThem'];
    } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Article / Titre</title>

</head>
<body>

    <?php
    require_once __DIR__ . '/includes/commons/headerFront.php';
    // require_once __DIR__ . '/includes/commons/navigationFront.php';
    require_once __DIR__ . '/includes/commons/imports.php';

    ?>

    <div id="main_article">

        <a href="pageArticles.php" class="retour">
            <span>Retour à la liste des articles</span>
            <div></div>
        </a> 

        <div class="header_article">
            <h3><?= $libTitrArt ?></h3>
            <h4><?= $libChapoArt ?></h4>
        </div>

        <div class="infos_article">
            <span class="art_info"><?= $dtCreArt ?></span>
            <span class="art_info">44 min de lecture</span>
            <a href="#" class="art_btn partage"><i class="fa fa-share-alt"></i><span>Partager</span></a>
            <a href="#" class="art_btn like"><i class="fa fa-heart"></i><span>J'aime</span></a>
        </div>

        <div class="content_article">

            <div class="image_article">
                <div class="article_illustration" style="background-image: url(../uploads/<?=$urlPhotArt?>);"></div>
            </div>

            <div class="body_article">
                <div class="art_accroche"><?= $libAccrochArt ?></div> 
                <div class="art_paragraphe"><?= $parag1Art ?></div>
                <h4><?= $libSsTitr1Art ?></h4>
                <div class="art_paragraphe"><?= $parag2Art ?></div>
                <h4><?= $libSsTitr2Art ?></h4>
                <div class="art_paragraphe"><?= $parag3Art ?></div>
                <h4>Conclusion</h4>
                <div class="art_conclusion"><?= $libConclArt ?></div>
            </div>
        
        </div>

        <div class="article_auteurs">
            <span>
                <b>By.</b>
                La team du turfu
            </span>
        </div>

        <div class="article_more">

            <div class="article_autres">

                <a class="article_preview" href="#">
                    <div class="preview_illustration" style="background-image: url('https://cdn.pixabay.com/photo/2013/03/02/02/41/alley-89197_960_720.jpg');"></div>
                    <h5>Titre de l'article</h5>
                    <p>Chapeau Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
                </a>
                <a class="article_preview" href="#">
                    <div class="preview_illustration" style="background-image: url('https://cdn.pixabay.com/photo/2013/03/02/02/41/alley-89197_960_720.jpg');"></div>
                    <h5>Titre de l'article</h5>
                    <p>Chapeau Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
                </a>
                <a class="article_preview" href="#">
                    <div class="preview_illustration" style="background-image: url('https://cdn.pixabay.com/photo/2013/03/02/02/41/alley-89197_960_720.jpg');"></div>
                    <h5>Titre de l'article</h5>
                    <p>Chapeau Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
                </a>

            </div>

            <div class="article_coms">

                <div class="commentaire">
                    <div class="com_membre">
                        <img src="https://i.pinimg.com/564x/15/c1/ec/15c1ec0f3beb08c3587d65462fd0fc7a.jpg" alt="avatar USERNAME"/>
                        <div class="btn_like_com" title="J'aime"><i class="fa fa-heart"></i></div>
                    </div>
                    <div class="com_cont">
                        <span>Prénom <b>Nom</b></span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas dolorum animi sunt est facilis, eum, non mollitia suscipit dolorem eveniet voluptatem minus consequatur repudiandae, quis ratione iste officia magnam perspiciatis.</p>
                    </div>
                </div>

                <div class="commentaire reponse">
                    <div class="com_membre">
                        <img src="https://i.pinimg.com/564x/15/c1/ec/15c1ec0f3beb08c3587d65462fd0fc7a.jpg" alt="avatar USERNAME"/>
                        <div class="btn_like_com" title="J'aime"><i class="fa fa-heart"></i></div>
                    </div>
                    <div class="com_cont">
                        <span>Prénom <b>Nom</b></span>
                        <p><b><i class="fas fa-share"></i> En réponse à @PseudoMembre : </b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas dolorum animi sunt est facilis, eum, non mollitia suscipit dolorem eveniet voluptatem minus consequatur repudiandae, quis ratione iste officia magnam perspiciatis.</p>
                    </div>
                </div>

                <div class="commentaire">
                    <div class="com_membre">
                        <img src="https://i.pinimg.com/564x/15/c1/ec/15c1ec0f3beb08c3587d65462fd0fc7a.jpg" alt="avatar USERNAME"/>
                        <div class="btn_like_com" title="J'aime"><i class="fa fa-heart"></i></div>
                    </div>
                    <div class="com_cont">
                        <span>Prénom <b>Nom</b></span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas dolorum animi sunt est facilis, eum, non mollitia suscipit dolorem eveniet voluptatem minus consequatur repudiandae, quis ratione iste officia magnam perspiciatis.</p>
                    </div>
                </div>

                <div class="commentaire">
                    <div class="com_membre">
                        <img src="https://i.pinimg.com/564x/15/c1/ec/15c1ec0f3beb08c3587d65462fd0fc7a.jpg" alt="avatar USERNAME"/>
                        <div class="btn_like_com" title="J'aime"><i class="fa fa-heart"></i></div>
                    </div>
                    <div class="com_cont">
                        <span>Prénom <b>Nom</b></span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas dolorum animi sunt est facilis, eum, non mollitia suscipit dolorem eveniet voluptatem minus consequatur repudiandae, quis ratione iste officia magnam perspiciatis.</p>
                    </div>
                </div>

            </div>
        </div>

    </div>




    <?php
    require_once __DIR__ . '/includes/commons/footerFront.php';
    ?>


    
</body>
</html>