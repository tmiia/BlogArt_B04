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

<div class="search">

<a href="" class="search">
<span class="bar_search">search<img class="svg_search" src="../front/assets/magnifying-glass-solid.jpg" alt=""></span>
</a>

</div>

<div class="tri_article">
    
    <div class="them_event">

        <h6>THEMATIQUES :</h6>
        <a href="" class="event_butt">
            <span class="butt">EVENEMENTS<img class="svg" src="../front/assets/down.jpg" alt=""></span>
        </a>

    </div>


    <div class="trier_date">

        <h6>TRIER PAR :</h6>
        <a href="" class="date_butt">
        <span class="butt">PAR DATE<img class="svg" src="../front/assets/down.jpg" alt=""></span>

        </a>

    </div>

</div>


<!------------>
<section class="articles">

<a class="article_recent" href="#">
    <div class="article_illustration" style="background-image: url('https://www.aurore.asso.fr/images/medias/21552.png');"></div>
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

<!------------>

<!-- FOOTER -->
    <?php
    require_once __DIR__ . '/includes/commons/footerFront.php';
    ?>
<!---------- -->

</body>


</html>