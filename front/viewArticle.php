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
    require_once ROOT . 'front/includes/commons/headerFront.php';
    // require_once ROOT . '/includes/commons/navigationFront.php';
    require_once ROOT . 'front/includes/commons/imports.php';

    ?>

    <div id="main_article">

        <a href="pageArticles.php" class="retour">
            <span>Retour à la liste des articles</span>
            <div></div>
        </a> 

        <div class="header_article">
            <h3>Les restos du coeur</h3>
            <h4>Chapeau de l'article ? Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore architecto, deleniti ratione iure error aspernatur, ab voluptatibus eius quos, aliquid excepturi labore.</h4>
        </div>

        <div class="infos_article">
            <span class="art_info">20 janvier 2022</span>
            <span class="art_info">44 min de lecture</span>
            <a href="#" class="art_btn partage"><i class="fa fa-share-alt"></i><span>Partager</span></a>
            <a href="#" class="art_btn like"><i class="fa fa-heart"></i><span>J'aime</span></a>
        </div>

        <div class="content_article">

            <div class="image_article">
                <div class="article_illustration" style="background-image: url('https://cdn.pixabay.com/photo/2013/03/02/02/41/alley-89197_960_720.jpg');"></div>
            </div>

            <div class="body_article">
                <div class="art_accroche">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos soluta culpa excepturi illo nam harum debitis esse corporis? </div> 
                <h4>Sous-titre</h4>
                <div class="art_paragraphe">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reprehenderit, quisquam. Porro cupiditate cum est, quibusdam maxime dolorem illo quia labore alias vel possimus tenetur soluta nobis sed! Mollitia, nostrum doloremque. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Suscipit assumenda error omnis id nostrum officiis aliquid maiores, culpa obcaecati quaerat explicabo, sint expedita eius. Vero vitae impedit illo eligendi libero.</div>
                <h4>Sous-titre</h4>
                <div class="art_paragraphe">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reprehenderit, quisquam. Porro cupiditate cum est, quibusdam maxime dolorem illo quia labore alias vel possimus tenetur soluta nobis sed! Mollitia, nostrum doloremque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe eius et veniam assumenda autem nam vel. Error minima voluptates ex beatae dolorem vitae. Doloribus suscipit, aut iusto cumque corrupti facere!</div>
                <h4>Sous-titre</h4>
                <div class="art_paragraphe">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reprehenderit, quisquam. Porro cupiditate cum est, quibusdam maxime dolorem illo quia labore alias vel possimus tenetur soluta nobis sed! Mollitia, nostrum doloremque. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat dignissimos molestias, aliquam repudiandae dolor autem? Voluptatibus tempore nemo, dolor perspiciatis quas cumque temporibus repellat libero minima eveniet voluptas. Maiores, suscipit?</div>
                <h4>Conclusion</h4>
                <div class="art_conclusion">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias earum nobis aperiam, illo nihil magnam maxime aliquam architecto, soluta minima velit facilis? Obcaecati voluptas voluptates expedita excepturi reiciendis error repellat!</div>
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
    require_once ROOT . 'front/includes/commons/footerFront.php';
    ?>


    
</body>
</html>