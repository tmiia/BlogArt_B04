<?php
////////////////////////////////////////////////////////////
//
//  CRUD THEMATIQUE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteThematique.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Thematique
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
// Instanciation de la classe MotCle
$maThematique = new THEMATIQUE();

// Insertion classe Article
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
// Instanciation de la classe Article
$monArticle = new ARTICLE();

// Insertion classe langue
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
// Instanciation de la classe langue
$maLangue = new LANGUE();


// BBCode


// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }
}
    if ((isset($_POST["Submit"])) AND ($Submit === "Annuler")) {
    
        header("Location: ./thematique.php");

    if (((isset($_POST["Submit"])) AND ($Submit === "Valider"))) {
        $nbThemArt = $monArticle->get_NbAllArticlesByNumThem($_POST["id"]);

        if ($nbThemArt < 1) {
                $maThematique->delete($_POST["id"]);
                header("Location: ./thematique.php");
            } 
            else {
                header("Location: thematique.php?errCIR=1");
        }
    }

}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form
include __DIR__ . '/initThematique.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Thematique</title>
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
    <h1>BLOGART22 Admin - CRUD Thematique</h1>
    <h2>Suppression d'une Thematique</h2>
<?php
    // Supp : récup id à supprimer
    // id passé en GET

    if (isset($_GET['id']) and $_GET['id'] != " ") {

        $id = ctrlSaisies(($_GET['id']));

        $query = (array)$maThematique->get_1Thematique($id);

        if ($query) {
            $libThem = $query['libThem'];
            $numThem = $query['numThem']; 
            $numLang = $query['numLang']; 
        }   
    }

?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Thematique...</legend>

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
                <input type="hidden" id="idLang" name="idLang" value="<?= isset($_GET['idLang']) ? $_GET['idLang'] : '' ?>" />
                
                <!-- Listbox langue disabled => 2ème temps -->

                <select name="Langue" id="Langue"  class="form-control form-control-create">

                <?php
                $oneLang = $maLangue->get_1Langue($numLang);
                
                ?>
                
                <option> <?= $oneLang['lib1Lang']; ?> </option>
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
require_once __DIR__ . '/footerThematique.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
