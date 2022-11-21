<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/utilErrOn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/ctrlSaisies.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/comment.class.php';
$moncomment = new comment();
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/article.class.php';
$monarticle = new article();
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/membre.class.php';
$monMembre = new membre();

$erreur = false;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    }
    else{
        $Submit = "";
    }

    if($_POST['Submit'] == 'Initialiser'){
        header("Location: updatecomment.php?id1=$numSeqCom&id2=$idArt");
    }

    if(isset($_POST['Submit']) AND $_POST['Submit'] === 'Valider'){
        if(isset($_POST['notifComKOAff']) AND !empty($_POST['notifComKOAff']) AND isset($_POST['id2']) AND !empty($_POST['id2']) AND isset($_POST['id1']) AND !empty($_POST['id1']) AND !empty($_POST['Submit'] AND $Submit === 'Valider')){
            $erreur = false;

            $numSeqCom = ctrlSaisies($_POST["id1"]);
            $idMemb = ctrlSaisies($_POST['idMemb']);
            $idArt = ctrlSaisies($_POST['idArt']);
            if(ctrlSaisies($_POST['notifComKOAff']) == ""){
                $notifComKOAff = NULL;
            }
            else{
                $notifComKOAff = ctrlSaisies($_POST['notifComKOAff']);
            }

            if(ctrlSaisies($_POST['attModOK']) == "on"){
                $attModOK = 1;
            }
            else{
                $attModOK =  0;
            }

            if(ctrlSaisies($_POST['delLogiq']) == "on"){
                $delLogiq = 1;
            }
            else{
                $delLogiq =  0;
            }
            $moncomment->update($numSeqCom, $idArt, $attModOK, $notifComKOAff, $delLogiq);

            header("Location: ./comment.php");
        }
        else{
            $erreur = true;
            $errSaisies = "Erreur, la saisie est obligatoire !";
        }
    }
}  
include $_SERVER['DOCUMENT_ROOT'] . '/initcomment.php'; 
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>Admin - CRUD commentaire</title>
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
        <h1>BLOGART22 Admin - CRUD commentaire</h1>
        <h2>Mise à jour d'un commentaire</h2>
<?php
    // Modif : récup id à modifier
    // id passé en GET
    
    if(isset($_GET['id1']) AND $_GET['id1'] != '' AND isset($_GET['id2']) AND $_GET['id2'] != ''){

        $id1 = intval($_GET['id1']);
        $id2 = intval($_GET['id2']);
        
        $query = $moncomment->get_1comment($id1, $id2);
        
    
        if($query){
            $idMemb = $monMembre->get_1Membre($query['numMemb']);
            $idArt = $monarticle->get_1article($id2);
            $libCom = $query['libCom'];
            $notifComKOAff = $query['notifComKOAff'];
            $attModOK =  $query['attModOK'];
            $delLogiq = $query['delLogiq'];
    
        }
    }



?>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

        <fieldset>
            <legend class="legend1">Modération : validez un commentaire...</legend>

            <input type="hidden" id="id1" name="id1" value="<?= isset($_GET['id1']) ? $_GET['id1'] : '' ?>" />
            <input type="hidden" id="id2" name="id2" value="<?= isset($_GET['id2']) ? $_GET['id2'] : '' ?>" />

<!-- --------------------------------------------------------------- -->
    <!-- FK : Membre, article -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Membre -->
            <br>
            <div class="control-group">
                <div class="controls">
                    <label class="control-label" for="LibTypAngl">
                        <b>Quel membre :&nbsp;&nbsp;&nbsp;</b>
                    </label>
                    <input type="hidden" id="idTypMemb" name="idTypMemb" value="<?= $idMemb['numMemb']; ?>" />

                    <!-- Listbox membre => 2ème temps -->

                    <select name="idMemb" id="idMemb"  class="form-control form-control-create">
                        <option value="<?=$idMemb['numMemb']?>"  name="idMemb" id="idMemb"> <?= $idMemb['pseudoMemb'] ?> </option>    
                    </select>

                </div>
            </div>
    <!-- FIN Listbox Membre -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox article -->
            <br>
            <div class="control-group">
                <div class="controls">
                    <label class="control-label" for="LibTypThem">
                        <b>Quel article :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                    </label>
                    <input type="hidden" id="idTypArt" name="idTypArt" value="<?= $id2; ?>" />

                    <!-- Listbox article => 2ème temps -->

                    <select name="idArt" id="idArt"  class="form-control form-control-create">
                        <option value="<?=$idArt['numArt']?>"  name="idArt" id="idArt"> <?= $idArt['libTitrArt'] ?> </option>    
                    </select>

                </div>
            </div>
    <!-- FIN Listbox article -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Fin FK : Membre, article -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- textarea comment -->
            <br>
            <div class="control-group">
                <label class="control-label" for="libCom"><b>commentaire à valider :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
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
require_once $_SERVER['DOCUMENT_ROOT'] . '/footercomment.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
</body>
</html>