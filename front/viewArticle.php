<?php 

require_once __DIR__ . '/../CONNECT/config.php';

// Mode DEV
require_once ROOT . '/util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/util/ctrlSaisies.php';

require_once ROOT . '/CLASS_CRUD/article.class.php';
$monArticle = new ARTICLE();
require_once ROOT . '/CLASS_CRUD/comment.class.php';
$monCommentaire = new COMMENT();
require_once ROOT . '/CLASS_CRUD/membre.class.php';
$monMembre = new MEMBRE();

require_once ROOT . '/CLASS_CRUD/LikeArt.class.php';
$monLikeArt = new LIKEART();


// Gestion des erreurs de saisie
$erreur = false;

if(isset($_COOKIE)){
    $pseudoCurrentMemb = $_COOKIE['pseudoMemb'];
    global $db;
    $query = "SELECT numMemb FROM membre WHERE pseudoMemb = ?;";
		$result2 = $db->prepare($query);
		$result2->execute([$pseudoCurrentMemb]);
        $currentMemb = $result2->fetch();
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
   $id = $_POST['id'];
    // controle des saisies du formulaire
    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    if ((isset($_POST["Submit"])) AND ($Submit === "Initialiser")) {
        
        header("Location:" .ROOTFRONT . "/front/viewArticle.php?id=$id");
    }   // End of if ((isset($_POST["submit"])) ...
        
    if (((isset($_POST['currentMemb'])) AND (!empty($_POST['currentMemb'])) AND (isset($_POST['reponse'])) AND (!empty($_POST['reponse']))AND (isset($_POST['libCom'])) AND (!empty($_POST['libCom']))
        AND (!empty($_POST['Submit'])) AND ($Submit === "Valider"))) {

            // Saisies valides
    
            header("Location:" .ROOTFRONT . "/front/viewArticle.php?id=$id");

            $erreur = false;
           
            $numMemb = ctrlSaisies(($_POST['currentMemb']));
            $numArt = ctrlSaisies(($_POST['reponse']));
            $numSeqCom = intval($monCommentaire->getNextNumCom($numArt));
            $libCom = ctrlSaisies(($_POST['libCom']));
            // $dtCreCom = ctrlSaisies(($_POST['dtCreCom']));


            $monCommentaire-> create($numSeqCom, $numArt, $libCom, $numMemb);
    
            header("Location:" .ROOTFRONT . "/front/viewArticle.php?id=$id");

            if ((isset($_POST['reponse'])) != $id){

                ?>

                <script>
                    let repCom = document.querySelector('.commentaire');
                    repCom.classList.add("reponse");

                    
                </script>

                <?php

            }
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

    $queryComment = $monCommentaire->get_AllCommentsByNumArt($id);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/modal.js"></script>
    <link href="style.css" rel="stylesheet">
    <title><?= $libTitrArt ?></title>

</head>
<body>

    <?php
    require_once __DIR__ . '/includes/commons/headerFront.php';
    // require_once __DIR__ . '/includes/commons/navigationFront.php';
    require_once __DIR__ . '/includes/commons/imports.php';

    ?>

    <div id="main_article">

        <a href="pageArticles.php" class="retour">
            <span><i class="fas fa-chevron-left"></i> Retour à la liste des articles</span>
            <div></div>
        </a> 

        <div class="header_article">
            <h3><?= $libTitrArt ?></h3>
            <h4><?= $libChapoArt ?></h4>
        </div>

        <div class="infos_article">
            <span class="art_info"><?= $dtCreArt ?></span>
            <span class="art_info">3 min de lecture</span>
            <a href="#" class="art_btn partage"><i class="fa fa-share-alt"></i><span>Partager</span></a>
            <?php  if($monLikeArt->get_1LikeArt($currentMemb['numMemb'], $id) == false){
                $isLike = "0";
            }
            else{
                $isLike = $monLikeArt->get_1LikeArt($currentMemb['numMemb'], $id)['likeA'];
            }
            if($isLike == "1"){ ?>
                <a id="btn-like" class="art_btn liked" data-numart="<?=$id?>" data-membre="<?=$currentMemb['numMemb']?>"><i class="fa fa-heart"></i><span>J'aime</span></a>
            <?php }else if($isLike == "0"){ ?>
                <a id="btn-like" class="art_btn like" data-numart="<?=$id?>" data-membre="<?=$currentMemb['numMemb']?>"><i class="fa fa-heart"></i><span>J'aime</span></a>
            <?php }    
            ?>
            <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
            <script>
                $(document).ready(function(){
                    let like = document.querySelector('#btn-like');
                    let numArt = like.dataset.numart;
                    let membre = like.dataset.membre;
                    like.addEventListener('click', ()=>{
                        if(like.className == "art_btn liked"){
                            like.classList.replace("liked", "like");
                        }
                        else if(like.className == "art_btn like"){
                            like.classList.replace("like", "liked");
                        }
                        $.ajax({
                            type: "POST",
                            url: "like.php",
                            data: {
                                numArt: numArt,
                                membre: membre,
                                like: 1,
                            },
                        });
                    })
                })
            </script>
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
                Au bord des rues
            </span>
        </div>

        <div class="article_more">

            <div class="article_autres">

                <?php
                    $lastArticles = $monArticle->get_LastArticles();

                    for($i = 1; $i < 4; $i++){
                        ?>
                        <a class="article_preview" href="./viewArticle.phpviewArticle.php?id=<?=$lastArticles[$i]['numArt'] ?>">
                                <div class="preview_illustration" style="background-image: url('../uploads/<?=htmlspecialchars($lastArticles[$i]['urlPhotArt']) ?>');"></div>
                                    <h5><?= $lastArticles[$i]['libTitrArt'] ?></h5>
                                    <p><?= $lastArticles[$i]['libChapoArt'] ?></p>
                                </a>
                <?php
                        }
                ?>
            </div>

            <div class="article_coms">
                <?php
                    if($queryComment != []){
                        for($i = 0; $i < count($queryComment); $i++){
                            $pseudo = $monMembre->get_1Membre($queryComment[$i]['numMemb'])['pseudoMemb'];
                            $comment = $queryComment[$i]['libCom']; ?>

                            <div class="commentaire">
                            <div class="com_membre">
                                <img src="https://i.pinimg.com/564x/15/c1/ec/15c1ec0f3beb08c3587d65462fd0fc7a.jpg" alt="avatar <?=$pseudo?>"/>
                                <div class="btn_like_com" title="J'aime"><i class="fa fa-heart"></i></div>
                            </div>
                            <div class="com_cont">
                                <span>membre<b><?=$pseudo?></b></span>
                                <p><?= $comment ?></p>
                            </div>
                        </div>

                <?php
                        }
                    }
                    else{
                ?>
                <div class="commentaire">
                    <div class="com_cont no_com">  
                        Aucun commentaire pour le moment.
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="add_commentaire">
            <a href="<?=ROOTFRONT?>/front/pagearticles.php">
                <div></div>
                <span>Retour à la liste des articles</span>
            </a>

            <button id="modal_btn">
                <div></div>
                <span>Ajouter un commentaire</span>
            </button>

            <div class="modal" id="modal_commentaire">                
                <div class="modal-content">
                    
                    <span class="close_modal">&times;</span>

                    <h5><span>Ajouter un commentaire</span></h5>

                    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

                        <fieldset>
                            <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />
                            <input type="hidden" id="currentMemb" name="currentMemb" value="<?= $currentMemb['numMemb']; ?>" />

                            <!-- --------------------------------------------------------------- -->
                                <!-- FK : Membre, Article -->
                            <!-- --------------------------------------------------------------- -->
                            <!-- --------------------------------------------------------------- -->
                            
                            <!-- Listbox Article -->
                            <div class="control-group">
                                <div class="controls">
                                    <label class="control-label" for="LibTypThem">
                                        <b>Répondre à :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                    </label>

                                    <!-- Listbox Article => 2ème temps -->
                                    <select name="reponse" id="reponse"  class="form-control form-control-create">
                                        <option value="-1">Choisir</option>
                                        <option value="<?= $id ?>"> -  L'article</option>
                                        <?php
                                            $allMembByArt = $monCommentaire->get_allmembresbyarticle($id);
                                            
                                            if($allMembByArt){
                                            for ($i=0; $i < count($allMembByArt); $i++){
                                                $value = $allMembByArt[$i]['numMemb'];
                                        ?>
                                        
                                        <option value="<?php echo($value); ?>"> <?= $monMembre->get_1Membre($allMembByArt[$i]['numMemb'])['pseudoMemb'] . " - " .  $allMembByArt[$i]['libCom'] ?> </option>
                                        
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
                        <div class="control-group textCom">
                            <label class="control-label" for="libCom"><b>Ajoutez votre Commentaire :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                            <div class="controls">
                                <textarea name="libCom" id="editor1" tabindex="30" rows="20" cols="100" title="Texte à mettre en forme" value="<? if(isset($_GET['libCom'])) echo $_POST['libCom']; ?>"></textarea>
                            </div>
                        </div>
                        <!-- End textarea comment -->

                        <div class="add_comm_btns">
                    
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
                            <div class="add_com_controls">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="submit" value="Initialiser" name="Submit" />
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input class="btn_valid_com" type="submit" value="Valider" name="Submit" />
                                <br>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

    <script>
        var modalCom = document.getElementById("modal_commentaire");
        var modalBtn = document.getElementById("modal_btn");
        var modalSpan = document.getElementsByClassName("close_modal")[0];

        modalBtn.onclick = function() {
        modalCom.style.display = "flex";
        }

        modalSpan.onclick = function() {
        modalCom.style.display = "none";
        }

        window.onclick = function(event) {
        if (event.target == modalCom) {
            modalCom.style.display = "none";
        }
        }
            </script>




    <?php
    require_once __DIR__ . '/includes/commons/footerFront.php';
    ?>



</body>
</html>