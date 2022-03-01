<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Home</title>

</head>
<body>

    <?php
    require_once __DIR__ . '/includes/commons/headerFront.php';
    // require_once __DIR__ . '/includes/commons/navigationFront.php';
    require_once __DIR__ . '/includes/commons/imports.php';

    ?>

    <div id="main_body">

        <h4>Articles récents</h4>

        <section class="articles">

            <a class="article_recent" href="#">
                <div class="article_illustration" style="background-image: url('https://cdn.pixabay.com/photo/2013/03/02/02/41/alley-89197_960_720.jpg');"></div>
                <div class="article_recent_top">
                    <h5>TitreArticle</h5>
                    <p>ChapeauArticle</p>
                </div>
                <div class="article_recent_bot">
                    <div class="article_like"><i class="fa fa-heart-o"></i></div>
                    <div class="article_btn">Consulter l'article</div>
                </div>
            </a>


        </section>

        <h4>La solidarité en action</h4>

        <section class="redirection">
            <a class="outSite" href="#">
                <div class="event_illustration" style="background-image: url('https://cdn.pixabay.com/photo/2013/03/02/02/41/alley-89197_960_720.jpg');"></div>
                <h5>Les restos du coeur</h5>
                <p>Faire un don. La générosité des donateurs est essentielle pour le fonctionnement des Restos. Sans les dons, nous ne pourrions par assurer nos ...</p>
            </a>
            <a class="outSite" href="#">
              <div class="event_illustration" style="background-image: url('https://cdn.pixabay.com/photo/2013/03/02/02/41/alley-89197_960_720.jpg');"></div>
                <h5>Deuxième lien externe</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum quis soluta pariatur nulla cumque minima omnis accusantium, reiciendis beatae enim nihil.</p>
            </a>
        </section>

        <h4>Associations solidaires</h4>

        <section class="associations">
            <a class="association_lien" href="#">
                <div class="asso_logo" style="background-image: url('https://cdn.pixabay.com/photo/2013/03/02/02/41/alley-89197_960_720.jpg');"></div>
                <h6>Nom asso</h6>
                <p>Localisation</p>
            </a>
        </section>

        
    </div>




    <?php
    require_once __DIR__ . '/includes/commons/footerFront.php';
    ?>


    
</body>
</html>