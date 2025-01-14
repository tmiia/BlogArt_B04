<?php
////////////////////////////////////////////////////////////
//
//  CRUD KANGUE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteLangue.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/../../util/ctrlSaisies.php';

// Insertion classe Langue
require_once ROOT . '/../../class_crud/langue.class.php';
// Instanciation de la classe langue

$maLangue = new langue();

// Ctrl CIR
$erreur = false;
// Insertion classe angle
require_once ROOT . '/../../class_crud/angle.class.php';
// Instanciation de la classe angle

$monangle = new angle();



// Insertion classe thematique
require_once ROOT . '/../../class_crud/thematique.class.php';
// Instanciation de la classe thematique

$monangle = new thematique();



// Insertion classe Motcle
require_once ROOT . '/../../class_crud/motcle.class.php';
// Instanciation de la classe Motcle
$monMotCle = new motcle();




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
    
        header("Location: ./langue.php");
    } 


    // controle CIR
    $erreur = false;
    // delete effective du langue

    if (((isset($_POST["Submit"])) AND ($Submit === "Valider"))) {
        $maLangue->delete($_POST["id"]);
        header("Location: ./langue.php");
        } else {
            echo("Location: langue.php?errCIR=1");
    }
}

// End of if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form
include ROOT . '/initLangue.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Langue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .error {
            padding: 2px;
            border: solid 0px black;
            color: red;
            font-style: italic;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Langue</h1>
    <h2>Suppression d'une langue</h2>
<?php
    // Supp : récup id à supprimer
    if (isset($_GET['id']) and $_GET['id'] != '') {
        $id = ctrlSaisies(($_GET['id']));

        $query = $maLangue->get_1Langue($id);

        if ($query) {
            $lib1Lang = $query['lib1Lang'];
            $lib2Lang = $query['lib2Lang'];
            $numPays = $query['numPays'];
        }   // Fin if ($query)

    }
    // id passé en GET





?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Langue...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="lib1Lang"><b>Libellé court :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="lib1Lang" id="lib1Lang" size="80" maxlength="80" value="<?= $lib1Lang; ?>" tabindex="10" disabled /><br>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="lib2Lang"><b>Libellé long :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="lib1Lang" id="lib2Lang" size="80" maxlength="80" value="<?= $lib2Lang; ?>" tabindex="20" disabled />
        </div>
        <br>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Pays -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypPays">
                <b>Quel pays :&nbsp;&nbsp;&nbsp;</b>
            </label>


            <select name="Pays" id="Pays"  class="form-control form-control-create">
               <option value="-1"><?php echo($maLangue->get_1LangueByPays($id)['frPays']) ?> </option>
            </select>

                <!-- Listbox langue disabled => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Pays -->
<!-- --------------------------------------------------------------- -->
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
    <br>
    <i><div class="error"><br>=>&nbsp;Attention, une suppression doit respecter les CIR !</div></i>
<?php
require_once ROOT . '/footerLangue.php';

require_once ROOT . '/footer.php';
?>
</body>
</html>
