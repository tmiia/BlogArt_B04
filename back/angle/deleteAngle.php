<?php
////////////////////////////////////////////////////////////
//
//  CRUD ANGLE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteAngle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/util/ctrlSaisies.php';

// Del accents sur string
require_once ROOT . '/util/delAccents.php';

// Insertion classe Angle
require_once ROOT . '/CLASS_CRUD/angle.class.php';

// Instanciation de la classe angle
$monAngle = new ANGLE();



require_once ROOT . '/CLASS_CRUD/langue.class.php';

$maLangue = new LANGUE();


// Ctrl CIR
$erreur = false;

// Insertion classe Article
require_once ROOT . '/CLASS_CRUD/article.class.php';

// Instanciation de la classe Article
$monArticle = new ARTICLE();


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
    
        header("Location: ./angle.php");
} 

    // controle CIR
    $erreur = false;
    // delete effective de l'angle

    if (((isset($_POST["Submit"])) AND ($Submit === "Valider"))) {
            
        $monAngle->delete($_POST["id"]);
            header("Location: ./angle.php");
        } else {
            echo("Location: angle.php?errCIR=1");
    }
}// End of if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form

include ROOT . '/back/angle/initAngle.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Angle</title>
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
    <h1>BLOGART22 Admin - CRUD Angle</h1>
    <h2>Suppression d'un angle</h2>
<?php
      // Supp : récup id à supprimer
      if (isset($_GET['id']) and $_GET['id'] !='') {

        $id = ctrlSaisies(($_GET['id']));

        $query = $monAngle->get_1Angle($id);

        if ($query) {
            $libAngl = $query['libAngl'];
            $numAngl = $query['numAngl']; 
        }   // Fin if ($query)
        

    }
    // id passé en GET

?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Angle...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libAngl"><b>Libellé :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libAngl" id="libAngl" size="80" maxlength="80" value="<?= $libAngl; ?>" tabindex="10" disabled />
        </div>
        <br>
<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
    <!-- Listbox Angle -->

        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypLang">
                <b>Quelle langue :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
            </label>
            
            <!-- Listbox langue => 2ème temps -->

            <select name="Langue" id="Langue"  class="form-control form-control-create">
<<<<<<< HEAD
            <option value="-1"><?php var_dump($maLangue->get_1LangueByPays($id)) ?> </option>
=======
                <option value="-1"><?php echo($monAngle->get_1LangByAngle($numAngl)['lib1Lang']) ?></option>

>>>>>>> 00be2cb35f57fd6ae16a02adb2c1b880835b9806
            </select>

            

            </div>
        </div>
    <!-- FIN Listbox Langue -->
<!-- ---------------------------------------------------------------------- -->
            </div>
        </div>

    <!-- FIN Listbox Angle -->
<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
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
require_once ROOT . '/back/angle/footerAngle.php';

require_once ROOT . '/back/angle/footer.php';
?>
</body>
</html>
