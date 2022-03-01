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
<div class="tri_article">
    
    <div class="them_event">

        <h6>THEMATIQUES :</h6>
        <a href="" class="event_butt">
            <span class="butt">EVENEMENTS<svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M192 384c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L192 306.8l137.4-137.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-160 160C208.4 380.9 200.2 384 192 384z"/></svg>
</span>
        </a>

    </div>


    <div class="trier_date">

        <h6>TRIER PAR :</h6>
        <a href="" class="date_butt">
        <span class="butt">PAR DATE<svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M192 384c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L192 306.8l137.4-137.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-160 160C208.4 380.9 200.2 384 192 384z"/></svg>
</span>

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