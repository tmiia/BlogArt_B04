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
    require_once __DIR__ . '/../class_crud/thematique.class.php';
    $mathematique = new thematique();


    ?>
    
    
</head>

<body>
<!-- HEADER -->
    <?php
    require_once __DIR__ . '/includes/commons/headerFront.php';
    ?>
<!------------>
<div id="main_page_articles">

    <div class="search">

    <a href="" class="search_butt">
    <span class="bar_search">Rechercher<img class="svg_search" src="<?=ROOTFRONT?>/front/assets/magnifying-glass-solid.jpg" alt=""></span>
    </a>

    </div>

    <!------------>



    <div class="tri_article">
        
        <div>

            <label>TRIER PAR thematique:</label>
            <br>
                <label class="theme_select_container" for="theme_select">
                   

                       <select class="theme_select" name="theme" id="theme_select">
                            <option value="-1">- - - Choisissez une thématique - - -</option>
                                <?php
                                        $allThem = $mathematique->get_Allthematiques();
                                        if($allThem){
                                            for ($i=0; $i < count($allThem); $i++){
                                                $value = $allThem[$i]['numThem'];
                                            ?>
                                            
                                            <option value="<?php echo($value); ?>"> <?php echo($allThem[$i]['libThem']); ?> </option>
                                            
                                            <?php
                                            }
                                        }
                                        // if ($result)
                                    
                                    ?>
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
    <div class="articles">

            <?php
                require_once __DIR__ . '/../class_crud/article.class.php';
                $monarticle = new article();

                $allarticle = $monarticle->get_Allarticles();

                for($i = 0; $i <count($allarticle); $i++){ ?>

                    <a class="article_recent" href="viewarticle.php?id=<?=$allarticle[$i]['numArt']?>">
                    <div class="article_illustration" style="background-image: url(../uploads/<?=htmlspecialchars($allarticle[$i]['urlPhotArt']) ?>);"></div>
                    <div class="article_recent_top">
                        <h5><?= $allarticle[$i]['libTitrArt'] ?></h5>
                        <p><?= $allarticle[$i]['libChapoArt'] ?></p>
                    </div>
                    <div class="article_recent_bot">
                        <div class="article_like"><i class="fa fa-heart-o"></i></div>
                        <div class="article_btn">Consulter l'article</div>
                    </div>
                    </a>
                <?php 
                }
    ?>

    </div>


<!------------>
</div>

<!-- FOOTER -->
    <?php
    require_once __DIR__ . '/includes/commons/footerFront.php';
    ?>
<!---------- -->

</body>


</html>