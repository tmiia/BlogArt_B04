<?php
////////////////////////////////////////////////////////////
//
//  CRUD thematique (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deletethematique.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/ctrlSaisies.php';

// Insertion classe thematique
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/thematique.class.php';
// Instanciation de la classe MotCle
$mathematique = new thematique();

// Insertion classe article
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/article.class.php';
// Instanciation de la classe article
$monarticle = new article();

// Insertion classe langue
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/langue.class.php';
// Instanciation de la classe langue
$maLangue = new langue();


// BBCode


// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
        
    } else {
        $Submit = "";
    }

    if ((isset($_POST["Submit"])) AND ($Submit === "Annuler")) {
    
        header("Location: ./thematique.php");
    }
    if (((isset($_POST["Submit"])) AND ($Submit === "Valider"))) {
        
        $nbThemArt = $monarticle->get_NbAllarticlesByNumThem($_POST["id"]);

        if ($nbThemArt < 1) {
            
                $mathematique->delete($_POST["id"]);
                header("Location: ./thematique.php");
            } 
            else {
                header("Location: thematique.php?errCIR=1");
        }
    }

}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form
include $_SERVER['DOCUMENT_ROOT'] . '/initthematique.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD thematique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #p1 {
            max-width: 600px;
            width: 600px;
            max-height: 200px;
            height: 200px;
            border: 1px solid #000000;
            background-color: whitesmoke;
            /* Coins arrondis et couleur du cadre */
            border: 2px solid grey;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>BLOGART22 Admin - CRUD thematique</h1>
    <h2>Suppression d'une thematique</h2>
<?php
    // Supp : récup id à supprimer
    // id passé en GET

    if (isset($_GET['id']) and $_GET['id'] != " ") {

        $id = ctrlSaisies(($_GET['id']));

        $query = (array)$mathematique->get_1thematique($id);

        if ($query) {
            $libThem = $query['libThem'];
            $numThem = $query['numThem']; 
            $numLang = $query['numLang']; 
        }   
    }

?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire thematique...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libThem"><b>Libellé :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libThem" id="libThem" size="80" maxlength="80" value="<?= $libThem; ?>" disabled="disabled" />
        </div>

        <br>
<!-- --------------------------------------------------------------- -->
    <!-- FK : Langue -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox langue -->
        <br>

        <div class="control-group">
            <label class="control-label" for="LibTypLang"><b>Langue :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="numLang" name="idLang" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />
                
                <!-- Listbox langue disabled => 2ème temps -->

                <select name="Langue" id="Langue"  class="form-control form-control-create">

                <?php
                $oneLang = $maLangue->get_1Langue($numLang);
                
                ?>
                
                <option value="<?php echo($oneLang['numLang']) ?>"> <?php echo($oneLang['lib1Lang']); ?> </option>
            </select>

        </div>
    <!-- FIN Listbox langue -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Langue -->
<!-- --------------------------------------------------------------- -->
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
require_once $_SERVER['DOCUMENT_ROOT'] . '/footerthematique.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
</body>
</html>
