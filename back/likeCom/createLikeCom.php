<?php
////////////////////////////////////////////////////////////
//
//  CRUD likecom (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : createlikecom.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/../../util/ctrlSaisies.php';

// Insertion classe likecom
require_once ROOT . '/../../class_crud/likecom.class.php';
// Instanciation de la classe likecom
$monlikecom = new likecom ();

require_once ROOT . '/../../class_crud/membre.class.php';
$monMembre = new membre();

require_once ROOT . '/../../class_crud/article.class.php';

// Instanciation de la classe article
$monarticle = new article();

require_once ROOT . '/../../class_crud/comment.class.php';
$moncommentaire = new comment();


// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    
    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    if ((isset($_POST["Submit"])) AND ($Submit === "Initialiser")) {
    
            header("Location: ./likeCom.php");
    }   // End of if ((isset($_POST["submit"])) ...
        
    if (((isset($_POST['Membre'])) AND (!empty($_POST['Membre'])) 
    AND (isset($_POST['article'])) AND (!empty($_POST['article']))
    AND (isset($_POST['commentaire'])) AND (!empty($_POST['commentaire']))
        AND (!empty($_POST['Submit'])) AND ($Submit === "Valider"))) {
            // Saisies valides
            $erreur = false;
            
            $numMemb = ctrlSaisies(($_POST['Membre']));
            $numArt = ctrlSaisies(($_POST['article']));
            $numSeqCom = ctrlSaisies($_POST['commentaire']);
            $likeC = 1;
            
            $monlikecom->create($numMemb, $numSeqCom, $numArt, $likeC);
    
            header("Location: ./likeCom.php");
        }   // Fin if ((isset($_POST['libStat']))
        else {
            // Saisies invalides
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // End of else erreur saisies




    // controle des saisies du formulaire

    // création effective du likecom





}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")
// Init variables form
include ROOT . '/initLikeCom.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Like commentaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Like commentaire</h1>
    <h2>Ajout d'un like sur un commentaire d'un article</h2>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Like commentaire d'un article...</legend>

        <input type="hidden" id="id1" name="id1" value="<?= isset($_GET['id1']) ? $_GET['id1'] : '' ?>" />
        <input type="hidden" id="id2" name="id2" value="<?= isset($_GET['id2']) ? $_GET['id2'] : '' ?>" />
        <input type="hidden" id="id3" name="id3" value="<?= isset($_GET['id3']) ? $_GET['id3'] : '' ?>" />
        <br>

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Membre -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypMemb">
                <b>Quel membre :&nbsp;&nbsp;&nbsp;</b>
            </label>
            <input type="hidden" id="idTypMemb" name="idTypMemb" value="<?= $numMemb; ?>" />

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
            <!-- Listbox membre => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Membre -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox commentaire / article -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypArt">
                <b>Quel commentaire par article :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
            </label>
            <input type="hidden" id="idTypArt" name="idTypArt" value="<?= $numArt; ?>" />
            <input type="hidden" id="idTypSeqCom" name="idTypSeqCom" value="<?= $numSeqCom; ?>" />

            <select name="article" id="article"  class="form-control form-control-create">
                <option value="-1">- - - Choisissez un article - - -</option>
                <?php
                $allarticles = $monarticle->get_Allarticles();
                
                if($allarticles){
                for ($i=0; $i < count($allarticles); $i++){
                    $value = $allarticles[$i]['numArt'];
                ?>
                
                <option value="<?php echo($value); ?>"> <?= $value ." - " . $allarticles[$i]['libTitrArt']; ?> </option>
                
                <?php
                    } // End of foreach
                }   // if ($result)
                ?>
            </select>
        <br><br>        
            <select name="commentaire" id="commentaire"  class="form-control form-control-create">
                <option value="-1">- - - Choisissez un commentaire - - -</option>
                <?php
                $allcommentsbyArt = $moncommentaire->get_AllcommentsByNumArt($value);
                
                if($allcommentsbyArt){
                for ($i=0; $i < count($allcommentsbyArt); $i++){
                    $value1 = $allcommentsbyArt[$i]['numSeqCom'];
                ?>
                
                <option value="<?php echo($value1); ?>"> <?= $value1 ." - " . $allcommentsbyArt[$i]['libCom']; ?> </option>
                
                <?php
                    } // End of foreach
                }   // if ($result)
                ?>
            </select>

            
            <!-- Listbox article => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox commentaire / article -->
<!-- --------------------------------------------------------------- -->
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
                <br><br>
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
require_once ROOT . '/footerLikeCom.php';

require_once ROOT . '/footer.php';
?>
</body>
</html>
