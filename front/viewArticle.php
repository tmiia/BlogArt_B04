<?php 

require_once __DIR__ . '/../CONNECT/config.php';

// Mode DEV
require_once ROOT . '/util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/util/ctrlSaisies.php';

// Insertion classe Comment
require_once ROOT . '/CLASS_CRUD/comment.class.php';

// Instanciation de la classe Article
$monCommentaire = new COMMENT();
// Instanciation de la classe Comment
require_once ROOT . '/CLASS_CRUD/article.class.php';

require_once ROOT . '/CLASS_CRUD/membre.class.php';
$monMembre = new MEMBRE();


// Gestion des erreurs de saisie
$erreur = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    
    // controle des saisies du formulaire
    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    if ((isset($_POST["Submit"])) AND ($Submit === "Initialiser")) {
    
            header("Location: ./comment.php");
    }   // End of if ((isset($_POST["submit"])) ...
        
    if (((isset($_POST['Membre'])) AND (!empty($_POST['Membre'])) AND (isset($_POST['Article'])) AND (!empty($_POST['Article']))AND (isset($_POST['libCom'])) AND (!empty($_POST['libCom']))
        AND (!empty($_POST['Submit'])) AND ($Submit === "Valider"))) {
            // Saisies valides
            $erreur = false;
           
            $numMemb = ctrlSaisies(($_POST['Membre']));
            $numArt = ctrlSaisies(($_POST['Article']));
            $numSeqCom = intval($monCommentaire->getNextNumCom($numArt));
            $libCom = ctrlSaisies(($_POST['libCom']));
            // $dtCreCom = ctrlSaisies(($_POST['dtCreCom']));


            $monCommentaire-> create($numSeqCom, $numArt, $libCom, $numMemb);
    
            header("Location: ./comment.php");
        }   // Fin if ((isset($_POST['libStat']))
        else {
            // Saisies invalides
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // End of else erreur saisies


    // insertion classe comment


}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")
// Init variables form
include ROOT . '/back/comment/initComment.php';
// Var init
?>

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
    <script src="/js/modal.js"></script>
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

        <div class="add_commentaire">
            <a href="/pagearticles.php">
                <div></div>
                <span>Retour à la liste des articles</span>
            </a>

            <button id="modal_btn">
                <div></div>
                <span>Ajouter un commentaire</span>
            </button>

            <div class="modal" id="modal_commentaire">
                <button id="modal-outside"></button>
                
                <div class="modal-content">
                    
                    <span class="close_modal">&times;</span>

                    <h5>Ajouter un commentaire</h5>

                    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

                        <fieldset>
                            <legend class="legend1">Commentez un commentaire...</legend>

                            <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

                            <!-- --------------------------------------------------------------- -->
                                <!-- FK : Membre, Article -->
                            <!-- --------------------------------------------------------------- -->
                            <!-- --------------------------------------------------------------- -->
                            
                            <!-- Listbox Membre -->
                            <div class="control-group">
                                <div class="controls">
                                    <label class="control-label" for="LibTypAngl">
                                        <b>Quel membre :&nbsp;&nbsp;&nbsp;</b>
                                    </label>
                                
                                    <select name="Membre" id="Membre"  class="form-control form-control-create">
                                        <option value="-1">- - - Choisissez un membre - - -</option>
                                        <?php
                                        $allMembres = $monMembre->get_AllMembres();
                                        
                                        if($allMembres){
                                        for ($i=0; $i < count($allMembres); $i++){
                                            $value = $allMembres[$i]['numMemb'];
                                        ?>
                                        
                                        <option value="<?php echo($value); ?>"> <?= $value ." - " . $allMembres[$i]['pseudoMemb']; ?> </option>
                                        
                                        <?php
                                            } // End of foreach
                                        }   // if ($result)
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- FIN Listbox Membre -->
                            <!-- --------------------------------------------------------------- -->
                            <!-- --------------------------------------------------------------- -->
                            <!-- Listbox Article -->
                            <div class="control-group">
                                <div class="controls">
                                    <label class="control-label" for="LibTypThem">
                                        <b>Quel article :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                    </label>

                                    <!-- Listbox Article => 2ème temps -->
                                    <select name="Article" id="Article"  class="form-control form-control-create">
                                        <option value="-1">- - - Choisissez un article - - -</option>
                                        <?php
                                        $allArticles = $monArticle->get_AllArticles();
                                        
                                        if($allArticles){
                                        for ($i=0; $i < count($allArticles); $i++){
                                            $value = $allArticles[$i]['numArt'];
                                        ?>
                                        
                                        <option value="<?php echo($value); ?>"> <?= $value ." - " . $allArticles[$i]['libTitrArt']; ?> </option>
                                        
                                        <?php
                                            } // End of foreach
                                        }   // if ($result)
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- FIN Listbox Article -->
                            <!-- --------------------------------------------------------------- -->
                        <!-- --------------------------------------------------------------- -->
                            <!-- Fin FK : Membre, Article -->
                        <!-- --------------------------------------------------------------- -->
                            <!-- textarea comment -->
                            <br>
                            <div class="control-group">
                                <label class="control-label" for="libCom"><b>Ajoutez votre Commentaire :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                                <div class="controls">
                                <textarea name="libCom" id="editor1" tabindex="30" style="height:400px; width:700px; padding:2px; border:solid 1px black; color:steelblue; border-radius:5px;" rows="20" cols="100" title="Texte à mettre en forme" value="<? if(isset($_GET['libCom'])) echo $_POST['libCom']; ?>"></textarea>
                                </div>
                            </div>
                            <br>
                        <!-- End textarea comment -->
                    <!-- --------------------------------------------------------------- -->
                        <small class="error">Votre post est soumis à validation avant son affichage sur le blog (moins d'une semaine)...</small><br><br>

                            <div class="control-group">
                                <div class="error">
                    <?php
                                if ($erreur) {
                                    echo ($errSaisies);
                                } else {
                                    $errSaisies = "";
                                    echo ($errSaisies);
                                }
                    ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="controls">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="submit" value="Initialiser" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                                    <br>
                                </div>
                            </div>
                        </fieldset>
                        </form>

                    
                </div>
            </div>
        </div>

    </div>




    <?php
    require_once __DIR__ . '/includes/commons/footerFront.php';
    ?>


    
</body>
</html>