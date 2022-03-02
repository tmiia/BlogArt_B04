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

    <div id="main_article">

        <a href="pageArticles.php" class="retour">Retour à la liste des articles</a> 

        <div class="header_article">
            <h3>Les restos du coeur</h3>
            <h4>Un petit blabla explicatif par ici psk c'est tjrs sympa.</h4>
        </div>

        <div class="infos_article">
            <span class="art_info">20 janvier 2022</span>
            <span class="art_info">44 min de lecture</span>
            <a href="#" class="art_btn partage"><i class="fa fa-share-alt"></i><span>Partager</span></a>
            <a href="#" class="art_btn like"><i class="fa fa-heart"></i><span>J'aime</span></a>
        </div>

        <div class="body_article">
            <div class="art_accroche"></div> 
            <div class="art_titre"></div>
            <div class="art_paragraphe"></div>
            <div class="art_titre"></div>
            <div class="art_paragraphe"></div>
            <div class="art_titre"></div>
            <div class="art_paragraphe"></div>
            <div class="art_conclusion"></div>
        </div>

    </div>




    <?php
    require_once __DIR__ . '/includes/commons/footerFront.php';
    ?>


    
</body>
</html>