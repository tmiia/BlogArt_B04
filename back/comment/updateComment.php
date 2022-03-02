<?php
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';
require_once __DIR__ . '/../../CLASS_CRUD/comment.class.php';
$monComment = new COMMENT();
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
$monArticle = new ARTICLE();
require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
$monMembre = new MEMBRE();

$erreur = false;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $numSeqCom = $_POST['numSeqCom'];

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    }
    else{
        $Submit = "";
    }

    if($_POST['Submit'] == 'Initialiser'){
        header("Location: updateComment.php?id=$numSeqCom");
    }

    if(isset($_POST['Submit']) AND $_POST['Submit'] == 'Valider'){
        if(isset($_POST['libCom']) AND !empty($_POST['liCom']) AND isset($_POST['numArt']) AND !empty($_POST['numArt']) AND isset($_POST['numMemb']) AND !empty($_POST['numMemb']) AND !empty($_POST['Submit'] AND $Submit == 'Valider')){
            $erreur = false;


            header("Location: ./comment.php");
        }
        else{
            $erreur = true;
            $errSaisies = "Erreur, la saisie est obligatoire !";
        }
    }
}  
include __DIR__ . '/initComment.php'; 
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>Admin - CRUD Commentaire</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="" />

    <!-- Style du formulaire et des boutons -->
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <script src="./script_global.js"></script>

        <style type="text/css">
            textarea { /* Désactivez redimensionnement par défaut */
                resize: none;
            }
        </style>
    </head>
    <body>
        <h1>BLOGART22 Admin - CRUD Commentaire</h1>
        <h2>Mise à jour d'un commentaire</h2>
<?php
    // Modif : récup id à modifier
    // id passé en GET

    $numSeqCom = intval($_GET['id1']);
    $numArt = intval($_GET['id2']);

    $query = $monComment->get_1Comment($numSeqCom, $numArt);
    

    if($query){
        $idMemb = $monMembre->get_1Membre($query['numMemb'])['pseudoMemb'];
        $idArt = $monArticle->get_1Article($numArt)['libTitrArt'];
        $libCom = $query['libCom'];
        $notifComKOAff = $query['notifComKOAff'];

    }



?>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

        <fieldset>
            <legend class="legend1">Modération : validez un commentaire...</legend>

            <input type="hidden" id="id1" name="id1" value="<?= isset($_GET['id1']) ? $_GET['id1'] : '' ?>" />
            <input type="hidden" id="id2" name="id2" value="<?= isset($_GET['id2']) ? $_GET['id2'] : '' ?>" />

<!-- --------------------------------------------------------------- -->
    <!-- FK : Membre, Article -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Membre -->
            <br>
            <div class="control-group">
                <div class="controls">
                    <label class="control-label" for="LibTypAngl">
                        <b>Quel membre :&nbsp;&nbsp;&nbsp;</b>
                    </label>
                    <input type="hidden" id="idTypMemb" name="idTypMemb" value="<?= $numMemb; ?>" />

                    <input type="text" name="idMemb" id="idMemb" size="5" maxlength="5" value="<?= $idMemb; ?>" autocomplete="on" />

                    <!-- Listbox membre => 2ème temps -->

                </div>
            </div>
    <!-- FIN Listbox Membre -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Article -->
            <br>
            <div class="control-group">
                <div class="controls">
                    <label class="control-label" for="LibTypThem">
                        <b>Quel article :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                    </label>
                    <input type="hidden" id="idTypArt" name="idTypArt" value="<?= $numArt; ?>" />

                    <input type="text" name="idArt" id="idArt" size="5" maxlength="5" value="<?= $idArt; ?>" autocomplete="on" />

                    <!-- Listbox article => 2ème temps -->

                </div>
            </div>
    <!-- FIN Listbox Article -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Fin FK : Membre, Article -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- textarea comment -->
            <br>
            <div class="control-group">
                <label class="control-label" for="libCom"><b>Commentaire à valider :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <div class="controls">

                    <textarea name="libCom" id="libCom" tabindex="30"  rows="20" cols="70" style="background-color:white;" disabled="disabled"><?= $libCom; ?></textarea>
                </div>
            </div>
    <!-- End textarea comment -->
<!-- --------------------------------------------------------------- -->

            <br>
            <div class="control-group">
                <label class="control-label" for="attModOK"><b>En tant que modérateur, je valide le post :</b></label>
                <div class="controls">
                    <fieldset>
                        <input type="radio" name="attModOK"
                        <?php if($attModOK == 1) echo 'checked="checked"'; ?>
                        value="on" />&nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="attModOK"
                        <?php if($attModOK == 0) echo 'checked="checked"'; ?>
                        value="off" />&nbsp;&nbsp;Non
                    </fieldset>
                </div>
            </div>

<!-- --------------------------------------------------------------- -->
     <!-- Début textarea notification commentaire -->
            <div class="control-group">
                <label class="control-label" for="notifComKOAff"><b>En voici les raisons :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <div class="controls">
                    <textarea name="notifComKOAff" id="notifComKOAff" rows="10" cols="70" tabindex="70" placeholder="Décrivez la raison pour laquelle vous ne voulez pas afficher le post." ><?= $notifComKOAff; ?></textarea>
                </div>
            </div>
        <small class="error">Vous pouvez ajouter une notification de rejet du post (propos difammatoires, injures, vulgarité,...)</small><br>
    <!-- End textarea notification commentaire -->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
    <!-- Suppression logique du commentaire -->
        <br>
            <div class="control-group">
                <label class="control-label" for="delLogiq"><b>En tant que modérateur, je veux que le post soit supprimé :</b></label>
                <div class="controls">
                    <fieldset>
                        <input type="radio" name="delLogiq"
                        <?php if($delLogiq == 1) echo 'checked="checked"'; ?>
                        value="on" />&nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="delLogiq"
                        <?php if($delLogiq == 0) echo 'checked="checked"'; ?>
                        value="off" />&nbsp;&nbsp;Non
                    </fieldset>
                </div>
            </div>
            <br>
<!-- --------------------------------------------------------------- -->

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
<?php
require_once __DIR__ . '/footerComment.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>