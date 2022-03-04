<?php
    require_once __DIR__ . '/../CONNECT/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Au bord des rues</title>

</head>
<body>

    <header>
        <h1>
            <span>Au <b>Bord</b></span>
            <span>des <b>Rues</b></span> 
        </h1>
        <h2><span>Parlons solidarité</span></h2>
    </header>

    <?php
    require_once __DIR__ . '/includes/commons/headerFront.php';
    // require_once __DIR__ . '/includes/commons/navigationFront.php';
    require_once __DIR__ . '/includes/commons/imports.php';

    ?>

    <div id="main_body">

        <h4>Articles récents</h4>

        <section class="articles">

        <?php
            require_once __DIR__ . '/../CLASS_CRUD/article.class.php';
            $monArticle = new ARTICLE();

            $lastArticles = $monArticle->get_LastArticles();

            for($i = 0; $i < 5; $i++){ ?>

                <a class="article_recent" href="viewArticle.php?id=<?=$lastArticles[$i]['numArt']?>">
                <div class="article_illustration" style="background-image: url(../uploads/<?=htmlspecialchars($lastArticles[$i]['urlPhotArt']) ?>);"></div>
                <div class="article_recent_top">
                <h5><?= $lastArticles[$i]['libTitrArt'] ?></h5>
                <p><?= $lastArticles[$i]['libChapoArt'] ?></p>
                </div>
                <div class="article_recent_bot">
                    <div class="article_like"><i class="fa fa-heart"></i></div>
                    <div class="article_btn">Consulter l'article</div>
                </div>
            </a>
            <?php 
            }
?>



        </section>

        <h4>La solidarité en action</h4>

        <section class="redirection">
            <a class="outSite" href="https://collecte.restosducoeur.org/" target="_blank">
                <div class="event_illustration" style="background-image: url('https://collecte.restosducoeur.org/wp-content/uploads/2021/12/cropped-Bandeau-site-CN22.png'); background-position:right;"></div>
                <h5>Collecte nationale 2022 : </h5>
                <p>Les équipes de bénévoles des Restos seront présentes dans des centaines de supermarchés et commerces dans toute la France pour récolter des denrées alimentaires et des produits d’hygiène. </p>
            </a>
            <a class="outSite" href="https://www.bordeaux.fr/p148833/la-nuit-de-la-solidarite">
              <div class="event_illustration" style="background-image: url('https://www.bordeaux.fr/images/ebx/fr/presentationStandard/148833/nuit-solidarites_550_2gif_1.gif');"></div>
                <h5>Nuit de la solidarité 2022</h5>
                <p>Pour la première fois, Bordeau s'est unie au mouvement national des Nuits de la Solidarité, dans le cadre d'une grande enquête visant à prévoir des solutions solidaires.</p>
            </a>
        </section>

        <h4>Associations solidaires</h4>

        <section class="associations">
            <a class="association_lien" href="https://ad33.restosducoeur.org/" target="_blank">
                <div class="asso_logo" style="background-image: url('https://ad33.restosducoeur.org/wp-content/themes/associations-dep/img/logo.svg');"></div>
                <h6>Les restos du coeur</h6>
                <p>Aide alimentaire et accompagnement.</p>
            </a>
            <a class="association_lien" href="https://asso.alternaweb.org/lapiraterie/" target="_blank">
                <div class="asso_logo" style="background-image: url('https://assos.bordeaux.fr/sites/MET-ANNASSO-DRUPAL/files/styles/detail_association/public/association/32269/logo/LOGO_Collectif%20De%20La%20Piraterie_W332023841.png?itok=cEMq6IcS');"></div>
                <h6>La piraterie</h6>
                <p>Soutien aux personnes en précarité.</p>
            </a>
            <a class="association_lien" href="https://www.facebook.com/CollectifSecoursOrientationdeRue/" target="_blank">
                <div class="asso_logo" style="background-image: url('https://assos.bordeaux.fr/sites/MET-ANNASSO-DRUPAL/files/styles/detail_association/public/association/34347/logo/LOGO_Collectif%20de%20Secours%20%26%20Orientation%20de%20Rue_W332029562.png?itok=GX1Yyt64');"></div>
                <h6>CSOR</h6>
                <p>Soins aux personnes vulnérables.</p>
            </a>
            <a class="association_lien" href="https://www.desgateauxsolidaires.fr/" target="_blank">
                <div class="asso_logo" style="background-image: url('https://assos.bordeaux.fr/sites/MET-ANNASSO-DRUPAL/files/styles/detail_association/public/association/34748/logo/LOGO_Des%20g%C3%A2teaux%20solidaires_W332029592.png?itok=fyGo-2Do');"></div>
                <h6>DES GÂTEAUX SOLIDAIRES</h6>
                <p>Distribution alimentaire.</p>
            </a>
        </section>

        
    </div>




    <?php
    require_once __DIR__ . '/includes/commons/footerFront.php';
    ?>


    
</body>
</html>