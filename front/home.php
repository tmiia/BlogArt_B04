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
    require_once __DIR__ . '/includes/commons/navigationFront.php';
    require_once __DIR__ . '/includes/commons/footerFront.php';
    require_once __DIR__ . '/includes/commons/imports.php';

    ?>

    <div id="main_body">

        <h4>Articles récents</h4>

        <section class="articles">

            <a class="article_recent">
                <div class="article_recent_top">
                    <h5>TitreArticle</h5>
                    <p>ChapeauArticle</p>
                </div>
                <div class="article_recent_bot">
                    <div class="article_like"></div>
                    <div class="article_btn">Consulter l'article</div>
                </div>
            </a>


        </section>

        <h4>Donnez de votre temps</h4>

        
    </div>




    <?php
    require_once __DIR__ . '/includes/commons/footerFront.php';
    ?>


    
</body>
</html>