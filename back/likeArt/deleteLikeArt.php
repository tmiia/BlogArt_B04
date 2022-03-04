<?php
////////////////////////////////////////////////////////////
//
//  CRUD likeart (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deletelikeart.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe likeart
require_once __DIR__ . '/../../class_crud/likeart.class.php';
$monlikeart = new likeart();

require_once __DIR__ . '/../../class_crud/article.class.php';

// Instanciation de la classe article
$monarticle = new article();

require_once __DIR__ . '/../../class_crud/membre.class.php';
$monMembre = new membre();

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
    
        header("Location: ./likeart.php");
} 

    // controle CIR
    $erreur = false;
    // delete effective de l'likeart

    if (((isset($_POST["Submit"])) AND ($Submit === "Valider"))) {
            
        $monlikeart->delete($_POST['id1'], $_POST['id2']);
            header("Location: ./likeart.php");
        } else {
            echo("Location: likeart.php?errCIR=1");
    }


    // delete effective du likeart








}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")
// Init variables form
include __DIR__ . '/initlikeart.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Like article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Like article</h1>
    <h2>Suppression d'un (un)like sur article</h2>
<?php
    // Supp : récup id à supprimer
    // id passé en GET
    if ((isset($_GET['id1']) and $_GET['id1'] != '') AND (isset($_GET['id2']) and $_GET['id2'] != '')) {
        $id1 = ctrlSaisies(($_GET['id1']));
        $id2 = ctrlSaisies(($_GET['id2']));

     // Fin if ($query)

    }





?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Like article...</legend>

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

            <select name="Membre" id="Membre"  class="form-control form-control-create">
                
                <option value="-1"><?php echo($monMembre->get_1Membre($id1)['pseudoMemb']); ?> </option>
               
            </select>
                <!-- Listbox membre disabled => 2ème temps -->
        
            </div>
        </div>
    <!-- FIN Listbox Membre -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox article -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypArt">
                <b>Quel article :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
            </label>
            <input type="hidden" id="idTypArt" name="idTypArt" value="<?= $numArt; ?>" />

            <select name="article" id="article"  class="form-control form-control-create">
                
                <option value="-1"><?php echo($monarticle->get_1article($id2)['libTitrArt']); ?> </option>
               
            </select>
                <!-- Listbox aricle disabled => 2ème temps -->
                
            </div>
        </div>
    <!-- FIN Listbox article -->
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
require_once __DIR__ . '/footerlikeart.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
