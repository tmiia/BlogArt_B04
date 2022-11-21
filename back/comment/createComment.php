<?php
////////////////////////////////////////////////////////////
//
//  CRUD comment (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : createcomment.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// EDI WYSIWYG : ckeditor4
//
// Mode DEV
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/ctrlSaisies.php';

// Insertion classe comment
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/comment.class.php';

// Instanciation de la classe article
$moncommentaire = new comment();
// Instanciation de la classe comment
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/article.class.php';

// Instanciation de la classe article
$monarticle = new article();

require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/membre.class.php';
$monMembre = new membre();


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
        
    if (((isset($_POST['Membre'])) AND (!empty($_POST['Membre'])) AND (isset($_POST['article'])) AND (!empty($_POST['article']))AND (isset($_POST['libCom'])) AND (!empty($_POST['libCom']))
        AND (!empty($_POST['Submit'])) AND ($Submit === "Valider"))) {
            // Saisies valides
            $erreur = false;
           
            $numMemb = ctrlSaisies(($_POST['Membre']));
            $numArt = ctrlSaisies(($_POST['article']));
            $numSeqCom = intval($moncommentaire->getNextNumCom($numArt));
            $libCom = ctrlSaisies(($_POST['libCom']));
            // $dtCreCom = ctrlSaisies(($_POST['dtCreCom']));


            $moncommentaire-> create($numSeqCom, $numArt, $libCom, $numMemb);
    
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
include $_SERVER['DOCUMENT_ROOT'] . '/initcomment.php';
// Var init


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

</head>
<body>
    <h1>BLOGART22 Admin - CRUD commentaire</h1>
    <h2>Ajout d'un commentaire</h2>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">commentez un commentaire...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

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
    <!-- Listbox article -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypThem">
                <b>Quel article :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
            </label>
            

            <!-- Listbox article => 2ème temps -->
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

            </div>
        </div>
    <!-- FIN Listbox article -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Fin FK : Membre, article -->
<!-- --------------------------------------------------------------- -->
    <!-- textarea comment -->
        <br>
        <div class="control-group">
            <label class="control-label" for="libCom"><b>Ajoutez votre commentaire :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
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
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/footercomment.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
</body>
</html>
