<?php
////////////////////////////////////////////////////////////
//
//  CRUD LIKEART (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteLikeArt.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Likeart
// Insertion classe Likeart
require_once __DIR__ . '/../../CLASS_CRUD/LikeArt.class.php';

// Instanciation de la classe Likeart
$monLikeArt = new LIKEART();





// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    if ((isset($_POST["Submit"])) AND ($Submit === "Annuler")) {
    
        header("Location: ./likeArt.php");
} 

    // controle CIR
    $erreur = false;
    // delete effective de l'likeArt

    if (((isset($_POST["Submit"])) AND ($Submit === "Valider"))) {
            
        $monlikeArt->delete($numMemb, $numArt);
            header("Location: ./likeArt.php");
        } else {
            echo("Location: likeArt.php?errCIR=1");
    }


    // delete effective du likeart








}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")
// Init variables form
include __DIR__ . '/initLikeArt.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Like Article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Like Article</h1>
    <h2>Suppression d'un (un)like sur Article</h2>
<?php
    // Supp : récup id à supprimer
    // id passé en GET






?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Like Article...</legend>

        <input type="hidden" id="id1" name="id1" value="<?= isset($_GET['id1']) ? $_GET['id1'] : '' ?>" />
        <input type="hidden" id="id2" name="id2" value="<?= isset($_GET['id2']) ? $_GET['id2'] : '' ?>" />

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


                <!-- Listbox membre disabled => 2ème temps -->
                <select name="Membre" id="Article"  class="form-control form-control-create">
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

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Article -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypArt">
                <b>Quel article :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
            </label>
            <input type="hidden" id="idTypArt" name="idTypArt" value="<?= $numArt; ?>" />


                <!-- Listbox aricle disabled => 2ème temps -->
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
                <input type="submit" value="Annuler" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                <br>
            </div>
        </div>
      </fieldset>
    </form>
<?php
require_once __DIR__ . '/footerLikeArt.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
