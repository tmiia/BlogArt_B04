<?php

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <?php
    require_once __DIR__ . '/includes/commons/imports.php';

    ?>
    
    
</head>

<body>
<!-- HEADER -->
    <?php
    require_once __DIR__ . '/includes/commons/headerFront.php';
    ?>
<!------------>
<div class="main_article">

<div class="search">

<a href="" class="search_butt">
<span class="bar_search">Rechercher<img class="svg_search" src="<?=ROOTFRONT?>/front/assets/magnifying-glass-solid.jpg" alt=""></span>
</a>

</div>

<!------------>



<div class="tri_article">
    
    <div>

        <label>TRIER PAR THEMATIQUE:</label>
        <br>
            <label class="theme_select_container" for="theme_select">
                <select class="theme_select" name="theme" id="theme_select">

                    <option value="Croissant">Thèmes</option>
                    <option value="Décroissant">différents thémes</option>

                </select>
            </label>
    </div>

    <div>

        <label>TRIER PAR DATE:</label>
        <br>
            <label class="theme_select_container" for="date_select">
                    <select class="date_select" name="date" id="date_select">
                        
                        <option value="Croissant">Ordre croissant</option>
                        <option value="Décroissant">Ordre décroissant</option>
                    </select>
            </label>

            
    </div>

</div>


<!------------>
<section class="articles">
<?php
    require_once __DIR__ . '/../CLASS_CRUD/article.class.php';
    $monArticle = new ARTICLE();

    $allArticle = $monArticle->get_AllArticles();

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

</section>

<!------------>
</div>

<!-- FOOTER -->
    <?php
    require_once __DIR__ . '/includes/commons/footerFront.php';
    ?>
<!---------- -->

</body>


</html>